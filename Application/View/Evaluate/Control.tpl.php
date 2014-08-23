<?php foreach ($question as $q) { ?>
		<div class="col-md-4 borde">
		        <h4><?php echo $q['title']; ?></h4>
		        <p>
		        	<span class="label label-success"><?php echo $q['note']; ?></span>
		        	<span class="label label-danger pull-right"><?php echo $q['taxoPrincipal']; ?></span>
		        <p>

		        	<span class="label label-default">Item 1</span>
		        	<span class="label label-default">Item 2</span>
		        </p>
		        <p>
		        	<input type="radio" id="q1_<?php echo $q['idQuestion']; ?>" name="q<?php echo $q['idQuestion']; ?>" value="2" />
					<label class="top" for="q1_<?php echo $q['idQuestion']; ?>">A</label><br />
					<input type="radio" id="q2_<?php echo $q['idQuestion']; ?>" name="q<?php echo $q['idQuestion']; ?>" value="1" />
					<label class="mid" for="q2_<?php echo $q['idQuestion']; ?>">B</label><br />
					<input type="radio" id="q3_<?php echo $q['idQuestion']; ?>" name="q<?php echo $q['idQuestion']; ?>" value="0" />
					<label class="min" for="q3_<?php echo $q['idQuestion']; ?>">C</label>
					<input type="radio" id="q3_<?php echo $q['idQuestion']; ?>" name="q<?php echo $q['idQuestion']; ?>" value="-1" checked/>

		        </p>
		</div>
		        
<?php } ?>