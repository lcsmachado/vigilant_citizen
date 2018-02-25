<?php $__env->startSection('content'); ?>
<div class="container login-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel">
                <div class="panel-heading">
                   Painel Login
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('painel.login.submit')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Lembrar Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('painel.password.request')); ?>">
                                    Esqueçeu sua senha?
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-md-offset-4">
                        <?php if(Session::has('message')): ?>
                            <div class="alert alert-danger">
                                <p class="text-center"><?php echo e(Session::get('message')); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminLoginTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>