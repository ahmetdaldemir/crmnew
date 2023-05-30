<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <form id="invoiceForm" method="post" class="form-repeater source-item py-sm-3">
            <input type="hidden" name="id"/>
            <div class="row invoice-add">
                <div class="col-lg-10 col-12 mb-lg-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <div class="row mb-4">
                                        <label for="selectpickerLiveSearch" class="form-label">Müşteri Seçiniz</label>
                                        <div class="col-md-9">
                                            <select id="selectpickerLiveSearch" class="selectpicker w-100"
                                                    data-style="btn-default" name="customer_id"
                                                    onchange="getCustomer(this.value)" id="customer_id"
                                                    data-live-search="true">
                                                <option value="1" data-tokens="ketchup mustard">Genel Müşteri</option>
                                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($customer->id); ?>"
                                                            <?php if(isset($invoices) && $customer->id == $invoices->customer_id): ?> selected
                                                            <?php endif; ?> data-value="<?php echo e($customer->id); ?>"><?php echo e($customer->fullname); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-secondary btn-primary" tabindex="0"
                                                    data-bs-toggle="modal" data-bs-target="#editUser" type="button">
                                                <span><i class="bx bx-plus me-md-1"></i></span></button>
                                        </div>
                                    </div>
                                    <div class="customerinformation">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mb-2">
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice #</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control"
                                                       value="<?php echo e(rand(11111111111,99999999999999)); ?>" name="number"
                                                       id="invoiceId">
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Fatura Tarihi:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control datepicker flatpickr-input"
                                                       name="create_date"
                                                       <?php if(isset($invoices)): ?> value="<?php echo e($invoices->create_date); ?>"
                                                       <?php else: ?>  value="<?php echo e(date('d-m-Y')); ?>" <?php endif; ?> />
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Fatura Tipi:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <select class="form-control" data-style="btn-default" name="type"
                                                        id="type">
                                                    <option value="1">Gelen Fatura</option>
                                                    <option <?php if(isset($invoices) && $invoices->type == 2): ?> selected
                                                            <?php endif; ?> value="2">Giden Fatura
                                                    </option>
                                                </select>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <hr class="mx-n4">
                            <div class="mb-3" data-repeater-list="group_a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div class="row w-100 m-0 p-3">
                                            <div class="col-md-3 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Stok</p>
                                                <select name="stock_card_id" class="form-select item-details mb-2">
                                                    <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if($product['stock_card_movement']->stock_card_id == $stock->id): ?> selected
                                                            <?php endif; ?>  value="<?php echo e($stock->id); ?>"><?php echo e($stock->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Seri No</p>
                                                <input type="text" class="form-control" name="serial"
                                                       value="<?php echo e($product['stock_card_movement']->serial_number); ?>"/>
                                            </div>

                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Satış Fiyatı</p>
                                                <input type="text" class="form-control invoice-item-price"
                                                       name="sale_price"
                                                       value="<?php echo e($product['stock_card_movement']->sale_price); ?>"/>
                                            </div>
                                            <div class="col-md-1 col-12 mb-md-0 mb-3">
                                                <p class="mb-2 repeater-title">Qty</p>
                                                <input type="number" class="form-control invoice-item-qty"
                                                       name="quantity" value="1" min="1" max="50">
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Neden</p>
                                                <select name="reason_id" class="form-select item-details mb-2">
                                                    <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if($product['stock_card_movement']->reason_id == $reason->id): ?> selected
                                                            <?php endif; ?> value="<?php echo e($reason->id); ?>"><?php echo e($reason->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="taxInput1" class="form-label">KDV</label>
                                                <select name="tax" id="taxInput1" class="form-select tax-select">
                                                    <option <?php if($product['stock_card_movement']->tax == 0): ?> selected
                                                            <?php endif; ?> value="0" selected="">0%
                                                    </option>
                                                    <option <?php if($product['stock_card_movement']->tax == 1): ?> selected
                                                            <?php endif; ?> value="1">1%
                                                    </option>
                                                    <option <?php if($product['stock_card_movement']->tax == 8): ?> selected
                                                            <?php endif; ?> value="8">10%
                                                    </option>
                                                    <option <?php if($product['stock_card_movement']->tax == 18): ?> selected
                                                            <?php endif; ?> value="18" selected>18%
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-5 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">IMEI</p>
                                                <input class="form-control" name="imei"
                                                       value="<?php echo e($product['stock_card_movement']->imei); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-repeater-create="">Stok Ekle</button>
                                    <button type="button" id="dataRepeater" class="btn btn-danger">HESAPLA</button>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4">

                            <div class="row py-sm-3">
                                <div class="col-md-6 mb-md-0 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="salesperson" class="form-label me-5 fw-semibold">Personel:</label>
                                        <select id="selectpickerLiveSearch" class="selectpicker w-100"
                                                data-style="btn-default" name="staff_id" data-live-search="true">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($invoices)): ?>
                                                            <?php echo e($invoices->hasStaff($user->id) ? 'selected' : ''); ?>

                                                        <?php endif; ?> value="<?php echo e($user->id); ?>"
                                                        data-value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">İndirim:</span>
                                            <span class="fw-semibold"><?php echo e($product['stock_card_movement']->discount ?? 0); ?> %</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Kdv:</span>
                                            <span class="fw-semibold"><?php echo e(($product['stock_card_movement']->sale_price * $product['stock_card_movement']->tax) / 100); ?></span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Toplam:</span>
                                            <span class="fw-semibold"> <?php if(isset($product)): ?>
                                                    <?php echo e($product['stock_card_movement']->sale_price); ?>

                                                <?php endif; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Not:</label>
                                        <textarea class="form-control" name="description" rows="2" id="note"> <?php if(isset($invoices)): ?>
                                                <?php echo e($invoices->description); ?>

                                            <?php endif; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Add-->
                <!-- Invoice Actions -->
                <div class="col-lg-2 col-12 invoice-actions">
                    <div class="card mb-4">
                        <div class="card-body">
                            <button onclick="save()" type="button" class="btn btn-primary d-grid w-100 mb-3">
                                <i class="bx bx-paper-plane bx-xs me-1"></i>Fatura Gönder
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class="mb-2">Ödeme Tipi</p>
                        <select name="payment_type" class="form-select mb-4">
                            <option value="1">Havale</option>
                            <option value="2">Kredi Kartı</option>
                            <option value="3">Nakit</option>
                        </select>
                        <div class="d-flex justify-content-between mb-2">
                            <label for="payment-terms" class="mb-0">Payment Terms</label>
                            <label class="switch switch-primary me-0">
                                <input type="checkbox" class="switch-input" id="payment-terms" checked="">
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                      <i class="bx bx-check"></i>
                                    </span>
                                    <span class="switch-off">
                                      <i class="bx bx-x"></i>
                                    </span>
                                  </span>
                                <span class="switch-label"></span>
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <label for="payment-stub" class="mb-0">Payment Stub</label>
                            <label class="switch switch-primary me-0">
                                <input type="checkbox" class="switch-input" id="payment-stub">
                                <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="bx bx-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="bx bx-x"></i>
                            </span>
                          </span>
                                <span class="switch-label"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Actions -->

            </div>
        </form>
        <div id="loader" class="lds-dual-ring display-none overlay"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.customermodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('custom-css'); ?>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, .8);
            z-index: 999;
            opacity: 1;
            transition: all 0.5s;
        }


        .lds-dual-ring {
            display: inline-block;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 5% auto;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .display-none {
            display: none !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    <script src="<?php echo e(asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pages-account-settings-account.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/forms-extras.js')); ?>"></script>
    <script>
        function getCustomer(id) {
            var postUrl = window.location.origin + '/custom_customerget?id=' + id + '';   // Returns base URL (https://example.com)
            $.ajax({
                type: "POST",
                url: postUrl,
                encode: true,
            }).done(function (data) {
                $(".customerinformation").html('<p className="mb-1">' + data.address + '</p><p className="mb-1">' + data.phone1 + '</p><p className="mb-1">' + data.email + '</p>');
            });
        }

        function save() {
            var postUrl = window.location.origin + '/e_invoice/e_invoice_create';   // Returns base URL (https://example.com)
            $.ajax({
                type: "POST",
                url: postUrl,
                data: $("#invoiceForm").serialize(),
                dataType: "json",
                encode: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#loader').removeClass('display-none')
                },
                success: function (data) {
                    Swal.fire(data);
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $(placeholder).append(xhr.statusText + xhr.responseText);
                    $(placeholder).removeClass('loading');
                },
                complete: function () {
                    window.location.href = "<?php echo e(route('invoice.index')); ?>";
                },

            });
        }

    </script>

    <script>
        $("#dataRepeater").click(function () {
            $('.repeater-wrapper[data-repeater-item]').each(function(){
                 console.log($('input').val());
            });
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/einvoice/form.blade.php ENDPATH**/ ?>