
<ul class="nav nav-tabs" role="tablist">
<?php foreach ($users as $key => $value) { ?>
	<li><a href="#u<?php echo $value['idProfil']; ?>" role="tab" data-toggle="tab"><?php echo $value['user']; ?></a></li>
<?php } ?>
</ul>

<!-- Tab panes -->

<div class="tab-content">
<?php foreach ($users as $key => $value) { ?>
	<div class="tab-pane" id="u<?php echo $value['idProfil']; ?>">
	<?php foreach ($questions as $q) {

		$rep = '-1';
		if(isset($answers[$value['idProfil']]) and isset($answers[$value['idProfil']][$q['idQuestion']]))
		{
			$rep = strval($answers[$value['idProfil']][$q['idQuestion']]);
		}


		$t1 = 0;
		$t2 = 0;

		if(isset($sticker[$value['idProfil']]) and isset($sticker[$value['idProfil']][$q['idQuestion']])) {
			$t1 = $sticker[$value['idProfil']][$q['idQuestion']]['t1'];
			$t2 = $sticker[$value['idProfil']][$q['idQuestion']]['t2'];
		}

        echo '<div class="col-md-2 borde" style="margin-top: 10px;"><h4>'.$q['title'].'</h4>
	    <p><span class="label label-default">'.$q['note'].'</span><span class="label label-'.$q['taxoPrincipal-c'].' pull-right">'.$q['taxoPrincipal'].'</span></p>';
	    
	    $item = function($css, $title, $content, $align = 'left') {
	    	return '<button type="button" class="btn btn-'.$css.' pull-'.$align.'" data-title="'.$title.'" data-toggle="popover" data-content="'.$content.'">
	    	<i class="glyphicon glyphicon-indent-left"></i></button>';
	    };

	    $btn = function($note, $data, $title, $align = 'left') use ($item) {
	  		if($note >= 0.75)
		    	return $item('success', $title, $data, $align);
		    else if($note < 0.75 and $note >= 0.5)
		    	return $item('info', $title, $data, $align);
		    else if($note > 0.50 and $note >= 0.25)
		    	return $item('warning', $title, $data, $align);
		    else
		    	return $item('danger', $title, $data, $align);
	    };

	    echo $btn($t1, $q['item1'], $q['theme1-c'], 'left');
	    echo $btn($t2, $q['item2'], $q['theme2-c'], 'right');

		echo '<p class="options">
			<input type="radio" id="u'.$value['idProfil'].'q1_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="2" '.(($rep === '2') ? 'checked' : '').'/>
			<label class="top" for="u'.$value['idProfil'].'q1_'.$q['idQuestion'].'">A</label><br />

			<input type="radio" id="u'.$value['idProfil'].'q2_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="1" '.(($rep === '1') ? 'checked' : '').'/>
			<label class="mid" for="u'.$value['idProfil'].'q2_'.$q['idQuestion'].'">B</label><br />

			<input type="radio" id="u'.$value['idProfil'].'q3_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="0" '.(($rep === '0') ? 'checked' : '').'/>
			<label class="min" for="u'.$value['idProfil'].'q3_'.$q['idQuestion'].'">C</label>

			<input type="radio" id="u'.$value['idProfil'].'q3_'.$q['idQuestion'].'" name="u'.$value['idProfil'].'q'.$q['idQuestion'].'" value="-1" '.(($rep === '-1') ? 'checked' : '').'/>
		</p>
	</div>';
    } ?>
	</div>
<?php } ?>
 </div>
