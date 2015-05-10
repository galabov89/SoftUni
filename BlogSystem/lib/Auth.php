<?php
namespace Lib;
class Auth {

   // private static $session = null;

    private static $is_logged_in = false;
    private static $logged_user = array();

    private function __construct() {

        session_set_cookie_params(3600,"/");
        session_start();

        if(! empty($_SESSION['username'])){
            self::$is_logged_in = true;
            self::$logged_user = array(
                'UserId' => $_SESSION['user_id'],
                'UserName' => $_SESSION['username'],
            );
        }
    }

    public static function get_instance() {
        static $instance = null;

        if ( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }

    public function is_logged_in() {
//        if ( isset( $_SESSION['username'] ) ) {
//            return true;
//        }
//        return false;

        return self::$is_logged_in;
    }

    public function login( $username, $password ) {
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();


        $statement = $dbconn->prepare( "SELECT UserId, UserName FROM users WHERE username = ? AND password =  ?  LIMIT 1" );
        var_dump($statement);
        $statement->bind_param( 'ss', $username, $password );

        $statement->execute();

        $result_set = $statement->get_result();
        var_dump($result_set);

        if ( $row = $result_set->fetch_assoc() ) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['UserId'];
            return true;
        }

        return false;
    }

    public function register($username,$firstname,$lastname, $password){
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();

//        $statement = $dbconn->prepare( "INSERT INTO users (UserName,FirstName, LastName,Password) VALUES ({$username},{$firstname},{$lastname},{$password})" );
//        $statement->bind_param( 'ssss', $username,$firstname,$lastname, $password );
//        $statement->execute();

        $statement =  "INSERT INTO users (UserName,FirstName, LastName,Password) VALUES ('$username','$firstname','$lastname','$password')" ;
        $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

        return $postResult;

//        $result_set = $statement->get_result();
//        if ( $result_set ) {
//
//            return true;
//        }
//
//        return false;
    }

    public function logout( ) {
        session_destroy();
    }

    public function get_logged_user() {
//        if ( ! isset( $_SESSION['username'] )  ) {
//            return self::$logged_user = array();
//        }
//
//        return self::$logged_user =  array(
//            'user_id' => $_SESSION['user_id'],
//            'username' => $_SESSION['username']
//        );

        return self::$logged_user;
    }

    public function make_a_post($title, $content, $categoryId, $userId,$post_date){
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();

        $statement =  "INSERT INTO posts (Title,Content, PostDate,CategoryId, UserId, Category_Categoryid, User_UserId)
                       VALUES ('$title','$content',NOW(),1,1,'$categoryId','$userId')" ;

        $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

        return $postResult;
    }

    public function insert_tags($title, $content, $categoryId, $userId,$post_date, $selected_tags){
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();

        var_dump($post_date);
        var_dump($selected_tags);

        $title = "'" . $title . "'";
        $content = "'" . $content . "'";
        $post_date = "'" . $post_date . "'";

        $statement = "
                        SELECT p.PostId
                        FROM `posts` p
                        WHERE p.Title = $title AND p.Content = $content AND p.Category_Categoryid = $categoryId
                              AND p.User_Userid = $userId

        ";

        $postResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

        $result = array();

        while($row = mysqli_fetch_assoc($postResult)) {
            $result[] = $row;
        }

        var_dump($result);
        var_dump(end($result));
        $postid = end($result);

        foreach ($selected_tags as $tag) {

            $post = "'" . $postid['PostId'] . "'";

            $statement =  "INSERT INTO poststags (Post_PostId,Tag_TagId)
                           VALUES ($post,'$tag')" ;

            mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));
        }


        return  $postResult;
    }

    public function make_a_comment($content,$userId, $postId){
        $db = \Lib\Database::get_instance();
        $dbconn = $db->get_db();

        $statement =  "INSERT INTO comments (Content,AuthorId,DateCreated,PostId, User_UserId, Post_PostId)
                       VALUES ('$content',1,NOW(),1,'$userId','$postId')" ;

       // var_dump($statement);

        $commentResult = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

        return $commentResult;
    }
}