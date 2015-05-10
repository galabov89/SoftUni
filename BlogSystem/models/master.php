<?php

namespace Models;

 class Master_Model{

     protected $table;
     protected $limit;
     protected $db;

     public  function __construct( $args=array()){
        $default = array( 'limit'=> 0 );

         if( !isset($args['table'])){
             die('Table not defined.');
         }

         $args = array_merge($default,$args);

         extract( $args );

         $this->table = $args['table'];
         $this->limit = $args['limit'];

         $db_object = \Lib\Database::get_instance();
         $this->db =  $db_object::get_db();
     }

     public function find( $args = array() ) {
         $defaults = array( array(
             'table' => $this->table,
             'where' => '',
             'columns' => '*',
             'limit' => $this->limit
         ) );

        // var_dump($args);
        // var_dump($defaults);
         $args =array_merge($defaults,$args);
        // var_dump($args);
         extract($args);

         $query = "select {$args[0]['columns']} from {$args[0]['table']}";

         if( ! empty( $args['where'] ) ) {
             $query .= ' where ' . $args['where'];
             //var_dump($args['where']);
         }

         if( ! empty( $args['limit'] ) ) {
             $query .= ' limit ' . $args['limit'];
         }

        // echo $query;

         $result_set = $this->db->query( $query );

         $results = $this->process_results( $result_set );

         return $results;
     }

     public function process_results( $result_set ) {
         $results = array();

         if( ! empty( $result_set ) && $result_set->num_rows > 0) {
             while($row = $result_set->fetch_assoc()) {
                 $results[] = $row;
             }
         }
         return $results;
     }

     public function get($class_name, $id ) {

         return $this->find( array( 'where' =>$class_name. 'Id = ' .$id ) );
     }

     public  function  add($element){
         $keys = array_keys($element);
         $values = array();

         // Escape values, like prepared statement
         foreach( $element as $key => $value ) {
             $values[] = "'" . $this->db->real_escape_string( $value ) . "'";
         }

         $keys = implode( $keys, ',' );
         $values = implode( $values, ',' );

         $query = "INSERT INTO {$this->table}($keys) VALUES($values)";

        // var_dump($query);
         $this->db->query($query);

         return $this->db->affected_rows;
     }

     public function get_user_info($userId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  u.UserName, u.Firstname, u.LastName, u.Password
                             FROM `users` u
                             WHERE u.userid = $userId

         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function find_by_user($args = array()){
         $defaults = array( array(
             'table' => $this->table,
             'where' => '',
             'columns' => '*',
             'limit' => $this->limit
         ) );

         if( empty( $_SESSION['user_id']) ) {
             header("Location: " . DX_ROOT_URL . 'login/index' );

         }

         // var_dump($args);
         // var_dump($defaults);
         $args =array_merge($defaults,$args);
         // var_dump($args);
         extract($args);

         $query = "select {$args[0]['columns']} from {$args[0]['table']}";

         if(  empty( $args['where'] ) ) {
             $query .= ' where ' . 'User_UserId = '.$_SESSION['user_id'];
             //var_dump($args['where']);
         }

         if( ! empty( $args['limit'] ) ) {
             $query .= ' limit ' . $args['limit'];
         }

         // echo $query;

         $result_set = $this->db->query( $query );

         $results = $this->process_results( $result_set );

         return $results;
     }

     public function find_users_posts($postid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $userId = $_SESSION['user_id'];

         $statement =  "
                        SELECT postss.PostId, postss.Title, postss.Content, postss.UserName as 'PostOwner',
                        commentss.Content as 'Comment',commentss.UserName as'CommentOwner', commentss.DateCreated as 'CommentDate'
                         FROM (
                             SELECT u.UserName , p.Content, p.Title , p.PostId, p.PostDate
                             FROM `posts` p
                             LEFT JOIN `users` u on p.user_userid = u.userid
                             WHERE p.postid = $postid
                         ) as `postss` ,
                         (
                             SELECT u1.UserName, c1.Content, c1.DateCreated
                             FROM `users` u1
                             LEFT JOIN `comments` c1 on c1.user_userid = u1.userid
                             WHERE c1.post_postid = $postid
                             ORDER BY c1.DateCreated DESC
                         ) as `commentss`
                        GROUP BY postss.PostId, postss.Title, postss.Content, postss.UserName, commentss.Content, commentss.UserName, commentss.DateCreated
                        ORDER BY commentss.DateCreated DESC
         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

        // var_dump($result);

        // echo '///////////////////////////////////////////////////////////////////////////////////////';

         $last = count($result) - 1;
         foreach ($result as $i => $row) {
             $comments[] =  array('Comment' => $result[$i]['Comment'],'CommentOwner' => $result[$i]['CommentOwner'],'CommentDate' => $result[$i]['CommentDate']);
             $key = $result[$i]['Title'].' | '.$result[$i]['Content'].' | '.$result[$i]['PostOwner'];

             if($i == $last){
                 $final[$key] = $comments;

                 unset($final[0]);
                // var_dump($final);
                 break;
             }

            if($result[$i]['PostId'] !=$result[$i+1]['PostId']){
               $final[$key] = $comments;
               // var_dump($comments);
                $comments = array();
               // var_dump($final);
            }
         }
          return $final;
     }

     public function get_post_for_user($postid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT p.Title, p.Content, u.UserName  , p.PostId
                             FROM `posts` p
                             JOIN `users` u on p.user_userid = u.userid
                             WHERE p.postid = $postid

         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

        // var_dump($result);

         return $result;
     }

     public function get_posts_by_user($userid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT p.Title, p.Content, p.PostId
                             FROM `posts` p
                             WHERE p.user_userid = $userid

         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_comments_by_user($userid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  c.Content, c.CommentId
                             FROM `comments` c
                             WHERE c.user_userid = $userid

         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_comment($commentid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  c.Content, c.CommentId
                             FROM `comments` c
                             WHERE c.commentid = $commentid

         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_post($postid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  p.Content, p.PostId, p.Title
                             FROM `posts` p
                             WHERE p.postid = $postid

         " ;

         $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($postResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_all_categories(){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  c.CategoryId, c.Name
                             FROM `categories` c


         " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_all_categories_post_have($postId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  c.CategoryId, c.Name
                             FROM `posts` p
                             join `categories` c ON p.category_categoryid = c.categoryid
                             WHERE p.postid = $postId


         " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_post_by_category($categoryId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT p.PostId,  p.Title, u.UserId, u.UserName, p.PostDate
                             FROM `posts` p
                             JOIN `users` u ON u.UserId = p.User_UserId
                             WHERE p.Category_CategoryId = $categoryId
                             ORDER BY p.PostDate DESC

         " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_post_by_tag($tagId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT p.PostId,  p.Title,u.UserId, u.UserName, p.PostDate
                             FROM `posts` p
                             JOIN `users` u ON u.UserId = p.User_UserId
                             JOIN `poststags` pt ON pt.Post_PostId = p.Postid
                             JOIN `tags` t ON t.TagId = pt.Tag_TagId
                             WHERE t.TagId = $tagId
                             ORDER BY p.PostDate DESC

         " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_tags_by_post($postId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT t.TagId,  t.Name
                             FROM `tags` t
                             JOIN `poststags` pt ON pt.Tag_TagId = t.TagId
                             JOIN `posts` p ON p.PostId = pt.Post_PostId
                             WHERE p.PostId = $postId

         " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function get_all_categories_post_dont_have($postId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT  c.CategoryId, c.Name
                             FROM `categories` c
                             join `posts` p ON p.category_categoryid
                             WHERE p.postid = $postId AND c.CategoryId NOT IN ( SELECT  c.CategoryId
                                                                 FROM `categories` c
                                                                 join `posts` p ON p.category_categoryid
                                                                 WHERE p.postid = $postId )
         " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function edit_firstname($userId, $user_name){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $user_name . "'";

         $statement =  " UPDATE users SET FirstName= $value WHERE userid = $userId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         //var_dump($statement);
     }

     public function edit_lastname($userId, $user_name){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $user_name . "'";

         $statement =  " UPDATE users SET LastName= $value WHERE userid = $userId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function edit_post_title($postId, $post_title){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $post_title . "'";

         $statement =  " UPDATE posts SET Title= $value WHERE postid = $postId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function edit_post_content($postId, $post_content){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $post_content . "'";

         $statement =  " UPDATE posts SET Content= $value WHERE postid = $postId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function edit_post_category($postId, $category){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $category . "'";

         $statement =  " UPDATE posts SET Category_CategoryId= $value WHERE postid = $postId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function edit_comment_content($commentId, $comment_content){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $comment_content . "'";

         $statement =  " UPDATE comments SET Content= $value WHERE commentid = $commentId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function delete_comment($commentId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  " DELETE FROM comments WHERE commentid = $commentId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
     }

     public function delete_post($postId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $comment_statement =  " DELETE FROM comments WHERE Post_PostId = $postId " ;

         $result = mysqli_query($dbconn, $comment_statement)or die(mysqli_error($dbconn));

         $post_statement =  " DELETE FROM poststags WHERE Post_PostId = $postId " ;

         $result = mysqli_query($dbconn, $post_statement)or die(mysqli_error($dbconn));

         $post_statement =  " DELETE FROM posts WHERE PostId = $postId " ;

         $result = mysqli_query($dbconn, $post_statement)or die(mysqli_error($dbconn));


     }

     public function change_tags($postId,$tags){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $post_statement =  " DELETE FROM poststags WHERE Post_PostId = $postId " ;

         $result = mysqli_query($dbconn, $post_statement)or die(mysqli_error($dbconn));

         foreach ($tags as $tag) {
           // var_dump($tags);
            // $tag = "'" . $tag['TagId'] . "'";

             $statement =  "INSERT INTO poststags (Post_PostId,Tag_TagId) VALUES ('$postId','$tag')" ;

             mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
         }

     }

     public function delete_user($userId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $posts_by_user = $this->get_posts_by_user($userId);
        // var_dump($posts_by_user);

         foreach ( $posts_by_user as $post) {
             //var_dump(intval($post['PostId']));
             $this->delete_post($post['PostId']);
         }

         $comment_statement =  " DELETE FROM comments WHERE User_UserId = $userId " ;

         $result = mysqli_query($dbconn, $comment_statement)or die(mysqli_error($dbconn));

         $user_statement =  " DELETE FROM users WHERE UserId = $userId " ;

         $result = mysqli_query($dbconn, $user_statement)or die(mysqli_error($dbconn));

     }

     public function edit_category($categoryId, $category){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $category . "'";

         $statement =  " UPDATE categories SET Name= $value WHERE Categoryid = $categoryId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function add_category($category){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "INSERT INTO categories (Name) VALUES ('$category')" ;

         mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
     }

     public function delete_category($categoryId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  " UPDATE posts SET Category_CategoryId= 11 WHERE Category_CategoryId = $categoryId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $statement =  " DELETE FROM categories WHERE CategoryId = $categoryId " ;

         mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
     }

     public function edit_tag($tagId, $tag){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $value = "'" . $tag . "'";

         $statement =  " UPDATE tags SET Name= $value WHERE Tagid = $tagId " ;

         $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

     }

     public function get_admin_categories(){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  " SELECT * FROM categories WHERE CategoryId != 11 " ;

         $categoryResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($categoryResult)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;
     }

     public function add_tag($tag){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "INSERT INTO tags (Name) VALUES ('$tag')" ;

         mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
     }

     public function delete_tag($tagId){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  " DELETE FROM poststags WHERE Tag_TagId = $tagId " ;

         mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $statement =  " DELETE FROM tags WHERE TagId = $tagId " ;

         mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
     }

     public function find_user_by_id($userid){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  " SELECT UserName FROM users WHERE UserId = $userid " ;

         mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
     }

     public function find_posts_authors(){
         $db = \Lib\Database::get_instance();
         $dbconn = $db->get_db();

         $statement =  "
                             SELECT u.UserId, u.UserName, p.PostId, p.Title, p.PostDate
                             FROM `users` u
                             JOIN `posts` p ON p.User_UserId = u.UserId
                             ORDER BY p.PostDate DESC

         " ;

         $Result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

         $result = array();
         $comments = array();
         $final[] = array();

         while($row = mysqli_fetch_assoc($Result)) {
             $result[] = $row;
         }

         // var_dump($result);

         return $result;

     }
}