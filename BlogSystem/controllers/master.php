<?php

namespace Controllers;

class Master_Controller{

    protected $layout;
    protected $views_dir;

    public function __construct( $class_name='\Controllers\Master_Controller',$model='master', $views_dir = '/views/master/'){

        $this->views_dir = $views_dir;
        $this->class_name = $class_name;

        include_once DX_ROOT_DIR.'models/'.$model.'.php';
        $model_class="\Models\\".ucfirst( $model )."_Model";
       // var_dump($model_class);

        $this->moodel = new $model_class( array('table'=>'none'));

        $this->layout = DX_ROOT_DIR.'/views/layout/default.php';

        $this->model_name = $model;

        $auth = \Lib\Auth::get_instance();

        $this->logged_user =$auth->get_logged_user();
    }


}