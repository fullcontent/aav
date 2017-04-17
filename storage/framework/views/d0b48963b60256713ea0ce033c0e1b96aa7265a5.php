<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-<?php echo e(trans('crudbooster.left')); ?> image">
                <img src="<?php echo e(CRUDBooster::myPhoto()); ?>" style='height:50px;width:50px' class="img-circle" alt="<?php echo e(trans('crudbooster.user_image')); ?>" />
            </div>
            <div class="pull-<?php echo e(trans('crudbooster.left')); ?> info">
                <p><?php echo e(CRUDBooster::myName()); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo e(trans('crudbooster.online')); ?></a>
            </div>
        </div>


        <div class='main-menu'>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header"><?php echo e(trans("crudbooster.menu_navigation")); ?></li>
                <!-- Optionally, you can add icons to the links -->

                <?php $dashboard = CRUDBooster::sidebarDashboard();?>
                <?php if($dashboard): ?>
                    <li data-id='<?php echo e($dashboard->id); ?>' class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH'))) ? 'active' : ''); ?>"><a href='<?php echo e(CRUDBooster::adminPath()); ?>' class='<?php echo e(($dashboard->color)?"text-".$dashboard->color:""); ?>' ><i class='fa fa-dashboard'></i> <span><?php echo e(trans("crudbooster.text_dashboard")); ?></span> </a></li>
                <?php endif; ?>

                <?php $__currentLoopData = CRUDBooster::sidebarMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li data-id='<?php echo e($menu->id); ?>' class='<?php echo e((count($menu->children))?"treeview":""); ?> <?php echo e((CRUDBooster::getCurrentMenuId()==$menu->id && CRUDBooster::getCurrentDashboardId()!=$menu->id )?"active":""); ?>'><a href='<?php echo e(($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$menu->url."?m=".$menu->id); ?>' class='<?php echo e(($menu->color)?"text-".$menu->color:""); ?>'><i class='<?php echo e($menu->icon); ?> <?php echo e(($menu->color)?"text-".$menu->color:""); ?>'></i> <span><?php echo e($menu->name); ?></span>
                            <?php if(count($menu->children)): ?><i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i><?php endif; ?>
                        </a>
                        <?php if(count($menu->children)): ?>
                            <ul class="treeview-menu">
                                <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li data-id='<?php echo e($child->id); ?>' class='<?php echo e((CRUDBooster::getCurrentMenuId()==$child->id && CRUDBooster::getCurrentDashboardId()!=$child->id)?"active":""); ?>'><a href='<?php echo e(($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url."?m=".$child->id); ?>'><i class='<?php echo e($child->icon); ?>'></i> <span><?php echo e($child->name); ?></span></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                <?php if(CRUDBooster::isSuperadmin()): ?>
                    <li class="header"><?php echo e(trans('crudbooster.SUPERADMIN')); ?></li>
                    <li class='treeview'>
                        <a href='#'><i class='fa fa-key'></i> <span><?php echo e(trans('crudbooster.Privileges_Roles')); ?></span>  <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/privileges/add*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("PrivilegesControllerGetAdd")); ?>?m=0'><?php echo e($current_path); ?><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.Add_New_Privilege')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/privileges')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("PrivilegesControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.List_Privilege')); ?></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-users'></i> <span><?php echo e(trans('crudbooster.Users_Management')); ?></span>  <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/users/add*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("AdminCmsUsersControllerGetAdd")); ?>?m=0'><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.add_user')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/users')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("AdminCmsUsersControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.List_users')); ?></a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/menu_management*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("MenusControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.Menu_Management')); ?></a></li>
                    <li class="treeview">
                        <a href="#"><i class='fa fa-wrench'></i> <span><?php echo e(trans('crudbooster.settings')); ?></span> <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/settings/add*')) ? 'active' : ''); ?>"><a href='<?php echo e(route("SettingsControllerGetAdd")); ?>?m=0'><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.Add_New_Setting')); ?></a></li>
                            <?php
                            $groupSetting = DB::table('cms_settings')->groupby('group_setting')->pluck('group_setting');
                            foreach($groupSetting as $gs):
                            ?>
                            <li class="<?=($gs == Request::get('group'))?'active':''?>"><a href='<?php echo e(route("SettingsControllerGetShow")); ?>?group=<?php echo e(urlencode($gs)); ?>&m=0'><i class='fa fa-wrench'></i> <?php echo e($gs); ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <li class='treeview'>
                        <a href='#'><i class='fa fa-th'></i> <span><?php echo e(trans('crudbooster.Module_Generator')); ?></span>  <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/module_generator/step1')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("ModulsControllerGetStep1")); ?>?m=0'><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.Add_New_Module')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/module_generator')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("ModulsControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.List_Module')); ?></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-dashboard'></i> <span><?php echo e(trans('crudbooster.Statistic_Builder')); ?></span>  <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder/add')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("StatisticBuilderControllerGetAdd")); ?>?m=0'><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.Add_New_Statistic')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("StatisticBuilderControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.List_Statistic')); ?></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-fire'></i> <span><?php echo e(trans('crudbooster.API_Generator')); ?></span>  <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/generator*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("ApiCustomControllerGetGenerator")); ?>?m=0'><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.Add_New_API')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/api_generator')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("ApiCustomControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.list_API')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/screet-key*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("ApiCustomControllerGetScreetKey")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.Generate_Screet_Key')); ?></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-envelope-o'></i> <span><?php echo e(trans('crudbooster.Email_Templates')); ?></span>  <i class="fa fa-angle-<?php echo e(trans("crudbooster.right")); ?> pull-<?php echo e(trans("crudbooster.right")); ?>"></i></a>
                        <ul class='treeview-menu'>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/email_templates/add*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("EmailTemplatesControllerGetAdd")); ?>?m=0'><i class='fa fa-plus'></i> <?php echo e(trans('crudbooster.Add_New_Email')); ?></a></li>
                            <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/email_templates')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("EmailTemplatesControllerGetIndex")); ?>?m=0'><i class='fa fa-bars'></i> <?php echo e(trans('crudbooster.List_Email_Template')); ?></a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e((Request::is(config('crudbooster.ADMIN_PATH').'/logs*')) ? 'active' : ''); ?>"><a href='<?php echo e(Route("LogsControllerGetIndex")); ?>?m=0'><i class='fa fa-flag'></i> <?php echo e(trans('crudbooster.Log_User_Access')); ?></a></li>
                <?php endif; ?>

            </ul><!-- /.sidebar-menu -->

        </div>

    </section>
    <!-- /.sidebar -->
</aside>
