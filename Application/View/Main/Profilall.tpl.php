<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');

$group = function($bool , $label, $class) {
    if($bool === true)
      return ' <span class="label label-'.$class.'">'.$label.'</span>';
};

?>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Group</th>
        <th>Classroom</th>
        <th>Domain</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($all as $user) {?>
      <tr>
        <td><a href="/user/<?php echo $user['idProfil']; ?>"><?php echo $user['login']; ?></a></td>
        <td><?php echo $user['user']; ?></td>
        <td>          
<?php
        $isAdmin = $user['isAdmin'];
        $isModerator = $user['isModerator'];
        $isProfessor = $user['isProfessor'];
        if(isset($isAdmin)) echo $group($isAdmin, 'Administrator', 'danger');
        if(isset($isModerator)) echo $group($isModerator, 'Moderator', 'warning');
        if(isset($isProfessor)) echo $group($isProfessor, 'Professor', 'success');
?>

        </td>
        <td>
<?php
        if(isset($user['class']))
          foreach($user['class'] as $v)
            echo $group(true, ucfirst($v['name']), 'info');
?>
        </td>
        <td>
<?php
        if(isset($user['domain']))
          foreach($user['domain'] as $v)
            echo $group(true, ucfirst($v), 'success');
?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>  
<?php $this->endBlock(); ?>