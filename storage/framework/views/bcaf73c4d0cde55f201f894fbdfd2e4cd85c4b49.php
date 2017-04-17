<div class='form-group <?php echo e($header_group_class); ?> <?php echo e(($errors->first($name))?"has-error":""); ?>' id='form-group-<?php echo e($name); ?>'  style="<?php echo e(@$form['style']); ?>">
	<label class='control-label col-sm-2'><?php echo e($form['label']); ?> <?php echo ($required)?"<span class='text-danger' title='This field is required'>*</span>":""; ?></label>

	<div class="<?php echo e($col_width?:'col-sm-10'); ?>">
	<?php 
	$dataenum = $form['dataenum'];
	$dataenum = (is_array($dataenum))?$dataenum:explode(";",$dataenum);

	if($dataenum):
	foreach($dataenum as $k=>$d):
		$val = $lab = '';
		if(strpos($d,'|')!==FALSE) {
			$draw = explode("|",$d);
			$val = $draw[0];
			$lab = $draw[1];
		}else{
			$val = $lab = $d;
		}
		$select = ($value == $val)?"checked":"";
	?>	
	<label class='radio-inline'>
		<input type='radio' <?php echo e($select); ?> name='<?php echo e($name); ?>' <?php echo e(($k==0)?$required:''); ?> <?php echo e($readonly); ?> <?php echo e($disabled); ?> value='<?php echo e($val); ?>'/> <?php echo $lab; ?> 
	</label>						

	<?php endforeach; endif;?>																
	<div class="text-danger"><?php echo $errors->first($name)?"<i class='fa fa-info-circle'></i> ".$errors->first($name):""; ?></div>
	<p class='help-block'><?php echo e(@$form['help']); ?></p>

	</div>
</div>