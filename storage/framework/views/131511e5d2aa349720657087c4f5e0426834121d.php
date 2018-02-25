<?php $__env->startSection('title','Categorias'); ?>
<?php $__env->startSection('content_header'); ?>
    <h1>Categorias</h1>
    <ol class="breadcrumb">
        <li><a  href="<?php echo e(route('painel')); ?>">Home</a></li>
        <li><a >Categorias</a></li>
    </ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row" style="margin-top: 2rem;">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-md-offset-1 col-lg-offset-1">
            <?php if(session()->has('notification')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(session()->get('notification')); ?></p>
                </div>
            <?php endif; ?>
            <a href="<?php echo e(route('categorie.create')); ?>" type="button" style="margin-bottom:10px" class="btn btn-info btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Novo Usuário
            </a>
            <a href="<?php echo e(route('categorie.showRestore')); ?>" type="button" style="margin-bottom:10px; margin-left: 60%" class="fa fa-trash"></a>
            <?php if(isset($categories) && count($categories) > 0): ?>
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
                                <th>Descrição</th>
                                <!--<th class="text-center" style="width: 5em;">Status</th>-->
                                <th class="text-center">Opções</th>
                            </tr>
                            <?php $__currentLoopData = $categories->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php echo e($categorie->name); ?></td>
                                    <td><?php echo e($categorie->description); ?></td>
                                    <!--<td class="text-center" style="width: 5em;"><?php echo e($categorie->status ? 'Ativo' : 'Desativo'); ?></td>-->
                                    <td class="text-center">
                                        <a href="<?php echo e(route('categorie.edit',$categorie->id)); ?>" type="button" class="btn btn-primary btn-flat">Editar</a>
                                        <a href="<?php echo e(route('categorie.show',$categorie->id)); ?>" type="button" class="btn btn-danger btn-flat">Visualizar</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pull-right" style="margin: 0px;padding: 0px">
                    <?php echo $categories->links(); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>