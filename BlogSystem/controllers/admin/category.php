<?php

namespace Admin\Controllers;

class Category_Controller extends Admin_Controller{

    public function __construct($class_name = 'Admin\Controllers\Category_Controller',
                                $model = 'master',
                                $views_dir = 'views/admin/master' ) {

        parent::__construct( get_class(),'category', '/views/admin/master');
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