<?php

namespace Controllers;

class Category_Controller extends Master_Controller{

    public function __construct() {
        parent::__construct( get_class(),'category', '/views/category/');
    }

    public function index(){

        $categories = $this->moodel->find();
        var_dump($categories);
        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

    public function view($id){

        $categories = $this->moodel->get('Category',$id);

        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

}