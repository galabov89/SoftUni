

<h2 class="text-info">Edit User Information:</h2>

<form method="POST" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">UserName</label>
        <div class="col-lg-5 input-group">
            <input type="text" class="form-control" id="inputEmail" name="username" placeholder="<?php echo $users[0]['UserName'] ?>">
            <span> </span>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-success">Edit</button>
          </span>
        </div>
    </div>
</form>
<form method="POST" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">FirstName</label>
        <div class="col-lg-5 input-group">
            <input type="text" class="form-control" id="inputEmail" name="firstname" placeholder="<?php echo $users[0]['Firstname'] ?>">
            <span> </span>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-success">Edit</button>
          </span>
        </div>
    </div>
</form>
<form method="POST" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">LastName</label>
        <div class="col-lg-5 input-group">
            <input type="text" class="form-control" id="inputEmail" name="lastname" placeholder="<?php echo $users[0]['LastName'] ?>">
            <span> </span>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-success">Edit</button>
          </span>
        </div>
    </div>
</form>

<?php $counter = 1; ?>
<div class='jumbotron'>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 style="text-align: center;" >Edit Posts Information</h2>
        </div>
    </div>


    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th class="text-warning"></th>
            <th class="text-warning">PostId</th>
            <th class="text-warning">Post Title</th>
            <th class="text-warning"></th>
            <th class="text-warning"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $user_posts as $p ) :?>
            <tr>
                <td><?php echo $counter; $counter++; ?></td>
                <td><span class="label label-info"><?php echo $p['PostId'];; ?></span></td>
                <td><?php echo $p['Title']; ?></td>
                <td>
                    <a href="<?php  echo DX_ROOT_URL; ?>admin/user/edit_post/<?php echo $p['PostId']; ?>" class="btn btn-success btn-primary btn-sm">Edit Post</a>
                </td>
                <td>
                    <form method="POST" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <input type="hidden" name="deletepost" value="<?php echo $p['PostId']; ?>"/>
                                <button type="submit" class="btn btn-primary btn-sm" >Delete Post</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $counter = 1; ?>
<div class='jumbotron'>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 style="text-align: center;" >Edit Comments Information</h2>
        </div>
    </div>


    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th class="text-warning"></th>
            <th class="text-warning">CommentId</th>
            <th class="text-warning">Comment Content</th>
            <th class="text-warning"></th>
            <th class="text-warning"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $user_comments as $c ) :?>
            <tr>
                <td><?php echo $counter; $counter++; ?></td>
                <td><span class="label label-info"><?php echo $c['CommentId'];; ?></span></td>
                <td><?php echo $c['Content']; ?></td>
                <td>
                    <a href="<?php  echo DX_ROOT_URL; ?>admin/user/edit_comment/<?php echo $c['CommentId']; ?>" class="btn btn-success btn-primary btn-sm">Edit Comment</a>
                </td>
                <td>
                    <form method="POST" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <input type="hidden" name="deletecomment" value="<?php echo $c['CommentId']; ?>"/>
                                <button type="submit" class="btn btn-primary btn-sm">Delete Comment</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>




