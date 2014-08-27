<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<div class="container">
		<table class="table" id="table1" data-id="<?php echo $classId; ?>">
		<tr>
			<th>Users</th>
			<th class="col-lg-1"></th>
			<th class="col-lg-1"></th>
		</tr>
		<?php if (isset($users)) {
            foreach ($users as $value) {
                echo '<tr data-id="'.$value['idProfil'].'">
					<td><a href="/user/'.$value['idProfil'].'">'.$value['user'].'</a></td>
					<td>
						<!--div class="btn-group">
							<a href="#" class="btn btn-info">
								<i class="glyphicon glyphicon-chevron-up"></i>
							</a>
							<a href="#" class="btn btn-info">
								<i class="glyphicon glyphicon-chevron-down"></i>
							</a>
						</div-->
					</td>
					<td>
						<a href="#" class="remove btn btn-danger">
							<i class="glyphicon glyphicon-remove"></i>
						</a>
					</td>
				</tr>';
            }
        }?>
	</table>
</div>
<div class="container">
	<p>
		<a href="#" id="new" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</p>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add user</h4>
      </div>
      <div class="modal-body">
        <select id="adduser" class="form-control"></select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php
$this->endBlock();
$this->block('script');
?>
<script src="/js/classroom.add.js"></script>
<?php
$this->endBlock();
