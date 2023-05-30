<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role'ler /</span> <?php if(isset($roles)): ?> <?php echo e($roles->name); ?> <?php endif; ?></h4>
        <div class="card  mb-4">
            <h5 class="card-header">Role Bilgileri</h5>
            <form action="<?php echo e(route('role.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" <?php if(isset($roles)): ?> value="<?php echo e($roles->id); ?>" <?php endif; ?> />
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Firma Adı</label>
                    <input type="text" class="form-control" id="name"  <?php if(isset($roles)): ?> value="<?php echo e($roles->name); ?>" <?php endif; ?>  name="name" aria-describedby="name">
                    <div id="name" class="form-text">
                        We'll never share your details with anyone else.
                    </div>
                </div>
                <hr class="my-5">
                <div>
                    <button type="submit" class="btn btn-danger btn-buy-now">Kaydet</button>
                </div>
            </div>
            </form>
        </div>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/role/form.blade.php ENDPATH**/ ?>