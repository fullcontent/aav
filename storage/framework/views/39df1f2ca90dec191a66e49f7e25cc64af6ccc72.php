<!-- First, extends to the CRUDBooster Layout -->

<?php $__env->startSection('content'); ?>
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Edit Form</div>
    <div class='panel-body'>      
        <div class='form-group'>
          <label>Name</label>
          <p><?php echo e($row->id); ?></p>
        </div>
         
        <!-- etc .... -->
        
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('crudbooster:admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>