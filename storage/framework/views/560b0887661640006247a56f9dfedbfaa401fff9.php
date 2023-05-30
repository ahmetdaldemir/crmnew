<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Modeller /</span> <?php if(isset($versions)): ?>
                <?php echo e($versions->name); ?>

            <?php endif; ?></h4>
        <div class="card  mb-4">
            <h5 class="card-header">Model Bilgileri</h5>
            <form action="<?php echo e(route('version.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" <?php if(isset($versions)): ?> value="<?php echo e($versions->id); ?>" <?php endif; ?> />
                <input type="hidden" name="brand_id" <?php if(isset($versions)): ?> value="<?php echo e($versions->brand_id); ?>"
                       <?php else: ?>  value="<?php echo e($brand_id); ?>" <?php endif; ?> />
                <div class="card-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Model Adı</label>
                        <input type="text" class="form-control" id="name"
                               <?php if(isset($versions)): ?> value="<?php echo e($versions->name); ?>" <?php endif; ?>  name="name"
                               aria-describedby="name">
                        <div id="name" class="form-text">
                            We'll never share your details with anyone else.
                        </div>
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Resim</label>
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src=""
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar"
                            />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Yeni Resim</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        name="image"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                    />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Yenile</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
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

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Marka</td>
                        <td>Versiyon</td>
                        <td>İşlemler</td>
                    </tr>
                    <?php $__currentLoopData = $versionlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($version->brand->name); ?></td>
                            <td><?php echo e($version->name); ?></td>
                            <td>
                                <a href="<?php echo e(route('version.delete',['id' => $version->id])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="<?php echo e(route('version.edit',['id' => $version->id])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bx-edit-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    <script src="<?php echo e(asset('assets/js/pages-account-settings-account.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/version/form.blade.php ENDPATH**/ ?>