<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e($title); ?></h1>
    <ol class="breadcrumb">
        <li><a  href="<?php echo e(route('painel')); ?>">Home</a></li>
        <li><a  href="<?php echo e(route('categorie')); ?>">Categorias</a></li>
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
            <?php if(isset($errors) && count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($categorie)): ?>
                <form role="form" method="POST" action="<?php echo e(route('categorie.update',$categorie->id)); ?>">
                    <?php echo method_field('PUT'); ?>

                    <?php else: ?>
                        <form role="form" method="POST" action="<?php echo e(route('categorie.store')); ?>">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" id="name" placeholder="Nome" type="text" name="name" value="<?php echo e(isset($categorie->name) ? $categorie->name : old('name')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <input class="form-control" id="description" placeholder="Descrição" type="description" name="description" value="<?php echo e(isset($categorie->description) ? $categorie->description : old('description')); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Selecione</option>
                                        <option value="1" <?php if(isset($categorie) && $categorie->status == 1): ?> selected <?php endif; ?>>Ativo</option>
                                        <option value="0" <?php if(isset($categorie) && $categorie->status == 0): ?> selected <?php endif; ?>>Desativo</option>
                                    </select>
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