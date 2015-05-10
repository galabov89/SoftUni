<!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="/BlogSystem/css/admin/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="/BlogSystem/css/user/bootstrap_style.css">

            <title>Admin Panel All Users</title>
            <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
            <script src="/BlogSystem/javascript/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
            <script src="/BlogSystem/javascript/app.js"></script>
            <script src="/BlogSystem/javascript/appconfirm.js"></script>
        </head>
        <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <?php
                if( ! empty($this->logged_user))
                {
                    echo'
                    <ul class="nav navbar-nav navbar-left">
                        <li><a  class="btn btn-warning" href='.DX_ROOT_URL.'login/logout'.'>Logout</a>'.'</li>
                    </ul>';
                }
                ?>
                <div class="navbar-header">
                    <?php
                        if(  empty($this->logged_user)){
                            echo '<a class="navbar-brand" href="">Blog System</a>';
                        }
                        ?>
                        <?php
                        if( ! empty($this->logged_user)){

                            echo '<span> </span><a class="navbar-brand" href="#">  Hello, '. $this->logged_user['UserName'].' !'.'</a>';
                        }
                    ?>
                </div>

            </div>
        </nav>