

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
                <?php
                $picture = '"'.'../../images/avatar.png'.'"';

                if( $_SESSION['username'] == $owner ){
                    $picture = '"'.'../../images/2115.jpg'.'"';
                }

                ?>
                <img src=<?php echo $picture; ?> width='150px' height='150px'>
            </div>
            <div class="navbar-header " >
                <a class="navbar-brand" href="#"><?php echo $owner; ?></a>
            </div>
        </div>
        <div class='col-md-8'>

            <h3 class=''><?php echo  $title; ?></h3>
            <p><?php echo $content; ?></p>
            <h5 style=" text-align:right" class="text-warning">Post date: 2015.04.26</h5>

            <form method="POST" class="form-horizontal">
                <div class="form-group">
                    <span class="label label-success">Add your comment</span>
                    <div class="col-lg-13 input-group">
                        <input type="text" name="comment" class="form-control" id="inputEmail" placeholder="Add comment ... ">
                        <span> </span>
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-primary btn-success">Add</button>
                        </span>
                    </div>
                </div>
            </form>



            <?php if( $no_comments != true ) :?>
                <?php foreach( $posts[$postString] as $p ) :?>
                <?php $no_comments =false; ?>
                    <?php
                         $picture = '"'.'../../images/avatar.png'.'"';
                         $color = 'primary';
                         $upper_offset='';
                         $offset = '';

                    if($_SESSION['username'] == $p['CommentOwner']){
                        $color = 'warning';
                        $upper_offset='col-lg-offset-0';
                        $offset = 'col-lg-offset-5';
                        $picture = '"'.'../../images/2115.jpg'.'"';
                       // echo 'I am owner!!!';
                    }

                    ?>
                    <div>
                        <div  class='col-md-4 <?php echo $upper_offset; ?>' id="img-container">
                            <div id="user-item">
                                <div class="image-container <?php echo $offset; ?>">
                                    <img src=<?php echo $picture; ?> width='50px' height='50px'>
                                </div>
                                <span class="label label-<?php echo $color; ?> <?php echo $offset; ?>"><?php echo $p['CommentOwner']; ?></span>
                            </div>
                        </div>
                        <div class='col-md-8'>
                            <h5><?php echo $p['Comment']; ?></h5>
                            <div class='col-md-8 col-lg-offset-6'>
                                <h6 class="text-warning">Date: <?php echo $p['CommentDate']; ?></h6>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>


        </div>
    </div>

    <div class='col-md-4'>
        <h2>All Posts</h2>
        <ul class="list-group">
            <?php foreach( $all_posts as $p ) :?>
            <li class="list-group-item">
                <a class="btn btn-link" href="<?php  echo DX_ROOT_URL; ?>post/users_comments/<?php echo $p['PostId']; ?>"><?php echo $p['Title']; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div class='row'></div>

</div>