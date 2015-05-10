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
            <div class="alert alert-dismissible alert-info">
            <table class="table table-striped table-hover ">
                <thead>
                </thead>
                <tbody>
                    <tr >
                        <th>UserName</th>
                        <td><?php echo $user[0]['UserName'] ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-hover ">
                <thead>
                </thead>
                <tbody>
                <tr >
                    <th>FirstName</th>
                    <td><?php echo $user[0]['Firstname'] ?></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-striped table-hover ">
                <thead>
                </thead>
                <tbody>
                <tr >
                    <th>LastName</th>
                    <td><?php echo $user[0]['LastName'] ?></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-striped table-hover ">
                <thead>
                </thead>
                <tbody>
                <tr >
                    <th>Password</th>
                    <td><?php echo $user[0]['Password'] ?></td>
                </tr>
                </tbody>
            </table>
                </div>

        </div>
    </div>

    <div class='col-md-4'>

    </div>
    <div class='row'></div>

</div>