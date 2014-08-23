<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('stylesheet');
?>
<link href="/css/login.css" rel="stylesheet">
<link href="/css/bootstrap-tagsinput.css" rel="stylesheet">
<?php
$this->endBlock();
$this->block('container');
?>
<div class="container">    
    <div style="margin-top:50px" class="login-container col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        
        <form class="form-horizontal" role="form" method="post" action="/user/<?php echo $idProfil; ?>" style="margin-top: 10px; margin-bottom: 10px">
            <div class="form-group">
                <label for="firstname" class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="name" placeholder="Nom" value="<?php echo $user; ?>">
                </div>
            </div> 
            <div class="form-group">
                <label for="firstname" class="col-md-3 control-label">Login</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="login" placeholder="Login" value="<?php echo $login; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Ancien Password</label>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="oldpasswd" placeholder="Password">
                </div>
            </div>         
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="passwd" placeholder="Password">
                </div>
            </div>   
            <?php 
                if($isProfessor === true)   {
            ?>
            <div class="form-group">
                <label for="classroom" class="col-md-3 control-label">Classroom</label>
                <div class="col-md-9">
                    <input type="text" value="<?php echo implode(',', $class); ?>" data-role="tagsinput" name="classroom" />
                </div>
            </div>
            <div class="form-group">
                <label for="domain" class="col-md-3 control-label">Domain</label>
                <div class="col-md-9">
                    <input type="text" value="<?php echo implode(',', $domain); ?>" name="domain" data-role="tagsinput" />
                </div>
            </div>
            <?php
                }

                if($loginIsAdmin === true) {
                    ?>
                <div class="form-group">
                    <label for="classroom" class="col-md-3 control-label">ACL</label>
                    <div class="col-md-9">
                          <div class="checkbox"><label><input type="checkbox" name="isAdmin" <?php echo (isset($isAdmin) and $isAdmin === true) ? 'checked="checked"' : ''; ?>> Administrator</label></div>
                          <div class="checkbox"><label><input type="checkbox" name="isModerator" <?php echo (isset($isModerator) and $isModerator === true) ? 'checked="checked"' : ''; ?>> Moderator</label></div>
                          <div class="checkbox"><label><input type="checkbox" name="isProfessor" <?php echo (isset($isProfessor) and $isProfessor === true) ? 'checked="checked"' : ''; ?>> Professor</label></div>

                    </div>
                </div>
                    <?php
                }
            ?>
            <div class="form-group">
                <!-- Button -->                                        
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                </div>
            </div>
        </form>
     </div> 
</div>
<?php $this->endBlock();
$this->block('script');
?>
<script src="/js/bootstrap-tagsinput.js"></script>
<script src="/js/typeahead.js"></script>
<?php
$this->endBlock();
 ?>