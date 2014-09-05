<?php
$this->inherits('hoa://Application/View/Layout/Base.tpl.php');
$this->block('container');
?>
<div class="container">
	<div class="alert alert-danger">
		<p><b>Error</b></p>
		<p>Access not authorized</p>
	</div>
</div>
<?php 
$this->endBlock();
 ?>