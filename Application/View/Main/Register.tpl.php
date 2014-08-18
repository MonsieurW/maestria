<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('stylesheet');
?>
<link href="/css/login.css" rel="stylesheet">
<?php
$this->endBlock();
$this->block('container');
?>
<div class="container">    
    <div style="margin-top:50px" class="login-container col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="post" action="/register">
                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Login</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="login" placeholder="Login">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="passwd" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->                                        
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-info"><i class="fa fa-sign-in"></i> Sign Up</button>
                            <a href="/login" class="btn btn-success"><i class="fa fa-unlock"></i> Sign In</a>
                        </div>
                    </div>
                </form>
             </div>
        </div>
     </div> 
</div>
<?php $this->endBlock(); ?>