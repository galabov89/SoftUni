<div class="jumbotron" >
    <div class='col-md-8' >
        <div class='row' >
            <nav class="navbar-default" >
                <div class="collapse navbar-collapse" >
                    <div class="container-fluid" >

                    </div>
                </div>
            </nav>
        </div>
        <?php $counter = 1; ?>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th></th>
                <th>Post Titles</th>
                <th>Post Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach( $posts as $p ) :?>
                <tr>
                    <td><?php echo $counter;  $counter++ ; ?></td>
                    <td><a href="view/<?php echo $p['PostId']; ?>"><?php echo $p['Title']; ?></a></td>
                    <td><?php echo date("d-m-Y h:i",strtotime($p['PostDate'])); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class='col-md-4'>
        <p></p>
        <p></p>
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
