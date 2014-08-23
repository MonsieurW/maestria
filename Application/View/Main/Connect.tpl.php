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
	<div class="lcont login-container">
		<?php
			if(isset($hasError) and $hasError === true)
				echo '<div class="error"><b><i class="fa fa-frown-o"></i></b> Something went wrong !</div>';
		?>
        <div class="form-box">
            <p>use admin/admin</p>
            <form action="/login" method="post">
                <input name="user" type="text" placeholder="username">
                <input name="password" type="password" placeholder="password">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
                <!--a href="/register" class="btn btn-success btn-block">Sign-in</a-->
                <p>Ask an administrator for register into the application thank you.</p>
            </form>
        </div>
     </div>
</div>
<?php $this->endBlock(); ?>