<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('content_header'); ?>
    <ol class="breadcrumb">
        <li><a  href="<?php echo e(route('painel')); ?>">Home</a></li>
        <li><a  href="<?php echo e(route('admin')); ?>">Admin</a></li>
        <li><a  >Create</a></li>
    </ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            <?php if(session()->has('notification')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(session()->get('notification')); ?></p>
                </div>
            <?php endif; ?>
            <?php if(isset($admin)): ?>
                <form role="form" method="POST" action="<?php echo e(route('admin.update',$admin->id)); ?>">
                    <?php echo method_field('PUT'); ?>

                    <?php else: ?>
                        <form role="form" method="POST" action="<?php echo e(route('admin.store')); ?>">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" id="name" placeholder="Nome" type="text" name="name" value="<?php echo e(isset($admin->name) ? $admin->name : old('name')); ?>">
                                    <?php if($errors->has('name')): ?>
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" placeholder="Email" type="email" name="email" value="<?php echo e(isset($admin->email) ? $admin->email : old('email')); ?>">
                                    <?php if($errors->has('email')): ?>
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong><?php echo e($errors->first('email')); ?></strong>

                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input class="form-control" id="password" type="password" name="password">
                                    <?php if($errors->has('password')): ?>
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirme a Senha</label>
                                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation">
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Perfil</label>
                                    <select class="form-control" name="role_id">
                                        <option value="">Selecione</option>
                                        <option value="1" <?php if(isset($admin) && $admin->role_id == 1): ?> selected <?php endif; ?>>Admin</option>
                                        <option value="2" <?php if(isset($admin) && $admin->role_id == 2): ?> selected <?php endif; ?>>Editor</option>
                                    </select>
                                    <?php if($errors->has('role_id')): ?>
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong><?php echo e($errors->first('role_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Selecione</option>
                                        <option value="1" <?php if(isset($admin) && $admin->status == 1): ?> selected <?php endif; ?>>Ativo</option>
                                        <option value="0" <?php if(isset($admin) && $admin->status == 0): ?> selected <?php endif; ?>>Desativo</option>
                                    </select>
                                    <?php if($errors->has('status')): ?>
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong><?php echo e($errors->first('status')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check" aria-hidden="true"></i>
                                &nbsp;Enviar</button>
                        </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>