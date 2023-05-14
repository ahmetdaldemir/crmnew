<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Teknik Servis /</span> Teknik Servis listesi</h4>

        <div class="card">
            <div class="card-header">
                <a href="<?php echo e(route('technical_service.create')); ?>" class="btn btn-primary float-end">Yeni Teknik Servis Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Şube Adı</th>
                        <th>Müşteri</th>
                        <th>Marka/Model</th>
                        <th>İşlem Durumu</th>
                        <th>Ödeme Durumu</th>
                        <th>Tarih</th>
                        <th>Personel</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $technical_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technical_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo e($technical_service->seller->name); ?></td>
                            <td><?php echo e($technical_service->customer->fullname); ?></td>
                            <td>    <?php echo e($technical_service->brand); ?> /
                                    <?php
                                    $datas = json_decode($technical_service->version(), TRUE);
                                    foreach ($datas as $mykey => $myValue) {
                                        echo "$myValue</br>";
                                    }
                                    ?>
                            </span></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($technical_service->process_type); ?></span></td>
                            <td><span class="badge bg-label-primary me-1"><?php echo e($technical_service->status); ?></span></td>
                            <td><?php echo e($technical_service->created_at); ?></td>
                            <td><?php echo e($technical_service->delivery->name); ?></td>
                            <td>
                                <a href="#"
                                   class="btn btn-icon btn-danger"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Form Yazdır" onclick="technicalServiceOpen()">
                                    <span class="bx bxs-printer"></span>
                                </a>
                                <a  class="btn btn-icon btn-success"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Ödeme İşlemi" onclick="checkoutModalOpen()">
                                    <span class="bx bxs-dollar-circle"></span>
                                </a>
                                <a
                                   class="btn btn-icon btn-warning"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Sms Gönder" onclick="smsModalOpen()">
                                    <span class="bx bxs-message-add"></span>
                                </a>
                                <a href="<?php echo e(route('technical_service.show',['id' => $technical_service->id])); ?>"
                                   class="btn btn-icon btn-secondary"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Görüntüle">
                                    <span class="bx bxs-happy-heart-eyes"></span>
                                </a>
                                <a  onclick="return confirm('Silmek istediğinizden eminmisiniz?');" href="<?php echo e(route('technical_service.delete',['id' => $technical_service->id])); ?>"
                                   class="btn btn-icon btn-primary"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    data-bs-original-title="Sil">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="<?php echo e(route('technical_service.edit',['id' => $technical_service->id])); ?>"
                                   class="btn btn-icon btn-primary"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Düzenle">
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
<?php echo $__env->make('components.technical_service_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.smsmodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('components.technical_service_checkout_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('custom-js'); ?>
    <script>
        function technicalServiceOpen() {
            $("#technicalServiceModal").modal('show');
        }
    </script>
    <script>
        function smsModalOpen() {
          $("#smsModal").modal('show');
        }
    </script>
    <script>
        function checkoutModalOpen() {
            $("#checkoutModal").modal('show');
        }
    </script>
<?php $__env->stopSection(); ?>
<!-- route('technical_service.print',['id' => $technical_service->id])  -->


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/technical_service/index.blade.php ENDPATH**/ ?>