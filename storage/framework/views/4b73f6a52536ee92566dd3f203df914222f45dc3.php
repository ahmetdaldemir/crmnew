<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Depolar /</span> Depo listesi</h4>

        <div class="card">
            <div class="card-header">
                <a href="<?php echo e(route('warehouse.create')); ?>" class="btn btn-primary float-end">Yeni Depo Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Şube Adı</th>
                        <th>Kayıt Tarihi</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong><?php echo e($warehouse->name); ?></strong></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($warehouse->created_at); ?></span></td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateStatus('warehouse/update',<?php echo e($warehouse->id); ?>,<?php echo e($warehouse->is_status == 1 ? 0:1); ?>)"
                                           id="flexSwitchCheckChecked" <?php echo e($warehouse->is_status == 1 ? 'checked':''); ?> />
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo e(route('warehouse.delete',['id' => $warehouse->id])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="<?php echo e(route('warehouse.edit',['id' => $warehouse->id])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bx-edit-alt"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/warehouse/index.blade.php ENDPATH**/ ?>