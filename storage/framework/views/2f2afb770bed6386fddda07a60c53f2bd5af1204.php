<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-3 gap-2">
                                    <span
                                        class="app-brand-text demo text-body text-uppercase fw-bolder"><?php echo e(is_null($invoice->account) ? 'Genel Cari':$invoice->account->fullname); ?></span>
                                </div>
                                <p class="mb-1"><?php echo e(is_null($invoice->account) ? 'Genel Cari':$invoice->account->phone1); ?></p>
                                <p class="mb-1"><?php echo e(is_null($invoice->account) ? 'Genel Cari':$invoice->account->email); ?></p>
                                <p class="mb-0"><?php echo e(is_null($invoice->account) ? 'Genel Cari':$invoice->account->address.'/'.$invoice->account->city->name .'/'.$invoice->account->town->name); ?></p>
                            </div>
                            <div>
                                <h4>#<?php echo e($invoice->number); ?></h4>
                                <div class="mb-2">
                                    <span class="me-1">Tarih:</span>
                                    <span class="fw-semibold"><?php echo e($invoice->create_date); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="table-responsive">
                        <table class="table border-top m-0">
                            <thead>
                            <tr>
                                <th>Ürün</th>
                                <th>Seri Numarası</th>
                                <th>Adet</th>
                                <th>Alış Fiyatı</th>
                                <th>Destekli Fiyat</th>
                                <th>Satış Fiyatı</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($invoice->detail): ?>
                                <?php $__currentLoopData = $invoice->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-nowrap"><?php echo e($item->stock->brand->name); ?>/
                                                <?php
                                                $datas = json_decode($item->stock->version(), TRUE);
                                                foreach ($datas as $mykey => $myValue) {
                                                    echo "<b>".$myValue,"</b>";
                                                }
                                                ?>  /<?php echo e($item->stock->name); ?></td>
                                        <td class="text-nowrap"><?php echo e($item->serial_number); ?></td>
                                        <td class="text-nowrap"><?php echo e($item->quantity); ?></td>
                                        <td><?php echo e($item->cost_price); ?></td>
                                        <td><?php echo e($item->base_cost_price); ?></td>
                                        <td><?php echo e($item->sale_price); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <tr>
                                <td colspan="3" class="align-top px-4 py-5">
                                    <p class="mb-2">
                                        <span class="me-1 fw-semibold">Personel:</span>
                                        <span><?php echo e($invoice->staff->name); ?></span>
                                    </p>
                                </td>
                                <td class="text-end px-4 py-5">
                                    <p class="mb-2">Ara Toplam:</p>
                                    <p class="mb-2">İndirim:</p>
                                    <p class="mb-2">KDV:</p>
                                    <p class="mb-0">Toplam:</p>
                                </td>
                                <td class="px-4 py-5">
                                    <p class="fw-semibold mb-2">1</p>
                                    <p class="fw-semibold mb-2">1</p>
                                    <p class="fw-semibold mb-2">1</p>
                                    <p class="fw-semibold mb-0"><?php echo e($invoice->total_price); ?></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-semibold">Not:</span>
                                <span><?php echo e($invoice->description); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-label-secondary d-grid w-100 mb-3" target="_blank"
                           href="#">
                            Print
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/invoice/show.blade.php ENDPATH**/ ?>