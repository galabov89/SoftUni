<div><?php echo $login_text ?></div>


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
        <div class='col-md-4'>
        </div>
        <div class='col-md-8'>
            <form method="POST" class="form-horizontal">
                <fieldset>
                    <legend>Login</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control" id="title" placeholder="Username...">
                        </div>
                        <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" class="form-control" id="title" placeholder="Password...">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-5 col-lg-offset-8">

                            <button type="submit" class="btn btn-primary">Login</button>
                            <a  href="register">Register</a>
                        </div>

                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class='col-md-4'>

    </div>
    <div class='row'></div>
</div>