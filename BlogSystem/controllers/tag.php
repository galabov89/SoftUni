<?php

namespace Controllers;

class Tag_Controller extends Master_Controller{

    public function __construct() {
        parent::__construct( get_class(),'tags', '/views/tag/');
    }

    public function index(){

        $tags = $this->moodel->find();
        var_dump($tags);
        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

    public function view($id){

        $tags = $this->moodel->get('Tag',$id);

        $template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
        include_once $this->layout;
    }

}