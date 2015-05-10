<?php

namespace Admin\Controllers;
class Admin_Controller extends \Controllers\Master_Controller {

    public function __construct( $class_name = 'Admin\Controllers\Admin_Controller', $model = 'master', $views_dir = 'views/admin/master/' ) {
        parent::__construct( $class_name, $model, $views_dir );

        $auth = \Lib\Auth::get_instance();
        $logged_user = $auth->get_logged_user();

        $this->layout = DX_ROOT_DIR.'/views/layout/admin_default.php';

        if( empty( $logged_user) ) {
            header("Location: " . DX_ROOT_URL . 'login/index' );

           // die('No access allowed here !');
        }
    }
}