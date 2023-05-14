<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Müşteriler /</span> Müşteri listesi</h4>

        <div class="card">
            <div class="card-header">
                <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-primary float-end">Yeni Müşteri Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Müşteri Adı</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th>Kayıt Tarihi</th>
                        <th>Status</th>
                        <th><strong>Satış Yapma</strong></th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo e($customer->fullname); ?></strong></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($customer->phone1); ?></span></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($customer->email); ?></span></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($customer->created_at); ?></span></td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateStatus('customer/update',<?php echo e($customer->id); ?>,<?php echo e($customer->is_status == 1 ? 0:1); ?>)"
                                           id="flexSwitchCheckChecked" <?php echo e($customer->is_status == 1 ? 'checked':''); ?> />
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateDanger('customer/updateDanger',<?php echo e($customer->id); ?>,<?php echo e($customer->is_danger == 1 ? 0:1); ?>)"
                                           id="flexSwitchCheckChecked" <?php echo e($customer->is_danger == 1 ? 'checked':''); ?> />
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo e(route('customer.delete',['id' => $customer->id])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="<?php echo e(route('customer.edit',['id' => $customer->id])); ?>"
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/customer/index.blade.php ENDPATH**/ ?>