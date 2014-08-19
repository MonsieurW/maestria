<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');

$group = function($bool , $label, $class) {
    if($bool === true)
      return ' <span class="label label-'.$class.'">'.$label.'</span>';
};
?>

<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3">
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $user; ?></h3> 
              <?php 
                if(isset($isAdmin)) echo $group($isAdmin, 'Administrator', 'danger');
                if(isset($isModerator)) echo $group($isModerator, 'Moderator', 'warning');
                if(isset($isProfessor)) echo $group($isProfessor, 'Professor', 'success');
              ?>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Login :</td>
                        <td><?php echo $login; ?></td>
                      </tr>
                    <?php if(isset($domain) and !empty($domain)) { ?>
                      <tr>
                        <td>Domain:</td>
                        <td>
                        <?php foreach ($domain as $v) {
                          echo $group(true, ucfirst($v), 'success');
                        }
                        ?>
                        </td>
                      </tr>
                      <?php } ?>
                      <?php if(isset($class) and !empty($class)) { ?>
                      <tr>
                        <td>Classroom:</td>
                        <td>
                        <?php foreach ($class as $v) {
                          echo $group(true, $v['name'], 'info');
                        }
                        ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <?php if(isset($isAdmin) and $isAdmin === true) { ?>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                        <?php } ?>
                    </div>
          </div>
        </div>
      </div>
    </div>
<?php $this->endBlock(); ?>