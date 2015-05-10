
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
        <?php $counter = 1; ?>

        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>User</th>
                <th>Post Title</th>
                <th>Post Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach( $posts as $p ) :?>
                <tr>
                    <?php
                    $picture = '"'.'../images/avatar.png'.'"';
                    $red = '"'.'"';

                    if( $_SESSION['username'] == $p['UserName'] ){
                        $picture = '"'.'../images/2115.jpg'.'"';
                        $red = '"'.'text-danger'.'"';
                    }

                    ?>
                    <td><?php echo $counter; $counter++; ?></td>
                    <td><img src=<?php echo $picture; ?> width='40px' height='40px'></td>
                    <td class=<?php echo $red; ?>><?php echo $p['UserName']; ?></td>
                    <td><a class="btn btn-link" href="users_comments/<?php echo $p['PostId']; ?>"><?php echo $p['Title']; ?></a></td>
                    <td><?php echo $p['PostDate']; ?></td>
                </tr>
            <?php endforeach; ?>



            </tbody>
        </table>

    </div>
    <div class='col-md-4'>
        <div class="list-group">
            <a href="#" class="list-group-item active" style="text-align: center">
                Search Options
            </a>
            <a href="#" class="list-group-item">
            <form method="POST" class="form-horizontal">
                <div class="form-group">
                    <span class="label col-lg-offset-1 label-primary">View by Category</span>
                    <div class="col-lg-10 col-lg-offset-1 input-group">
                        <select class="form-control" id="select" name="selectCategory">
                            <?php foreach( $categories as $c ) :?>
                                <option value="<?php echo $c['CategoryId']; ?>"><?php echo $c['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span> </span>
                    <span class="input-group-btn">
                      <button type="submit" name="submitCategory" class="btn btn-primary btn-primary">View</button>
                    </span>
                    </div>
                </div>
            </form>
            </a>
            <a href="#" class="list-group-item">
            <form method="POST" class="form-horizontal">
                <div class="form-group">
                    <span class="label col-lg-offset-1 label-info">View by Tag</span>
                    <div class="col-lg-10 col-lg-offset-1 input-group">
                        <select class="form-control" id="select" name="selectTag">
                            <?php foreach( $tags as $t ) :?>
                                <option value="<?php echo $t['TagId']; ?>"><?php echo $t['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span> </span>
                    <span class="input-group-btn">
                      <button type="submit" name="submitTag" class="btn btn-primary btn-info">View</button>
                    </span>
                    </div>
                </div>
            </form>
            </a>
            <a href="#" class="list-group-item">
                <form method="POST" class="form-horizontal">
                    <div class="form-group">

                        <div class="col-lg-10 col-lg-offset-1 input-group">

                            <span class="input-group-btn">
                              <button type="submit" name="viewAll" class="btn btn-default btn-primary  btn-lg btn-block">View All</button>

                            </span>

                        </div>
                    </div>
                </form>
            </a>

        </div>


    </div>
    <div class='row'></div>
</div>