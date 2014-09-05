
<ul class="nav nav-tabs" role="tablist">
<?php foreach ($users as $key => $value) { ?>
	<li <?php echo (($key === 0) ? 'class="active"' : ''); ?>><a href="#u<?php echo $value['idProfil']; ?>" role="tab" data-toggle="tab"><?php echo $value['user']; ?></a></li>
<?php } ?>
</ul>

<!-- Tab panes -->

<div class="tab-content">
<?php foreach ($users as $key => $value) { ?>
	<div class="tab-pane <?php echo (($key === 0) ? 'active' : ''); ?>" id="u<?php echo $value['idProfil']; ?>">
	<?php foreach ($questions as $q) {
        echo '<div class="col-md-2 borde" style="margin-top: 10px;"><h4>'.$q['title'].'</h4>
	    <p><span class="label label-default">'.$q['note'].'</span><span class="label label-'.$q['taxoPrincipal-c'].' pull-right">'.$q['taxoPrincipal'].'</span></p>
	    <button type="button" class="btn btn-danger pull-left" data-toggle="popover" data-content="'.$q['item1'].'"><i class="glyphicon glyphicon-indent-left"></i></button>
	    <button type="button" class="btn btn-danger pull-right" data-toggle="popover" data-content="'.$q['item2'].'"><i class="glyphicon glyphicon-indent-right"></i></button>
		<p class="options">
			<input type="radio" id="u'.$value['idProfil'].'q1_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="2" />
			<label class="top" for="u'.$value['idProfil'].'q1_'.$q['idQuestion'].'">A</label><br />

			<input type="radio" id="u'.$value['idProfil'].'q2_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="1" />
			<label class="mid" for="u'.$value['idProfil'].'q2_'.$q['idQuestion'].'">B</label><br />

			<input type="radio" id="u'.$value['idProfil'].'q3_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="0" />
			<label class="min" for="u'.$value['idProfil'].'q3_'.$q['idQuestion'].'">C</label>

			<input type="radio" id="u'.$value['idProfil'].'q3_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="-1" checked/>
		</p>
	</div>';
    } ?>
	</div>
<?php } ?>
 </div>
