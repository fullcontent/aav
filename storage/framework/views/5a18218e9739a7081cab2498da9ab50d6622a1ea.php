<?php 
	$name = str_slug($form['label'],'');
?>
<script type="text/javascript">
	$(function() {
		$('#form-group-<?php echo e($name); ?> .select2').select2();		
	})
</script>
<div class='form-group <?php echo e($header_group_class); ?>' id='form-group-<?php echo e($name); ?>'>								
	
	<?php if($form['columns']): ?>						
	<div class="col-sm-12">

	<div id='panel-form-<?php echo e($name); ?>' class="panel panel-default">
		<div class="panel-heading">
		  	<i class='fa fa-bars'></i> <?php echo e($form['label']); ?>

		</div>
		<div class="panel-body">
			
			<div class='row'>
				<div class='col-sm-10'>
					<div class="panel panel-default">
						<div class="panel-heading"><i class="fa fa-pencil-square-o"></i> Form</div>
						<div class="panel-body child-form-area">
							<?php $__currentLoopData = $form['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
							<?php $name_column = $name.$col['name'];?>
							<div class='form-group'>
								<label class="control-label col-sm-2"><?php echo e($col['label']); ?></label>
								<div class="col-sm-10">
									<?php if($col['type']=='text'): ?>
									<input id='<?php echo e($name_column); ?>' type='text' <?php echo e(($col['max'])?"maxlength='$col[max]'":""); ?> name='<?php echo e($col["name"]); ?>' class='form-control <?php echo e($col['required']?"required":""); ?>' 										
										<?php echo e(($col['readonly']===true)?"readonly":""); ?> 
										/>
									<?php elseif($col['type']=='radio'): ?>
										<?php 
											if($col['dataenum']):												
											foreach($col['dataenum'] as $e=>$enum):
												$enum = explode('|',$enum);
												if(count($enum)==2) {
													$radio_value = $enum[0];
													$radio_label = $enum[1];
												}else{
													$radio_value = $radio_label = $enum[0];
												}
										?>
										<label class="radio-inline">
										  <input type="radio" name="<?php echo e($col['name']); ?>" class='<?php echo e(($e==0 && $col['required'])?"required":""); ?> <?php echo e($name_column); ?>'  value="<?php echo e($radio_value); ?>"> <?php echo e($radio_label); ?> 
										</label>
										<?php endforeach;?>
										<?php endif;?>
									<?php elseif($col['type']=='datamodal'): ?>			
											
									<div id='<?php echo e($name_column); ?>' class="input-group">
									  <input type="hidden" class="input-id">
								      <input type="text" class="form-control input-label <?php echo e($col['required']?"required":""); ?>" readonly>
								      <span class="input-group-btn">
								        <button class="btn btn-primary" onclick="showModal<?php echo e($name_column); ?>()" type="button"><i class='fa fa-search'></i> Buscar Produto</button>
								      </span>
								    </div><!-- /input-group -->

								    <script type="text/javascript">
								    	var url_<?php echo e($name_column); ?> = "<?php echo e(CRUDBooster::mainpath('modal-data')); ?>?table=<?php echo e($col['datamodal_table']); ?>&columns=id,<?php echo e($col['datamodal_columns']); ?>&name_column=<?php echo e($name_column); ?>&where=<?php echo e(urlencode($col['datamodal_where'])); ?>&select_to=<?php echo e(urlencode($col['datamodal_select_to'])); ?>";
								    	var url_is_setted_<?php echo e($name_column); ?> = false;
								    	function showModal<?php echo e($name_column); ?>() {
								    		if(url_is_setted_<?php echo e($name_column); ?> == false) {								    			
									    		url_is_setted_<?php echo e($name_column); ?> = true;
									    		$('#iframe-modal-<?php echo e($name_column); ?>').attr('src',url_<?php echo e($name_column); ?>);
								    		}
								    		$('#modal-datamodal-<?php echo e($name_column); ?>').modal('show');
								    	}
								    	function hideModal<?php echo e($name_column); ?>() {
											$('#modal-datamodal-<?php echo e($name_column); ?>').modal('hide');
										}
				
								    	function selectAdditionalData<?php echo e($name_column); ?>(select_to_json) {
											$.each(select_to_json,function(key,val) {
												console.log('#'+key+ ' = '+val);
												if(key == 'datamodal_id') {
													$('#<?php echo e($name_column); ?> .input-id').val(val);
												}
												if(key == 'datamodal_label') {
													$('#<?php echo e($name_column); ?> .input-label').val(val);
												}
												$('#<?php echo e($name); ?>'+key).val(val).trigger('change');			
											})
											hideModal<?php echo e($name_column); ?>();
										}
								    </script>

									<div id='modal-datamodal-<?php echo e($name_column); ?>' class="modal" tabindex="-1" role="dialog">
									  <div class="modal-dialog <?php echo e($col['datamodal_size']=='large'?'modal-lg':''); ?> " role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title"><i class='fa fa-search'></i> Buscar <?php echo e($col['label']); ?></h4>
									      </div>
									      <div class="modal-body">
									        <iframe id='iframe-modal-<?php echo e($name_column); ?>' style="border:0;height: 430px;width: 100%" src=""></iframe>
									      </div>
									     
									    </div><!-- /.modal-content -->
									  </div><!-- /.modal-dialog -->
									</div><!-- /.modal -->

									<?php elseif($col['type']=='number'): ?>
									<input id='<?php echo e($name_column); ?>' type='number' <?php echo e(($col['min'])?"min='$col[min]'":""); ?> <?php echo e(($col['max'])?"max='$col[max]'":""); ?> name='<?php echo e($col["name"]); ?>' class='form-control <?php echo e($col['required']?"required":""); ?>' 										
										<?php echo e(($col['readonly']===true)?"readonly":""); ?> 
										/>
									<?php elseif($col['type']=='textarea'): ?>		
									<textarea id='<?php echo e($name_column); ?>' name='<?php echo e($col["name"]); ?>' class='form-control <?php echo e($col['required']?"required":""); ?>' <?php echo e(($col['readonly']===true)?"readonly":""); ?> ></textarea>
									<?php elseif($col['type']=='upload'): ?>
									<div id='<?php echo e($name_column); ?>' class="input-group">
									  <input type="hidden" class="input-id">
								      <input type="text" class="form-control input-label <?php echo e($col['required']?"required":""); ?>" readonly>
								      <span class="input-group-btn">
								        <button class="btn btn-primary" id="btn-upload-<?php echo e($name_column); ?>" onclick="showFakeUpload<?php echo e($name_column); ?>()" type="button"><i class='fa fa-search'></i> Browse File</button>
								      </span>
								    </div><!-- /input-group -->

								    <div id="loading-<?php echo e($name_column); ?>" class='text-info' style="display: none">
								    	<i class='fa fa-spin fa-spinner'></i> Please wait loading...
								    </div>

								    <input type="file" id='fake-upload-<?php echo e($name_column); ?>' style="display: none">
								    <script type="text/javascript">
								    	var file;
										var filename;
										var is_uploading = false;

								    	function showFakeUpload<?php echo e($name_column); ?>() {
								    		if(is_uploading) {
								    			return false;
								    		}

								    		$('#fake-upload-<?php echo e($name_column); ?>').click();
								    	}
								    	
										// Add events
										$('#fake-upload-<?php echo e($name_column); ?>').on('change', prepareUpload<?php echo e($name_column); ?>);

										// Grab the files and set them to our variable
										function prepareUpload<?php echo e($name_column); ?>(event)
										{
										  var max_size = <?php echo e(($col['max'])?:2000); ?>;
										  file = event.target.files[0];
										  
										  var filesize = Math.round(parseInt(file.size)/1024);
										  
										  if(filesize > max_size) {
										  	sweetAlert('Oops','Your file size is too big !','warning');
										  	return false;
										  }

										  filename = $('#fake-upload-<?php echo e($name_column); ?>').val().replace(/C:\\fakepath\\/i, '');
										  var extension = filename.split('.').pop().toLowerCase();
										  var img_extension = ['jpg','jpeg','png','gif','bmp'];
										  var available_extension = "<?php echo e(config('crudbooster.UPLOAD_TYPES')); ?>".split(",");
										  var is_image_only = <?php echo e(($col['upload_type'] == 'image')?"true":"false"); ?>;

										  if(is_image_only) {
										  	  if($.inArray(extension, img_extension) == -1) {
										  	  	sweetAlert('Warning','Your file extension is not allowed !','warning');
												return false;    
										  	  }
										  }else{										  	
											  if($.inArray(extension, available_extension) == -1) {
												sweetAlert('Warning','Your file extension is not allowed !','warning');
												return false;    
											  } 
										  }


										  $('#<?php echo e($name_column); ?> .input-label').val(filename);

										  $('#loading-<?php echo e($name_column); ?>').fadeIn();
										  $('#btn-add-table-<?php echo e($name); ?>').addClass('disabled');
										  $('#btn-upload-<?php echo e($name_column); ?>').addClass('disabled');
										  is_uploading = true;

										  //Upload File To Server
										  uploadFiles<?php echo e($name_column); ?>(event);
										}

										function uploadFiles<?php echo e($name_column); ?>(event)
										{
										  	event.stopPropagation(); // Stop stuff happening
										    event.preventDefault(); // Totally stop stuff happening

										    // START A LOADING SPINNER HERE

										    // Create a formdata object and add the files
										    var data = new FormData();
										    data.append('userfile',file);

										    $.ajax({
										        url: '<?php echo e(CRUDBooster::mainpath("upload-file")); ?>',
										        type: 'POST',
										        data: data,
										        cache: false,										        
										        processData: false, // Don't process the files
										        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
										        success: function(data, textStatus, jqXHR)
										        {
										        	console.log(data);
										        	$('#btn-add-table-<?php echo e($name); ?>').removeClass('disabled');
										            $('#loading-<?php echo e($name_column); ?>').hide();
										            $('#btn-upload-<?php echo e($name_column); ?>').removeClass('disabled');
										            is_uploading = false;

										            var basename = data.split('/').reverse()[0];
										            $('#<?php echo e($name_column); ?> .input-label').val(basename);

										            $('#<?php echo e($name_column); ?> .input-id').val(data);
										        },
										        error: function(jqXHR, textStatus, errorThrown)
										        {
										        	$('#btn-add-table-<?php echo e($name); ?>').removeClass('disabled');
										        	$('#btn-upload-<?php echo e($name_column); ?>').removeClass('disabled');
										            is_uploading = false;
										            // Handle errors here
										            console.log('ERRORS: ' + textStatus);
										            // STOP LOADING SPINNER
										            $('#loading-<?php echo e($name_column); ?>').hide();
										        }
										    });
										}

								    </script>

									<?php elseif($col['type']=='select'): ?>
									<select id='<?php echo e($name_column); ?>' name='<?php echo e($col["name"]); ?>' class='form-control select2 <?php echo e($col['required']?"required":""); ?>' 										
										<?php echo e(($col['readonly']===true)?"readonly":""); ?> 
										>
										<option value=''><?php echo e(trans('crudbooster.text_prefix_option')); ?> <?php echo e($col['label']); ?></option>
										<?php 
											if($col['datatable']) {
												$tableJoin = explode(',',$col['datatable'])[0];
												$titleField = explode(',',$col['datatable'])[1];
												$data = CRUDBooster::get($tableJoin,NULL,"$titleField ASC");
												foreach($data as $d) {
													echo "<option value='$d->id'>".$d->$titleField."</option>";
												}
											}else{
												$data = $col['dataenum'];
												foreach($data as $d) {
													$enum = explode('|',$d);
													if(count($enum)==2) {
														$opt_value = $enum[0];
														$opt_label = $enum[1];
													}else{
														$opt_value = $opt_label = $enum[0];
													}
													echo "<option value='$opt_value'>$opt_label</option>";
												}
											}											
										?>										
									</select>
									<?php endif; ?>

									<?php if($col['help']): ?> 
									<div class='help-block'>
										<?php echo e($col['help']); ?>

									</div>
									<?php endif; ?>
								</div>
							</div>

							<?php if($col['formula']): ?>
								<?php 
									$formula = $col['formula'];
									$formula_function_name ='formula'.str_slug($name.$col['name'],'');
									$script_onchange = "";
									foreach($form['columns'] as $c) {
										if(strpos($formula, "[".$c['name']."]")!==false) {
											$script_onchange .= "
											$('#$name$c[name]').change(function() {
												$formula_function_name();
											});
											";
										}
										$formula = str_replace("[".$c['name']."]","\$('#".$name.$c['name']."').val()",$formula);
									}									
								?>
								<script type="text/javascript">
									function <?php echo e($formula_function_name); ?>() {
										var v = <?php echo $formula; ?>;
										$('#<?php echo e($name_column); ?>').val(v);
									}
									$(function() {										
										<?php echo $script_onchange; ?>

									})									
								</script>
							<?php endif; ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<script type="text/javascript">
								var currentRow = null;

								function resetForm<?php echo e($name); ?>() {
									$('#panel-form-<?php echo e($name); ?>').find("input[type=text],input[type=number],select,textarea").val('');
								}

								function deleteRow<?php echo e($name); ?>(t) {

									if(confirm("<?php echo e(trans('crudbooster.delete_title_confirm')); ?>")) {
										$(t).parent().parent().remove();
										if( $('#table-<?php echo e($name); ?> tbody tr').length == 0) {
											var colspan = $('#table-<?php echo e($name); ?> thead tr th').length;
											$('#table-<?php echo e($name); ?> tbody').html("<tr class='trNull'><td colspan='"+colspan+"' align='center'><?php echo e(trans('crudbooster.table_data_not_found')); ?></td></tr>");
										}
									}									
								}
								function editRow<?php echo e($name); ?>(t) {									
									var p = $(t).parent().parent(); //parentTR 
									currentRow = p;
									p.addClass('warning');
									$('#btn-add-table-<?php echo e($name); ?>').val('Save changes');
									<?php $__currentLoopData = $form['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($c['type']=='select'): ?>
											$('#<?php echo e($name.$c["name"]); ?>').val( p.find(".<?php echo e($c['name']); ?> input").val() ).trigger("change");
										<?php elseif($c['type']=='radio'): ?>
											var v = p.find(".<?php echo e($c['name']); ?> input").val();
											$('.<?php echo e($name.$c["name"]); ?>[value='+v+']').prop('checked',true);
										<?php elseif($c['type']=='datamodal'): ?>
											$('#<?php echo e($name.$c["name"]); ?> .input-label').val( p.find(".<?php echo e($c['name']); ?> .td-label").text() );
											$('#<?php echo e($name.$c["name"]); ?> .input-id').val( p.find(".<?php echo e($c['name']); ?> input").val() );
										<?php elseif($c['type']=='upload'): ?>
											<?php if($c['upload_type']=='image'): ?>
											$('#<?php echo e($name.$c["name"]); ?> .input-label').val( p.find(".<?php echo e($c['name']); ?> img").data('label') );
											<?php else: ?> 
											$('#<?php echo e($name.$c["name"]); ?> .input-label').val( p.find(".<?php echo e($c['name']); ?> a").data('label') );
											<?php endif; ?> 
											$('#<?php echo e($name.$c["name"]); ?> .input-id').val( p.find(".<?php echo e($c['name']); ?> input").val() );
										<?php else: ?>
											$('#<?php echo e($name.$c["name"]); ?>').val( p.find(".<?php echo e($c['name']); ?> input").val() );
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								}

								function validateForm<?php echo e($name); ?>() {
									var is_false = 0;
									$('#panel-form-<?php echo e($name); ?> .required').each(function() {
										var v = $(this).val();																	
										if(v == '') {											
											sweetAlert("Oops","Please complete the form !","warning");
											is_false += 1;
										}
									})
									
									if(is_false==0) {
										return true;
									}else{
										return false;
									}
								}

								function addToTable<?php echo e($name); ?>() {

									if(validateForm<?php echo e($name); ?>() == false) {
										return false;
									}

									var trRow = '<tr>';
									<?php $__currentLoopData = $form['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($c['type']=='select'): ?>
											trRow += "<td class='<?php echo e($c['name']); ?>'>"+$('#<?php echo e($name.$c["name"]); ?> option:selected').text()+
											"<input type='hidden' name='<?php echo e($name); ?>-<?php echo e($c['name']); ?>[]' value='"+$('#<?php echo e($name.$c["name"]); ?>').val()+"'/>"+
											"</td>";
										<?php elseif($c['type']=='radio'): ?>
											trRow += "<td class='<?php echo e($c['name']); ?>'><span class='td-label'>"+$('.<?php echo e($name.$c["name"]); ?>:checked').val()+"</span>"+
											"<input type='hidden' name='<?php echo e($name); ?>-<?php echo e($c['name']); ?>[]' value='"+$('.<?php echo e($name.$c["name"]); ?>:checked').val()+"'/>"+
											"</td>";
										<?php elseif($c['type']=='datamodal'): ?>
											trRow += "<td class='<?php echo e($c['name']); ?>'><span class='td-label'>"+$('#<?php echo e($name.$c["name"]); ?> .input-label').val()+"</span>"+
											"<input type='hidden' name='<?php echo e($name); ?>-<?php echo e($c['name']); ?>[]' value='"+$('#<?php echo e($name.$c["name"]); ?> .input-id').val()+"'/>"+
											"</td>";
										<?php elseif($c['type']=='upload'): ?>
											<?php if($c['upload_type']=='image'): ?>
											trRow += "<td class='<?php echo e($c['name']); ?>'>"+
											"<a class='fancybox' href='<?php echo e(asset('/')); ?>"+$('#<?php echo e($name.$c["name"]); ?> .input-id').val()+"'><img data-label='"+$('#<?php echo e($name.$c["name"]); ?> .input-label').val()+"' src='<?php echo e(asset('/')); ?>"+$('#<?php echo e($name.$c["name"]); ?> .input-id').val()+"' width='50px' height='50px'/></a>"+
											"<input type='hidden' name='<?php echo e($name); ?>-<?php echo e($c['name']); ?>[]' value='"+$('#<?php echo e($name.$c["name"]); ?> .input-id').val()+"'/>"+
											"</td>";
											<?php else: ?>
											trRow += "<td class='<?php echo e($c['name']); ?>'><a data-label='"+$('#<?php echo e($name.$c["name"]); ?> .input-label').val()+"' href='<?php echo e(asset('/')); ?>"+$('#<?php echo e($name.$c["name"]); ?> .input-id').val()+"'>"+$('#<?php echo e($name.$c["name"]); ?> .input-label').val()+"</a>"+
											"<input type='hidden' name='<?php echo e($name); ?>-<?php echo e($c['name']); ?>[]' value='"+$('#<?php echo e($name.$c["name"]); ?> .input-id').val()+"'/>"+
											"</td>";
											<?php endif; ?>
										<?php else: ?>
											trRow += "<td class='<?php echo e($c['name']); ?>'>"+$('#<?php echo e($name.$c["name"]); ?>').val()+
											"<input type='hidden' name='<?php echo e($name); ?>-<?php echo e($c['name']); ?>[]' value='"+$('#<?php echo e($name.$c["name"]); ?>').val()+"'/>"+
											"</td>";
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
									trRow += "<td>"+
										"<a href='#panel-form-<?php echo e($name); ?>' onclick='editRow<?php echo e($name); ?>(this)' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a> "+
										"<a href='javascript:void(0)' onclick='deleteRow<?php echo e($name); ?>(this)' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>";
									trRow += '</tr>';
									$('#table-<?php echo e($name); ?> tbody .trNull').remove();
									if(currentRow==null) {
										$("#table-<?php echo e($name); ?> tbody").prepend(trRow);
									}else{
										currentRow.removeClass('warning');
										currentRow.replaceWith(trRow);
										currentRow = null;
									}
									$('#btn-add-table-<?php echo e($name); ?>').val('Add To Table');
									$('#btn-reset-form-<?php echo e($name); ?>').click();									
								}
							</script>
						</div>
						<div class="panel-footer" align="right">
							<input type='button' class='btn btn-default' id="btn-reset-form-<?php echo e($name); ?>" onclick="resetForm<?php echo e($name); ?>()" value='Apagar'/>
							<input type='button' id='btn-add-table-<?php echo e($name); ?>' class='btn btn-primary' onclick="addToTable<?php echo e($name); ?>()" value='Adicionar'/>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<i class='fa fa-table'></i> Table Detail
				</div>
				<div class="panel-body no-padding table-responsive"  style="max-height: 400px;overflow: auto;">
					<table id='table-<?php echo e($name); ?>' class='table table-striped table-bordered'>
					<thead>
						<tr>
							<?php $__currentLoopData = $form['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>						
								<th><?php echo e($col['label']); ?></th>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
								<th width="90px"><?php echo e(trans('crudbooster.action_label')); ?></th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$columns_tbody = [];
							$data_child = DB::table($form['table'])
							->where($form['foreign_key'],$id);
							foreach($form['columns'] as $i=>$c) {
								$data_child->addselect($form['table'].'.'.$c['name']);

								if($c['type'] == 'datamodal') {
									$datamodal_title = explode(',',$c['datamodal_columns'])[0];
									$datamodal_table = $c['datamodal_table'];
									$data_child->join($c['datamodal_table'],$c['datamodal_table'].'.id','=',$c['name']);
									$data_child->addselect($c['datamodal_table'].'.'.$datamodal_title.' as '.$datamodal_table.'_'.$datamodal_title);
								}elseif ($c['type'] == 'select') {
									if($c['datatable']) {
										$join_table = explode(',',$c['datatable'])[0];
										$join_field = explode(',',$c['datatable'])[1];
										$data_child->join($join_table,$join_table.'.id','=',$c['name']);
										$data_child->addselect($join_table.'.'.$join_field.' as '.$join_table.'_'.$join_field);										
									}
								}								
								
							}

							$data_child = $data_child->orderby($form['table'].'.id','desc')->get();
							foreach($data_child as $d):							
						?>
						<tr>
							<?php $__currentLoopData = $form['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<td class="<?php echo e($col['name']); ?>">
								<?php 
									if($col['type'] == 'select') {
										if($col['datatable']) {
											$join_table = explode(',',$col['datatable'])[0];
											$join_field = explode(',',$col['datatable'])[1];
											echo "<span class='td-label'>";
											echo $d->{$join_table.'_'.$join_field};
											echo "</span>";
											echo "<input type='hidden' name='".$name."-".$col['name']."[]' value='".$d->{$col['name']}."'/>";
										}
										if($col['dataenum']) {
											echo "<span class='td-label'>";
											echo $d->{$col['name']};
											echo "</span>";
											echo "<input type='hidden' name='".$name."-".$col['name']."[]' value='".$d->{$col['name']}."'/>";
										}
									}elseif ($col['type']=='datamodal') {
										$datamodal_title = explode(',',$col['datamodal_columns'])[0];
										$datamodal_table = $col['datamodal_table'];
										echo "<span class='td-label'>";
										echo $d->{$datamodal_table.'_'.$datamodal_title};
										echo "</span>";
										echo "<input type='hidden' name='".$name."-".$col['name']."[]' value='".$d->{$col['name']}."'/>";
									}elseif ($col['type']=='upload') {
										$filename = basename( $d->{$col['name']} );
										if($col['upload_type']=='image') {
											echo "<a href='".asset( $d->{$col['name']} )."' class='fancybox'><img data-label='$filename' src='".asset( $d->{$col['name']} )."' width='50px' height='50px'/></a>";
											echo "<input type='hidden' name='".$name."-".$col['name']."[]' value='".$d->{ $col['name'] }."'/>";
										}else{
											echo "<a data-label='$filename' href='".asset( $d->{$col['name']} )."'>$filename</a>";
											echo "<input type='hidden' name='".$name."-".$col['name']."[]' value='".$d->{ $col['name'] }."'/>";
										}									
									}else{
										echo "<span class='td-label'>";
										echo $d->{$col['name']};
										echo "</span>";
										echo "<input type='hidden' name='".$name."-".$col['name']."[]' value='".$d->{$col['name']}."'/>";
									}
								?>
								</td>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
							<td>
								<a href='#panel-form-<?php echo e($name); ?>' onclick='editRow<?php echo e($name); ?>(this)' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
								<a href='javascript:void(0)' onclick='deleteRow<?php echo e($name); ?>(this)' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>
							</td>					
						</tr>

						<?php endforeach;?>

						<?php if(count($data_child)==0): ?>
						<tr class="trNull">
							<td colspan="<?php echo e(count($form['columns'])+1); ?>" align="center"><?php echo e(trans('crudbooster.table_data_not_found')); ?></td>
						</tr>
						<?php endif; ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div> 
	

	
	</div>


	<?php else: ?>

		<div style="border:1px dashed #c41300;padding:20px;margin:20px">
			<span style="background: yellow;color: black;font-weight: bold">CHILD <?php echo e($name); ?> : COLUMNS ATTRIBUTE IS MISSING !</span>
			<p>You need to set the "columns" attribute manually</p>
		</div>
	<?php endif; ?>
</div>