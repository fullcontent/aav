<script type="text/javascript">
  $(function() {
      function format(icon) {          
          var originalOption = icon.element;
          var label = $(originalOption).text();
          var val = $(originalOption).val();
          if(!val) return label;
          var $resp = $('<span><i style="margin-top:5px" class="pull-right ' + $(originalOption).val() + '"></i> ' + $(originalOption).data('label') + '</span>');
          return $resp;
      }
      $('#list-icon').select2({
          width: "100%",
          templateResult: format,
          templateSelection: format
      });
  })  
</script>

<select id='list-icon' class="form-control" name="icon" style="font-family: 'FontAwesome', Helvetica;">
   <option value="">** Select an Icon</option>
   <?php $__currentLoopData = $fontawesome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value='fa fa-<?php echo e($font); ?>' <?php echo e(($row->icon == "fa fa-$font")?"selected":""); ?> data-label='<?php echo e($font); ?>'><?php echo e($font); ?></option>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>