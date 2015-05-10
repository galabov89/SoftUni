

<div class="jumbotron" >
    <div class='col-md-8' >
        <div class='row' >
            <nav class="navbar-default" >
                <div class="collapse navbar-collapse" >
                    <div class="container-fluid" >
                        <form class="navbar-form navbar-right" role="search">
                            <a type="submit" class="btn   btn-default" href="user_about/<?php echo $_SESSION['user_id']; ?>">About me</a>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <div class='col-md-4'>
            <div class="image-container">
                <img src="../images/2115.jpg" width='150px' height='150px'>
            </div>
            <div class="navbar-header " >
                <a class="navbar-brand" href="#"><?php echo $_SESSION['username']; ?></a>
            </div>
        </div>
        <div class='col-md-8'>
            <form method="POST" class="form-horizontal">
                <fieldset>
                    <legend>Make a post</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Post title...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Category</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select" name="selectCategory">
                                <?php foreach( $categories as $c ) :?>
                                    <option value="<?php echo $c['CategoryId']; ?>"><?php echo $c['Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Tags</label>
                        <div class="col-lg-10">
                            <select multiple class="form-control" id="select" name="selectTag[]">
                                <?php foreach( $tags as $t ) :?>
                                    <option value="<?php echo $t['TagId']; ?>" <?php if( $t['TagId']==1 ) :?> selected="selected" <?php endif; ?>  >
                                        <?php echo $t['Name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Content</label>
                        <div class="col-lg-10">
                            <textarea name="content" class="form-control" rows="3" id="textArea"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-5 col-lg-offset-10">
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class='col-md-4'>

        <h2>My posts</h2>
        <ul class="list-group">
            <?php foreach( $posts as $p ) :?>
                <li class="list-group-item">
                    <a class="btn btn-link" href="user_view/<?php echo $p['PostId']; ?>"><?php echo $p['Title']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>


        <div class="col-lg-5 col-lg-offset-8">
            <a class="navbar-brand btn btn-default btn-primary" href="users_view_all">View All</a>
        </div>

    </div>
    <div class='row'></div>
</div>