<?php

namespace Controllers;

class Post_Controller extends Master_Controller{

    public function __construct() {
        parent::__construct( get_class(),'posts', '/views/posts/');
    }

    public function index(){

        $posts = $this->moodel->find();

        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

    public function view($id){

        $posts = $this->moodel->get('Post',$id);

        $template_name = DX_ROOT_DIR.$this->views_dir.'post_title.php';
        include_once $this->layout;
    }

    public function post_titles(){

        $posts = $this->moodel->find();

        $template_name = DX_ROOT_DIR.$this->views_dir.'post_titles.php';
        include_once $this->layout;
    }

    public function user_index(){

        $login_text = '';
        $user = $this->logged_user;

        if (  isset( $_POST['title'] ) && isset( $_POST['content'] )) {

            $login_errors = array();

            $title = trim($_POST['title']);
            $title = htmlentities($title);

            $content = trim($_POST['content']);
            $content = htmlentities($content);

            if(empty($title)){
                $login_errors[]='You need to supply a title';
            }

            if(empty($content)){
                $login_errors[]='You need to supply a content';
            }

            if(strlen($title)>50){
                $login_errors[]='Title cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $auth = \Lib\Auth::get_instance();

                $post_date = date("Y-m-d H:i:s");

                $logged_in = $auth->make_a_post($title, $content, $_POST['selectCategory'], $_SESSION['user_id'], $post_date);

                $inser_tags = $auth->insert_tags($title, $content, $_POST['selectCategory'], $_SESSION['user_id'], $post_date, $_POST['selectTag']);
                var_dump($inser_tags);
                $post_text = '';

                if (!$logged_in) {
                    $post_text = 'Post not successful.';

                } else {
                    header("Location: " . DX_ROOT_URL . 'post/user_index');
                }
            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }
        }

        if(empty($user)){
            header("Location: ". DX_ROOT_URL.'login/index');
        }

        $posts = $this->moodel->find_by_user();

        //Categories
        $category_class = '\Controllers\Category_Controller';
        $category = new $category_class();
        $categories = $category->moodel->find();

        //Tags
        $tag_class = '\Controllers\Tag_Controller';
        $tag = new $tag_class();
        $tags= $tag->moodel->find();



        $template_name = DX_ROOT_DIR.$this->views_dir.'user_index.php';
        include_once $this->layout;
    }

    public function user_view($id){
        $postHeader = $this->moodel->get('Post',$id);
        $posts = $this->moodel->find_by_user();

        $template_name = DX_ROOT_DIR.$this->views_dir.'user_view.php';
        include_once $this->layout;
    }

    public function users_view_all(){

        $posts = array();
       // $posts = $this->moodel->find();

        $posts = $this->moodel->find_posts_authors();
       // var_dump($test);

        if(isset($_POST['submitCategory'])){
            $posts = $this->moodel->get_post_by_category($_POST['selectCategory']);
           // var_dump($posts);
        }

        if(isset($_POST['submitTag'])){
            $posts = $this->moodel->get_post_by_tag($_POST['selectTag']);
            // var_dump($posts);
        }

        if(isset($_POST['viewAll'])){
            $posts = $this->moodel->find_posts_authors();
        }


        //Categories
        $category_class = '\Controllers\Category_Controller';
        $category = new $category_class();
        $categories = $category->moodel->find();

        //Tags
        $tag_class = '\Controllers\Tag_Controller';
        $tag = new $tag_class();
        $tags= $tag->moodel->find();



        $template_name = DX_ROOT_DIR.$this->views_dir.'users_view_all.php';
        include_once $this->layout;
    }

    public function users_comments($postid){

        $login_text = '';
        $user = $this->logged_user;

        if (  isset( $_POST['comment'] )) {

            $login_errors = array();

            $comment= trim($_POST['comment']);
            $comment = htmlentities($comment);

            if(empty($comment)){
                $login_errors[]='You need to supply comment content';
            }

            if(strlen($comment)>250){
                $login_errors[]='Comment cannot be longer than 250 characters.';
            }

            if(empty($login_errors)) {

                $auth = \Lib\Auth::get_instance();
                $logged_in = $auth->make_a_comment($comment, $_SESSION['user_id'], $postid);

                echo 'I am in comment view ';

                $post_text = '';

                if (!$logged_in) {
                    $post_text = 'Comment not successful.';

                } else {
                    header("Location: " . DX_ROOT_URL . 'post/users_comments/' . $postid);
                }
            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }
        }

        $posts = $this->moodel->find_users_posts($postid);
        //var_dump($posts);



        $no_comments =false;
        $init_key = key($posts);

        if(array_key_exists ( 0 , $posts)){
           // echo 'The result is empty';
            $posts = $this->moodel->get_post_for_user($postid);
            $no_comments =true;
        }

        $postString = array_key_exists ( 0 , $posts)!=true ? key($posts):$posts[0]['Title'].' | '.$posts[0]['Content'].' | '.$posts[0]['UserName'];

        $postInfo = explode(' | ',$postString);
        $title = $postInfo[0];
        $content = $postInfo[1];
        $owner = $postInfo[2];

        $all_posts = $this->moodel->find();

        $template_name = DX_ROOT_DIR.$this->views_dir.'users_comments.php';
        include_once $this->layout;
    }

    public function user_about($userId){

        $user = $this->moodel->get_user_info($userId);

        $template_name = DX_ROOT_DIR.$this->views_dir.'user_about.php';
        include_once $this->layout;
    }
}