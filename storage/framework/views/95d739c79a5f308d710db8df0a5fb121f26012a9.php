<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Faturalar /</span> Fatura listesi</h4>

        <div class="card">
            <div class="card-header">

                <div class="btn-group demo-inline-spacing float-end">
                    <a href="<?php echo e(route('invoice.create.fast')); ?>" class="btn btn-primary float-end">Hızlı Fiş Fatura Ekle</a>
                    <a href="<?php echo e(route('invoice.create')); ?>" class="btn btn-danger float-end">Yeni Fatura Ekle</a>
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Diğer</button>
                    <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item" href="<?php echo e(route('invoice.create.personal')); ?>">Personel Gideri Ekle</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('invoice.create.bank')); ?>">Banka Gideri Ekle</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('invoice.create.tax')); ?>">Vergi / SGK Gideri Ekle</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Fatura No / Tarih</th>
                        <th style="text-align: center">Cari</th>
                        <th style="text-align: center">Tipi</th>
                        <th style="text-align: center">Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="<?php echo e(route('invoice.show',['id' => $invoice->id])); ?>">#<?php echo e($invoice->number??"Numara Girilmedi"); ?></a> / <?php echo e(\Carbon\Carbon::parse($invoice->created_at)->format('d-m-Y')); ?></td>
                            <td style="text-align: center;"><strong><?php echo e($invoice->account->fullname ?? "Genel Cari"); ?></strong></td>
                            <td style="text-align: center;">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-2">
                                            <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bxs-user"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="badge bg-label-<?php echo e($invoice->invoice_type_color($invoice->type)); ?>"><?php echo e($invoice->invoice_type($invoice->type)); ?></span>
                                    </div>
                                </div>

                            </td>
                            <td style="text-align: center;">
                                <?php if($invoice->is_status == 1): ?>
                                    <span data-bs-toggle="tooltip" data-bs-html="true"
                                          data-bs-original-title="<span>Gönderilmedi<br> Fiyat: <?php echo e($invoice->total_price); ?><br>
                                           Fatura Tarihi: <?php echo e(\Carbon\Carbon::parse($invoice->create_date)->format('d-m-Y')); ?></span>"
                                          aria-describedby="tooltip472596"><span
                                            class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i
                                                class="bx bx-paper-plane bx-xs"></i></span></span>
                                <?php endif; ?>
                                <?php if($invoice->is_status == 2): ?>
                                    <span data-bs-toggle="tooltip" data-bs-html="true"
                                          aria-label="<span>Partial Payment<br> Balance: 0<br> Due Date: 09/25/2020</span>"
                                          data-bs-original-title="<span>Partial Payment<br> Balance: 0<br> Due Date: 09/25/2020</span>"
                                          aria-describedby="tooltip478233"><span
                                            class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i
                                                class="bx bx-adjust bx-xs"></i></span></span>
                                <?php endif; ?>

                                <?php if($invoice->is_status == 3): ?>
                                    <span data-bs-toggle="tooltip" data-bs-html="true"
                                          aria-label="<span>Past Due<br> Balance: 0<br> Due Date: 08/01/2020</span>"
                                          data-bs-original-title="<span>Past Due<br> Balance: 0<br> Due Date: 08/01/2020</span>"
                                          aria-describedby="tooltip774099"><span
                                            class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i
                                                class="bx bx-info-circle bx-xs"></i></span></span>
                                <?php endif; ?>


                            </td>
                            <td>
                                <a title="Seri Numarası Yazdır" target="_blank" href="<?php echo e(route('invoice.serialprint',['id' => $invoice->id])); ?>" class="btn btn-icon btn-primary">
                                    <span class="bx bx-barcode-reader"></span>
                                </a>
                                <a title="Düzenle" href="<?php echo e(route('invoice.edit',['id' => $invoice->id])); ?>"  class="btn btn-icon btn-primary">
                                    <span class="bx bx-edit-alt"></span>
                                </a>
                                <a title="Sil" href="<?php echo e(route('invoice.delete',['id' => $invoice->id])); ?>" class="btn btn-icon btn-danger">
                                    <span class="bx bxs-trash"></span>
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

    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="transferForm">
                <?php echo csrf_field(); ?>
                <input id="stockCardId" name="stock_card_id" type="hidden">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Sevk İşlemi</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Serial Number</label>
                            <input
                                type="text"
                                id="serialBackdrop"
                                class="form-control"
                                placeholder="Seri Numarası"
                                name="serial_number"
                            />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="invoiceBackdrop" class="form-label">Şube</label>
                            <select class="form-control" name="invoice_id" id="invoiceBackdrop">
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($invoice->id); ?>"><?php echo e($invoice->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kapat
                    </button>
                    <button type="submit" class="btn btn-primary">Sevk İşlemi Başlat</button>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    <script>

        function openModal(id) {
            $("#backDropModal").modal('show');
            $("#stockCardId").val(id);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/invoice/index.blade.php ENDPATH**/ ?>