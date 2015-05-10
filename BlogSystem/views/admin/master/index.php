

<div class="panel panel-default">
    <div class="panel-body">
        <h2 style="text-align: center;">Users Information</h2>
    </div>
</div>
<?php $counter = 1; ?>

<table class="table table-striped table-hover ">
    <thead>
    <tr>
        <th class="text-warning"></th>
        <th class="text-warning">UserId</th>
        <th class="text-warning">UserName</th>
        <th class="text-warning">FirstName</th>
        <th class="text-warning">LastName</th>
        <th class="text-warning">Password</th>
        <th class="text-warning"></th>
        <th class="text-warning"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach( $users as $u ) :?>
        <tr>
            <td class="text-danger"><?php echo $counter; $counter++; ?></td>
            <td><span class="label label-info"><?php echo $u['UserId']; ?></span></td>
            <td><?php echo $u['UserName']; ?></td>
            <td><?php echo $u['FirstName']; ?></td>
            <td><?php echo $u['LastName']; ?></td>
            <td><?php echo $u['Password']; ?></td>
            <td><a class="btn btn-success btn-primary btn-sm" href="info/<?php echo $u['UserId']; ?>">Edit User</a></td>
            <td>
                <form class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <input type="hidden" name="deleteuser" value="<?php echo $u['UserId']; ?>"/>
                            <button type="submit" class="btn btn-primary btn-sm">Delete User</button>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class='jumbotron'>

    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="col-lg-4 col-lg-offset-3">Categories Info</h3>
        </div>
    </div>

    <?php foreach( $categories as $c ) :?>
        <div class="row col-lg-offset-2">
    <div class="col-md-8 " >
        <form method="POST" class="form-horizontal">
            <div class="form-group">

                <div class="col-lg-5 input-group">
                    <input type="text" class="form-control" id="inputEmail" name="editcategory_name" placeholder="<?php echo $c['Name']; ?>">
                    <span> </span>
                      <span class="input-group-btn">
                          <input type="hidden" name="editcategory_id" value="<?php echo $c['CategoryId']; ?>"/>
                          <button type="submit" name="editcategory_btn" class="btn btn-primary btn-success">Edit</button>
                      </span>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-4   " >
        <form method="POST" class="form-horizontal">
            <div class="form-group">
                <div class="col-lg-5 input-group">
                      <span class="input-group-btn">

                          <input type="hidden" name="deletecategory_id" value="<?php echo $c['CategoryId']; ?>"/>
                          <button type="submit" name="deletecategory_btn" class="btn btn-primary btn-info">Delete Category</button>
                      </span>
                </div>
            </div>
        </form>
     </div>
    </div>



    <?php endforeach; ?>

    <form method="POST" class="form-horizontal">
        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-2 input-group">
                <input type="text" name="add_category" class="form-control" id="inputEmail" placeholder="Category name ...">
                    <span> </span>
                  <span class="input-group-btn">
                    <button type="submit" name="addcategory_btn" class="btn btn-primary btn-warning">Add Category</button>
                  </span>
            </div>
        </div>
    </form>

</div>

<div class='jumbotron'>

    <div class="panel panel-info">
        <div class="panel-body">
            <h3 class="col-lg-4 col-lg-offset-3">Tags Info</h3>
        </div>
    </div>

    <?php foreach( $tags as $t ) :?>
        <div class="row col-lg-offset-2">
            <div class="col-md-8 " >
                <form method="POST" class="form-horizontal">
                    <div class="form-group">

                        <div class="col-lg-5 input-group">
                            <input type="text" class="form-control" id="inputEmail" name="edittag_name" placeholder="<?php echo $t['Name']; ?>">
                            <span> </span>
                      <span class="input-group-btn">
                          <input type="hidden" name="edittag_id" value="<?php echo $t['TagId']; ?>"/>
                          <button type="submit" name="edittag_btn" class="btn btn-primary btn-success">Edit</button>
                      </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4   " >
                <form method="POST" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-lg-5 input-group">
                      <span class="input-group-btn">

                          <input type="hidden" name="deletetag_id" value="<?php echo $t['TagId']; ?>"/>
                          <button type="submit" name="deletetag_btn" class="btn btn-primary btn-info">Delete Tag</button>
                      </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    <?php endforeach; ?>

    <form method="POST" class="form-horizontal">
        <div class="form-group">
            <div class="col-lg-5 col-lg-offset-2 input-group">
                <input type="text" name="add_tag" class="form-control" id="inputEmail" placeholder="Tag name ...">
                <span> </span>
                  <span class="input-group-btn">
                    <button type="submit" name="addtag_btn" class="btn btn-primary btn-warning">Add Tag</button>
                  </span>
            </div>
        </div>
    </form>

</div>
