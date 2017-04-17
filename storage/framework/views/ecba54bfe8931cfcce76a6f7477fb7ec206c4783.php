<?php $__currentLoopData = $addaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php 
    foreach($row as $key=>$val) {
      $a['url'] = str_replace("[".$key."]",$val,$a['url']);
    }

    $label = $a['label'];
    $url = $a['url'];
    $icon = $a['icon'];
    $color = $a['color']?:'primary';

    if(isset($a['showIf'])) {

      $query = $a['showIf'];
      
      foreach($row as $key=>$val) {
        $query = str_replace("[".$key."]",'"'.$val.'"',$query);
      }              

      @eval("if($query) {
          echo \"<a class='btn btn-xs btn-\$color' title='\$label' href='\$url'><i class='\$icon'></i> $label</a>&nbsp;\";
      }");           

    }else{
      echo "<a class='btn btn-xs btn-$color' title='$label' href='$url'><i class='$icon'></i> $label</a>&nbsp;";              
    }
  ?>          
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($button_action_style == 'button_text'): ?>               

      	<?php if(CRUDBooster::isRead() && $button_detail): ?>         		
        	<a class='btn btn-xs btn-primary' title='<?php echo e(trans("crudbooster.action_detail_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("detail/$row->id")."?return_url=".urlencode(Request::fullUrl())); ?>'><?php echo e(trans("crudbooster.action_detail_data")); ?></a> 
        <?php endif; ?>
  		
  		<?php if(CRUDBooster::isUpdate() && $button_edit): ?>     				    	
  			<a class='btn btn-xs btn-success' title='<?php echo e(trans("crudbooster.action_edit_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("edit/$row->id")."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field); ?>'><?php echo e(trans("crudbooster.action_edit_data")); ?></a> 
        <?php endif; ?>

        <?php if(CRUDBooster::isDelete() && $button_delete): ?>
        	<?php $url = CRUDBooster::mainpath("delete/$row->id");?>
        	<a class='btn btn-xs btn-warning' title='<?php echo e(trans("crudbooster.action_delete_data")); ?>' href='javascript:;' onclick='<?php echo e(CRUDBooster::deleteConfirm($url)); ?>'><?php echo e(trans("crudbooster.action_delete_data")); ?></a> 
        <?php endif; ?>
<?php elseif($button_action_style == 'button_icon_text'): ?>
       

      	<?php if(CRUDBooster::isRead() && $button_detail): ?>         		
        	<a class='btn btn-xs btn-primary' title='<?php echo e(trans("crudbooster.action_detail_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("detail/$row->id")."?return_url=".urlencode(Request::fullUrl())); ?>'><i class='fa fa-eye'></i> <?php echo e(trans("crudbooster.action_detail_data")); ?></a> 
        <?php endif; ?>
  		
  		<?php if(CRUDBooster::isUpdate() && $button_edit): ?>     				    	
  			<a class='btn btn-xs btn-success' title='<?php echo e(trans("crudbooster.action_edit_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("edit/$row->id")."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field); ?>'><i class='fa fa-pencil'></i> <?php echo e(trans("crudbooster.action_edit_data")); ?></a> 
        <?php endif; ?>

        <?php if(CRUDBooster::isDelete() && $button_delete): ?>
        	<?php $url = CRUDBooster::mainpath("delete/$row->id");?>
        	<a class='btn btn-xs btn-warning' title='<?php echo e(trans("crudbooster.action_delete_data")); ?>' href='javascript:;' onclick='<?php echo e(CRUDBooster::deleteConfirm($url)); ?>'><i class='fa fa-trash'></i> <?php echo e(trans("crudbooster.action_delete_data")); ?></a> 
        <?php endif; ?>

<?php elseif($button_action_style == 'dropdown'): ?>

    <div class='btn-group btn-group-action'>
          <button type='button' class='btn btn-xs btn-primary btn-action'><?php echo e(trans("crudbooster.action_label")); ?></button>
          <button type='button' class='btn btn-xs btn-primary dropdown-toggle' data-toggle='dropdown'>
            <span class='caret'></span>
            <span class='sr-only'>Toggle Dropdown</span>
          </button>
          <ul class='dropdown-menu dropdown-menu-action' role='menu'>
              <?php $__currentLoopData = $addaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                  foreach($row as $key=>$val) {
                    $a['url'] = str_replace("[".$key."]",$val,$a['url']);
                  }

                  $label = $a['label'];
                  $url = $a['url']."?return_url=".urlencode(Request::fullUrl());
                  $icon = $a['icon'];
                  $color = $a['color']?:'primary';

                  if(isset($a['showIf'])) {

                    $query = $a['showIf'];
                    
                    foreach($row as $key=>$val) {
                      $query = str_replace("[".$key."]",'"'.$val.'"',$query);
                    }              

                    @eval("if($query) {
                        echo \"<li><a title='\$label' href='\$url'><i class='\$icon'></i> \$label</a></li>\";
                    }");           

                  }else{
                    echo "<li><a title='$label' href='$url'><i class='$icon'></i> $label</a></li>";              
                  }
                ?>          
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <?php if(CRUDBooster::isRead() && $button_detail): ?>            
                  <li><a title='<?php echo e(trans("crudbooster.action_detail_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("detail/$row->id")."?return_url=".urlencode(Request::fullUrl())); ?>'><i class='fa fa-eye'></i> <?php echo e(trans("crudbooster.action_detail_data")); ?></a></li>
                <?php endif; ?>
              
              <?php if(CRUDBooster::isUpdate() && $button_edit): ?>                    
                <li><a title='<?php echo e(trans("crudbooster.action_edit_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("edit/$row->id")."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field); ?>'><i class='fa fa-pencil'></i> <?php echo e(trans("crudbooster.action_edit_data")); ?></a></li>
                <?php endif; ?>

                <?php if(CRUDBooster::isDelete() && $button_delete): ?>
                  <?php $url = CRUDBooster::mainpath("delete/$row->id");?>
                  <li><a title='<?php echo e(trans("crudbooster.action_delete_data")); ?>' href='javascript:;' onclick='<?php echo e(CRUDBooster::deleteConfirm($url)); ?>'><i class='fa fa-trash'></i> <?php echo e(trans("crudbooster.action_delete_data")); ?></a></li>
                <?php endif; ?>
            </ul>
    </div>

<?php else: ?>

        <?php if(CRUDBooster::isRead() && $button_detail): ?>            
          <a class='btn btn-xs btn-primary' title='<?php echo e(trans("crudbooster.action_detail_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("detail/$row->id")."?return_url=".urlencode(Request::fullUrl())); ?>'><i class='fa fa-eye'></i></a> 
        <?php endif; ?>
      
      <?php if(CRUDBooster::isUpdate() && $button_edit): ?>                    
        <a class='btn btn-xs btn-success' title='<?php echo e(trans("crudbooster.action_edit_data")); ?>' href='<?php echo e(CRUDBooster::mainpath("edit/$row->id")."?return_url=".urlencode(Request::fullUrl())."&parent_id=".g("parent_id")."&parent_field=".$parent_field); ?>'><i class='fa fa-pencil'></i></a> 
        <?php endif; ?>

        <?php if(CRUDBooster::isDelete() && $button_delete): ?>
          <?php $url = CRUDBooster::mainpath("delete/$row->id");?>
          <a class='btn btn-xs btn-warning' title='<?php echo e(trans("crudbooster.action_delete_data")); ?>' href='javascript:;' onclick='<?php echo e(CRUDBooster::deleteConfirm($url)); ?>'><i class='fa fa-trash'></i></a> 
        <?php endif; ?>

<?php endif; ?>