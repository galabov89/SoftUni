<?php

namespace Controllers;
class Login_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct( get_class(), 'master', '/views/login/' );
    }

    public function index() {

        $login_text = '';
        $user = $this->logged_user;


        if ( empty( $user ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {

            $login_errors = array();

            $username = trim($_POST['username']);
            $username = htmlentities($username);
            $password = trim($_POST['password']);
            $password = htmlentities($password);

            if(empty($username)){
                $login_errors[]='You need to supply a username';
            }

            if(empty($password)){
                $login_errors[]='You need to supply a password';
            }

            if(strlen($username)>15){
                $login_errors[]='Username cannot be longer than 15 characters.';
            }

            if(empty($login_errors)){

                $auth = \Lib\Auth::get_instance();
                $logged_in = $auth->login( $_POST['username'], $_POST['password'] );
                //var_dump($logged_in);


                $username = "'" . $username . "'";
                $password = "'" . $password . "'";

                $db = \Lib\Database::get_instance();
                $dbconn = $db->get_db();

                $statement =  " SELECT UserId, UserName FROM users WHERE username = $username AND password =  $password  LIMIT 1" ;

                $result = mysqli_query($dbconn, $statement)or die(mysqli_error($dbconn));

                $login_text = '';

                if ( ! $logged_in ) {
                    $login_text = 'Login not successful.';

                }

                if( $_POST['username'] =='admin' && $_POST['password'] =='admin'){

                    header("Location: ". DX_ROOT_URL.'admin/user/index');
                }

                if($_POST['username'] !=='admin' &&  $_POST['password'] !=='admin'){

                    header("Location: ". DX_ROOT_URL.'post/user_index');
                }

    //            else {
    //                header("Location: ". DX_ROOT_URL.'post/user_index');
    //            }

            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . 'index.php';

        include_once  $this->layout;
    }

    public function logout() {
        $auth = \Lib\Auth::get_instance();

        $auth->logout();

        header( 'Location: ' .DX_ROOT_URL.'post/index' );
        exit();
    }

    public function register(){

        if ( isset( $_POST['username'] ) && isset( $_POST['firstname'] ) && isset( $_POST['lastname'] )&&isset( $_POST['password'] )) {

            $login_errors = array();

            $username = trim($_POST['username']);
            $username = htmlentities($username);

            $password = trim($_POST['password']);
            $password = htmlentities($password);

            $firstname = trim($_POST['firstname']);
            $firstname = htmlentities($firstname);

            $lastname = trim($_POST['lastname']);
            $lastname = htmlentities($lastname);

            if(empty($username)){
                $login_errors[]='You need to supply a username';
            }

            if(empty($firstname)){
                $login_errors[]='You need to supply a firstname';
            }

            if(empty($lastname)){
                $login_errors[]='You need to supply a lastname';
            }

            if(empty($password)){
                $login_errors[]='You need to supply a password';
            }

            if(strlen($username)>15){
                $login_errors[]='Username cannot be longer than 15 characters.';
            }

            if(strlen($firstname)>50){
                $login_errors[]='Firstname cannot be longer than 50 characters.';
            }

            if(strlen($lastname)>50){
                $login_errors[]='Lastname cannot be longer than 50 characters.';
            }

            if(empty($login_errors)) {

                $auth = \Lib\Auth::get_instance();
                $is_registered = $auth->register($username, $firstname, $lastname, $password);

                $register_text = '';

                if (!$is_registered) {
                    $register_text = 'Register not successful.';

                } else {
                    header("Location: " . DX_ROOT_URL . 'login/index');
                }
            }

            if(isset($login_errors) && ! empty($login_errors)){
                //var_dump($login_errors);
                echo '<p></p>';
                //var_dump($login_errors);

                echo '<script type="text/javascript">'. 'var array ='.json_encode($login_errors). '</script>';

            }
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . 'register.php';

        include_once  $this->layout;
    }
}