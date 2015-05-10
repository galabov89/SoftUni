


<div class="panel panel-default">
    <div class="panel-body">
        <h2  class="text-info">Edit Post Information</h2>
    </div>
</div>


<form method="POST" class="form-horizontal">
    <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label text-success">Title :</label>
        <div class="col-lg-5 ">
            <span class="help-block"><?php echo $user_post[0]['Title'];?> </span>
            <input type="text" class="form-control" id="inputEmail" placeholder="Title" name="edittitle">
            <button type="submit" class="btn btn-primary btn-success">Edit Title</button>

        </div>
    </div>
</form>

<form method="POST" class="form-horizontal">
    <div class="form-group">

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label text-success">Content :</label>
            <div class="col-lg-5">
                  <span class="help-block"><?php echo $user_post[0]['Content'];?></span>
                  <textarea class="form-control" rows="10" id="textArea" name="editcontent"></textarea>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary btn-success">Edit Content</button>
                </div>
            </div>

        </div>
    </div>
</form>

<div class="jumbotron">

    <form class="form-horizontal">
        <div class="form-group col-lg-offset-4">

                <label for="inputEmail" class="col-lg-1 control-label text-muted col-lg-offset-1">
                     Category:<span class="col-lg-offset-1 label label-info"><?php echo $categories_have[0]['Name']; ?></span>
                </label>

        </div>
    </form>

    <form method="POST" class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label text-success">Edit Category</label>
            <div class="col-lg-5 input-group">
                <select class="form-control" id="select" name="selectCategory">
                    <?php foreach( $categories as $c ) :?>
                        <option value="<?php echo $c['CategoryId']; ?>"><?php echo $c['Name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span> </span>
          <span class="input-group-btn">
            <button type="submit" name="ChangeCategory" class="btn btn-primary btn-success">Edit</button>
          </span>
            </div>
        </div>
    </form>


</div>

<div class="jumbotron">

    <form class="form-horizontal">
        <div class="form-group col-lg-offset-4">

            <label for="inputEmail" class="col-lg-1 control-label text-muted col-lg-offset-1">
                Tags:
                <?php foreach( $tags_by_post as $t ) :?>
                    <span class="col-lg-offset-12 label label-info tag-class">
                        <?php echo $t['Name']; ?>
                    </span>
                <?php endforeach; ?>
            </label>

        </div>
    </form>

    <form method="POST" class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label text-success">Edit Tags</label>
            <div class="col-lg-5 input-group">
                <select multiple class="form-control" id="select" name="selectTags[]">
                    <?php foreach( $tags as $t ) :?>
                        <option value="<?php echo $t['TagId']; ?>"><?php echo $t['Name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span> </span>

            <button type="submit" name="ChangeTags" class="btn btn-primary btn-success">Edit</button>

            </div>
        </div>
    </form>


</div>