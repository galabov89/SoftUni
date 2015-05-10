

<div class="jumbotron" >
    <div class='col-md-8' >
        <div class='row' >
            <nav class="navbar-default" >
                <div class="collapse navbar-collapse" >
                    <div class="container-fluid" >
                        <form class="navbar-form navbar-right" role="search">

                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <div class='col-md-4'>
            <div class="image-container">

                <img src="../../images/avatar.png"  width='150px' height='150px'>
            </div>
        </div>
        <div class='col-md-8'>
            <?php foreach( $posts as $p ) :?>
                <h3 class=''><?php echo $p['Title']; ?></h3>
                <p><?php echo $p['Content']; ?></p>
                <h5 style=" text-align:right" class="text-warning">Post date:<?php echo $p['PostDate']; ?></h5>
            <?php endforeach; ?>
        </div>
    </div>

    <div class='col-md-4'>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Login Panel</h3>
            </div>
            <div class="panel-body">
                <a class="btn btn-default btn-primary  btn-lg btn-block" href="<?php  echo DX_ROOT_URL; ?>login/index">Login</a>
            </div>
        </div>

    </div>
    <div class='row'></div>

</div>