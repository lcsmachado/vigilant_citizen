<?php $__env->startSection('title','Detalhes'); ?>

<?php $__env->startSection('content_header'); ?>
    <ol class="breadcrumb">
        <li><a  href="<?php echo e(route('painel')); ?>">Home</a></li>
        <li><a  href="<?php echo e(route('admin')); ?>">Admin</a></li>
        <li><a>Usuários</a></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <p><strong>Perfil:</strong> <?php echo e($admin->role_id == 1? 'Admin' : 'Editor'); ?></p>
                    <p><strong>Nome: </strong><?php echo e($admin->name); ?></p>
                    <p><strong>E-mail: </strong><?php echo e($admin->email); ?></p>
                    <p><strong>Status: </strong><?php echo e($admin->status ? 'Ativo' : 'Desativo'); ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>

                <form  method="POST" action="<?php echo e(route('admin.destroy',$admin->id)); ?>">
                    <?php echo method_field('DELETE'); ?>

                    <?php echo csrf_field(); ?>

                    <button style="border: none;padding: 5px;" type="submit" class="small-box-footer bg-red btn-block"><i class="fa fa-user-times fa-2x" aria-hidden="true"></i>
                        &nbsp;Excluir</button>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>