<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ürün /</span> <?php if(isset($fakeproducts)): ?> <?php echo e($fakeproducts->name); ?> <?php endif; ?></h4>
        <div class="card  mb-4">
            <h5 class="card-header">Ürün Bilgileri</h5>
            <form action="<?php echo e(route('fakeproduct.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" <?php if(isset($fakeproducts)): ?> value="<?php echo e($fakeproducts->id); ?>" <?php endif; ?> />
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Ürün Adı</label>
                    <input type="text" class="form-control" id="name"  <?php if(isset($fakeproducts)): ?> value="<?php echo e($fakeproducts->name); ?>" <?php endif; ?>  name="name" aria-describedby="name">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/fakeproduct/form.blade.php ENDPATH**/ ?>