<?php

namespace Admin\Controllers;

class Post_Controller extends Admin_Controller{

    public function __construct($class_name = 'Admin\Controllers\Post_Controller',
                                $model = 'master',
                                $views_dir = 'views/admin/master' ) {

        parent::__construct( get_class(),'posts', '/views/admin/master');
    }

    public function index(){

        $model_class="\Models\\".ucfirst( 'posts' )."_Model";
        //$this->moodel = new $model_class();
        $posts = $this->moodel->find();
        //var_dump($posts);
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
}