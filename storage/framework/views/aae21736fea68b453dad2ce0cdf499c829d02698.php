<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kategoriler /</span> <?php if(isset($categorys)): ?> <?php echo e($categorys->name); ?> <?php endif; ?></h4>
        <div class="card  mb-4">
            <h5 class="card-header">Kategori Bilgileri</h5>
            <form action="<?php echo e(route('category.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" <?php if(isset($categories)): ?> value="<?php echo e($categories->id); ?>" <?php endif; ?> />
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Kategori Adı</label>
                    <input type="text" class="form-control" id="name"  <?php if(isset($categories)): ?> value="<?php echo e($categories->name); ?>" <?php endif; ?>  name="name" aria-describedby="name">
                    <div id="name" class="form-text">
                        We'll never share your details with anyone else.
                    </div>
                </div>
                <div>
                    <label for="parent_id" class="form-label">Üst Kategori</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">Üst Kategori</option>
                        <?php $__currentLoopData = $categories_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php if(isset($categories)): ?> <?php echo e($category->id == $categories->parent_id ? 'selected' : ''); ?> <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                     <div id="parent_id" class="form-text">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/category/form.blade.php ENDPATH**/ ?>