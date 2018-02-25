<?php $__env->startSection('title','Detalhes'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>categorie</h1>
    <ol class="breadcrumb">
        <li><a  href="<?php echo e(route('painel')); ?>">Home</a></li>
        <li><a  href="<?php echo e(route('categorie')); ?>">Categorias</a></li>
        <li><a>Show</a></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <p><strong>Nome: </strong><?php echo e($categorie->name); ?></p>
                    <p><strong>Descrição: </strong><?php echo e($categorie->description); ?></p>
                    <p><strong>Status: </strong><?php echo e($categorie->status ? 'Ativo' : 'Desativo'); ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>

                <form  method="POST" action="<?php echo e(route('categorie.destroy',$categorie->id)); ?>">
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