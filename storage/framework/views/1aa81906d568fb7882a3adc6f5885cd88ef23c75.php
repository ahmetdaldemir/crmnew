<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bankalar /</span> Banka listesi</h4>

        <div class="card">
            <div class="card-header">
                <a href="<?php echo e(route('bank.create')); ?>" class="btn btn-primary float-end">Yeni Banka Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Banka Adı</th>
                        <th>Iban</th>
                        <th>Kayıt Tarihi</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo e($bank->name); ?></strong></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($bank->iban); ?></span></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($bank->created_at); ?></span></td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateStatus('bank/update',<?php echo e($bank->id); ?>,<?php echo e($bank->is_status == 1 ? 0:1); ?>)"
                                           id="flexSwitchCheckChecked" <?php echo e($bank->is_status == 1 ? 'checked':''); ?> />
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo e(route('bank.delete',['id' => $bank->id])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="<?php echo e(route('bank.edit',['id' => $bank->id])); ?>"
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/bank/index.blade.php ENDPATH**/ ?>