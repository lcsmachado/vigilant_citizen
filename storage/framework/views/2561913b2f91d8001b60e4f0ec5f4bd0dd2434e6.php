<?php $__env->startSection('title','Painel'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Painel</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <h1>Home Painel</h1>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>