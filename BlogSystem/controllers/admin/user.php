<?php

namespace Admin\Controllers;

class User_Controller extends Admin_Controller{

    public function __construct($class_name = 'Admin\Controllers\User_Controller',
                                $model = 'master',
                                $views_dir = 'views/admin/master/' ) {

        parent::__construct( get_class(),'users', '/views/admin/master/');
    }

    public function index(){

        if(isset($_POST['deleteuser'])){

            $delete_user = $this->moodel->delete_user($_POST['deleteuser']);

        }

        if(isset($_POST['editcategory_btn']) && isset($_POST['editcategory_name'])){

            $editcategory_name = trim($_POST['editcategory_name']);
            $editcategory_name = htmlentities($editcategory_name);

            if(empty($editcategory_name)){
                $login_errors[]='You need to supply a category name';
            }

            if(strlen($editcategory_name)>50){
                $login_errors[]='Category name cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $edit_category = $this->moodel->edit_category($_POST['editcategory_id'], $editcategory_name);
            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['addcategory_btn']) && isset($_POST['add_category'])){

            $add_category = trim($_POST['add_category']);
            $add_category = htmlentities($add_category);

            if(empty($add_category)){
                $login_errors[]='You need to supply a category name';
            }

            if(strlen($add_category)>50){
                $login_errors[]='Category name cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $add_category = $this->moodel->add_category($add_category);

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['deletecategory_btn'])){

            $delete_category = $this->moodel->delete_category($_POST['deletecategory_id']);

        }

        if(isset($_POST['edittag_btn']) && isset($_POST['edittag_name'])){

            $edittag_name = trim($_POST['edittag_name']);
            $edittag_name = htmlentities($edittag_name);

            if(empty($edittag_name)){
                $login_errors[]='You need to supply a tag name';
            }

            if(strlen($edittag_name)>50){
                $login_errors[]='Tag name cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $edit_tag = $this->moodel->edit_tag($_POST['edittag_id'], $edittag_name);

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['addtag_btn']) && isset($_POST['add_tag'])){

            $add_tag= trim($_POST['add_tag']);
            $add_tag = htmlentities($add_tag);

            if(empty($add_tag)){
                $login_errors[]='You need to supply a tag name';
            }

            if(strlen($add_tag)>50){
                $login_errors[]='Tag name cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $add_tag = $this->moodel->add_tag($add_tag);

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['deletetag_btn'])){

            $delete_tag = $this->moodel->delete_tag($_POST['deletetag_id']);

        }


        $model_class="\Models\\".ucfirst( 'users' )."_Model";

        //Categories
        $categories = $this->moodel->get_admin_categories();

        //Tags
        $tag_class = '\Controllers\Tag_Controller';
        $tag = new $tag_class();
        $tags= $tag->moodel->find();

        $users = $this->moodel->find();

        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

    public function view($id){

        $posts = $this->moodel->get('Post',$id);

        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

    public function add(){

        if(!empty($_POST['title']) && !empty($_POST['content'])){
            $title = $_POST['title'];
            $content = $_POST['content'];

            $post = array('title'=>$title, 'content'=>$content);

            $this->moodel->add($post);
        }

        $template_name = DX_ROOT_DIR.$this->views_dir.'add.php';
        include_once $this->layout;
    }

    public function info($userId){

        //Edit FirstName
        if(isset($_POST['firstname'])){

            $firstname= trim($_POST['firstname']);
            $firstname = htmlentities($firstname);

            if(empty($firstname)){
                $login_errors[]='You need to supply a firstname name';
            }

            if(strlen($firstname)>50){
                $login_errors[]='Firstname cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $edit_firstname = $this->moodel->edit_firstname($userId, $firstname);

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['lastname'])){

            $lastname= trim($_POST['lastname']);
            $lastname = htmlentities($lastname);

            if(empty($lastname)){
                $login_errors[]='You need to supply a lastname name';
            }

            if(strlen($lastname)>50){
                $login_errors[]='Lastname cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {
                $edit_lastname = $this->moodel->edit_lastname($userId, $lastname);
            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['deletecomment'])){

            $delete_comment = $this->moodel->delete_comment($_POST['deletecomment']);

        }

        if(isset($_POST['deletepost'])){


            $delete_post = $this->moodel->delete_post($_POST['deletepost']);

        }



        $users = $this->moodel->get_user_info($userId);

        $user_posts = $this->moodel->get_posts_by_user($userId);

        $user_comments= $this->moodel->get_comments_by_user($userId);

        $template_name = DX_ROOT_DIR.$this->views_dir.'info.php';
        include_once $this->layout;
    }

    public function edit_comment($commentId){

        if(isset($_POST['editcomment'])){

            $editcomment= trim($_POST['editcomment']);
            $editcomment = htmlentities($editcomment);

            if(empty($editcomment)){
                $login_errors[]='You need to supply a comment content ';
            }

            if(empty($login_errors)) {

                $edit_title = $this->moodel->edit_comment_content($commentId, $editcomment);

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        $user_comment= $this->moodel->get_comment($commentId);

        $template_name = DX_ROOT_DIR.$this->views_dir.'edit_comment.php';
        include_once $this->layout;
    }

    public function edit_post($postId){

        if(isset($_POST['edittitle'])){

            $edittitle= trim($_POST['edittitle']);
            $edittitle = htmlentities($edittitle);

            if(empty($edittitle)){
                $login_errors[]='You need to supply a title ';
            }

            if(strlen($edittitle)>100){
                $login_errors[]='Title cannot be longer than 100 characters.';
            }

            if(empty($login_errors)) {

                $edit_title = $this->moodel->edit_post_title($postId, $edittitle);

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['editcontent'])){

            $editcontent= trim($_POST['editcontent']);
            $editcontent = htmlentities($editcontent);

            if(empty($editcontent)){
                $login_errors[]='You need to supply a content ';
            }

            if(empty($login_errors)) {
                $edit_title = $this->moodel->edit_post_content($postId, $editcontent);
            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        if(isset($_POST['ChangeCategory'])){

            $edit_title = $this->moodel->edit_post_category($postId,$_POST['selectCategory']);

        }

        if(isset($_POST['ChangeTags'])){

            $edit_title = $this->moodel->change_tags($postId,$_POST['selectTags']);

          //  $tags_by_post = $this->moodel->get_tags_by_post($postId);

        }

        $user_post= $this->moodel->get_post($postId);
        $categories = $this->moodel->get_all_categories();

        $categories_have = $this->moodel->get_all_categories_post_have($postId);

        //Tags
        $tag_class = '\Controllers\Tag_Controller';
        $tag = new $tag_class();
        $tags= $tag->moodel->find();

        $tags_by_post = $this->moodel->get_tags_by_post($postId);
        //var_dump($tags_by_post);

        $template_name = DX_ROOT_DIR.$this->views_dir.'edit_post.php';
        include_once $this->layout;
    }
}