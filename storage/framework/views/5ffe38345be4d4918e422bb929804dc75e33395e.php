<?php $__env->startSection('title','Admin'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Admin - Novo Usuário</h1>
    <ol class="breadcrumb">
        <li href="">Home</li>
        <li href="">Admin</li>
        <li href="">Create</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            <?php if(isset($errors) && count($errors) > 0): ?>
                <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <form role="form" method="POST" action="<?php echo e(route('admin.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="box-body">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" id="name" placeholder="Nome" type="text" name="name" value="<?php echo e(old('name')); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" placeholder="Email" type="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control" id="password" placeholder="Senha" type="password" name="password">
                </div>

                <div class="form-group">
                    <label>Perfil</label>
                    <div class="radio">
                        <label>
                            <input name="role"  value="Admin" type="radio">
                            Admin
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input name="role"  value="Editor"  checked="" type="radio">
                            Editor
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="radio">
                        <label>
                            <input name="status" value="1" checked="" type="radio">
                            Ativo
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input name="status" value="0" type="radio">
                            Desativo
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check" aria-hidden="true"></i>
                    &nbsp;Enviar</button>
            </div>
        </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>