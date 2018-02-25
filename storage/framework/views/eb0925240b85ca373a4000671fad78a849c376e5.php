<?php $__env->startSection('title','Admin'); ?>
<?php $__env->startSection('content_header'); ?>
    <ol class="breadcrumb">
        <li><a  href="<?php echo e(route('painel')); ?>">Home</a></li>
        <li><a >Admin</a></li>
    </ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row" style="margin-top: 2rem;">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-md-offset-1 col-lg-offset-1">
            <a href="<?php echo e(route('admin.create')); ?>" type="button" class="btn btn-info btn-flat" style="margin-bottom: 10px;">
                <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Novo Usuário
            </a>
            <?php if(session()->has('notification')): ?>
                <div class="alert alert-success" >
                    <p><?php echo e(session()->get('notification')); ?></p>
                </div>
            <?php endif; ?>
            <?php if(isset($admins) && count($admins) > 0): ?>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body" style="padding: 15px 15px 0px 15px !important;">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <!--<th style="width: 10px">#</th>
                                <th>Perfil</th>-->
                                <th>Nome</th>
                                <th>Email</th>
                                <!--<th class="text-center" style="width: 5em;">Status</th>-->
                                <th class="text-center">Opções</th>
                            </tr>
                            <?php $__currentLoopData = $admins->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <!--<td><?php echo e($admin->role_id == 1? 'Admin' : 'Editor'); ?></td>-->
                                    <td><?php echo e($admin->name); ?></td>
                                    <td><?php echo e($admin->email); ?></td>
                                    <!--<td class="text-center" style="width: 5em;"><?php echo e($admin->status ? 'Ativo' : 'Desativo'); ?></td>-->
                                    <td class="text-center">
                                        <a href="<?php echo e(route('admin.edit',$admin->email)); ?>" type="button" class="btn btn-primary btn-flat">Editar</a>
                                        <a href="<?php echo e(route('admin.show',$admin->email)); ?>" type="button" class="btn btn-danger btn-flat">Visualizar</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pull-right" style="margin: 0px;padding: 0px">
                    <?php echo $admins->links(); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>