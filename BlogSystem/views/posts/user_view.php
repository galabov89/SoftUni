

<div class="jumbotron" >
    <div class='col-md-8' >
        <div class='row' >
            <nav class="navbar-default" >
                <div class="collapse navbar-collapse" >
                    <div class="container-fluid" >
                        <form class="navbar-form navbar-right" role="search">
                            <a class="btn btn-default" href="<?php  echo DX_ROOT_URL; ?>post/user_index">Make a Post</a>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <div class='col-md-4'>
            <div class="image-container">

                <img src="../../images/2115.jpg"  width='150px' height='150px'>
            </div>
        </div>
        <div class='col-md-8'>

                <h3 class=''><?php echo $postHeader[0]['Title'] ?></h3>
                <p><?php echo $postHeader[0]['Content'] ?></p>
                <h5 style=" text-align:right" class="text-warning">Post date:<?php echo $postHeader[0]['PostDate'] ?></h5>

        </div>
    </div>

    <div class='col-md-4'>
        <h2>My Posts</h2>
        <ul class="list-group">
            <?php foreach( $posts as $p ) :?>
                <li class="list-group-item">
                    <a class="btn btn-link" href="<?php  echo DX_ROOT_URL; ?>post/user_view/<?php echo $p['PostId']; ?>"><?php echo $p['Title']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class='row'></div>

</div>
