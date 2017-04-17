<?php if($form['datatable']): ?>

		<?php if($form['relationship_table']): ?>
			<script type="text/javascript">
				$(function() {
					$('#<?php echo e($name); ?>').select2();
				})
			</script>
		<?php else: ?>
			<?php 							
				$datatable = @$form['datatable'];
				$where     = @$form['datatable_where'];
				$format    = @$form['datatable_format'];													

				$raw       = explode(',',$datatable);
				$url       = CRUDBooster::mainpath("find-data");

				$table1    = $raw[0];
				$column1   = $raw[1];
				
				@$table2   = $raw[2];
				@$column2  = $raw[3];
				
				@$table3   = $raw[4];
				@$column3  = $raw[5];
			?>
			<script>				
				$(function() {
					$('#<?php echo e($name); ?>').select2({								  							  
					  placeholder: {
						    id: '-1', 
						    text: '<?php echo e(trans('crudbooster.text_prefix_option')); ?> <?php echo e($form['label']); ?>'
						},
					  allowClear: true,
					  ajax: {								  	
					    url: '<?php echo $url; ?>',								    
					    delay: 250,								   								    
					    data: function (params) {
					      var query = {
							q: params.term,
							format: "<?php echo e($format); ?>",
							table1: "<?php echo e($table1); ?>",
							column1: "<?php echo e($column1); ?>",
							table2: "<?php echo e($table2); ?>",
							column2: "<?php echo e($column2); ?>",
							table3: "<?php echo e($table3); ?>",
							column3: "<?php echo e($column3); ?>",
							where: "<?php echo addslashes($where); ?>"
					      }
					      return query;
					    },
					    processResults: function (data) {
					      return {
					        results: data.items
					      };
					    }								    								    
					  },
					  escapeMarkup: function (markup) { return markup; }, 							        							    
					  minimumInputLength: 1,
				      <?php if($value): ?>
					  initSelection: function(element, callback) {
				            var id = $(element).val()?$(element).val():"<?php echo e($value); ?>";
				            if(id!=='') {
				                $.ajax('<?php echo e($url); ?>', {
				                    data: {
				                    	id: id, 
				                    	format: "<?php echo e($format); ?>",
				                    	table1: "<?php echo e($table1); ?>",
										column1: "<?php echo e($column1); ?>",
										table2: "<?php echo e($table2); ?>",
										column2: "<?php echo e($column2); ?>",
										table3: "<?php echo e($table3); ?>",
										column3: "<?php echo e($column3); ?>"
									},
				                    dataType: "json"
				                }).done(function(data) {							                	
				                    callback(data.items[0]);	
				                    $('#<?php echo $name?>').html("<option value='"+data.items[0].id+"' selected >"+data.items[0].text+"</option>");			                	
				                });
				            }
				      }
			
				      <?php endif; ?>							      
					});

				})
			</script>
			<?php endif; ?>
		<?php else: ?>
			<script type="text/javascript">
				$(function() {
					$('#<?php echo e($name); ?>').select2();
				})
			</script>

		<?php endif; ?>

		<div class='form-group <?php echo e($header_group_class); ?> <?php echo e(($errors->first($name))?"has-error":""); ?>' id='form-group-<?php echo e($name); ?>' style="<?php echo e(@$form['style']); ?>">
			<label class='control-label col-sm-2'><?php echo e($form['label']); ?> <?php echo ($required)?"<span class='text-danger' title='This field is required'>*</span>":""; ?></label>

			<div class="<?php echo e($col_width?:'col-sm-10'); ?>">								
			<select style='width:100%' class='form-control' id="<?php echo e($name); ?>" <?php echo e($required); ?> <?php echo e($readonly); ?> <?php echo $placeholder; ?> <?php echo e($disabled); ?> name="<?php echo e($name); ?><?php echo e(($form['relationship_table'])?'[]':''); ?>" <?php echo e(($form['relationship_table'])?'multiple="multiple"':''); ?> >	
				<?php if($form['dataenum']): ?>
					<option value=''><?php echo e(trans('crudbooster.text_prefix_option')); ?> <?php echo e($form['label']); ?></option>
					<?php 
						$dataenum = $form['dataenum'];
						$dataenum = (is_array($dataenum))?$dataenum:explode(";",$dataenum);
					?>
					<?php $__currentLoopData = $dataenum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>										
						<?php 
							$val = $lab = '';
							if(strpos($enum,'|')!==FALSE) {
								$draw = explode("|",$enum);
								$val = $draw[0];
								$lab = $draw[1];
							}else{
								$val = $lab = $enum;
							}

							$select = ($value == $val)?"selected":"";
						?>	
						<option <?php echo e($select); ?> value='<?php echo e($val); ?>'><?php echo e($lab); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<?php if($form['datatable'] && $form['relationship_table']): ?>
					<?php 
						$select_table = explode(',',$form['datatable'])[0];
						$select_title = explode(',',$form['datatable'])[1];
						$select_where = $form['datatable_where'];
						$result = DB::table($select_table)->select('id',$select_title);
						if($select_where) {
							$result->whereraw($select_where);
						}
						$result = $result->orderby($select_title,'asc')->get();


						$foreignKey = CRUDBooster::getForeignKey($table,$form['relationship_table']);	
						$foreignKey2 = CRUDBooster::getForeignKey($select_table,$form['relationship_table']);																																		

						$value = DB::table($form['relationship_table'])->where($foreignKey,$id);										
						$value = $value->pluck($foreignKey2)->toArray();

						foreach($result as $r) {
							$option_label = $r->{$select_title};
							$option_value = $r->id;
							$selected = (is_array($value) && in_array($r->id, $value))?"selected":"";	
							echo "<option $selected value='$option_value'>$option_label</option>";
						}
					?>
				<?php endif; ?>
			</select>
			<div class="text-danger"><?php echo $errors->first($name)?"<i class='fa fa-info-circle'></i> ".$errors->first($name):""; ?></div>
			<p class='help-block'><?php echo e(@$form['help']); ?></p>

			</div>
		</div>