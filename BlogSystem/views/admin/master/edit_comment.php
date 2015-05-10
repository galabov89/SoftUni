

<div class="panel panel-default">
    <div class="panel-body">
        <h2  class="text-info">Edit Comment Information</h2>
    </div>
</div>

<form class="form-horizontal" method="POST">
    <div class="form-group">

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label text-success">Content :</label>
            <div class="col-lg-5">
              <span class="help-block">
                  <?php echo $user_comment[0]['Content'];?>
              </span>
                <textarea class="form-control" rows="10" id="textArea" name="editcomment"></textarea>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary btn-success">Edit Comment</button>
                </div>
            </div>

        </div>
    </div>
</form>