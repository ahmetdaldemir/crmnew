<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <form id="invoiceForm" method="post" class="form-repeater source-item py-sm-3">
            <input type="hidden" name="id" <?php if(isset($invoices)): ?> value="<?php echo e($invoices->id); ?>" <?php endif; ?> />
            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-md-6 mb-md-0 mb-4">

                                </div>
                                <div class="col-md-6">
                                    <dl class="row mb-2">
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice #</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control"
                                                       <?php if(isset($invoices)): ?> value="<?php echo e($invoices->number); ?>"
                                                       <?php endif; ?> name="number" id="invoiceId">
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Fatura Tarihi:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" id="invoice-date" class="form-control flatpickr-input"
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
                                                    <option <?php if(isset($invoices) && $invoices->type == 1): ?> selected
                                                            <?php endif; ?> value="1">Gelen Fatura
                                                    </option>
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
                            <div class="mb-3">
                                    <div class="row">
                                        <label for="total_price" class="col-md-3 col-form-label">Toplam Tutar / Döviz  </label>
                                        <div class="col-md-9">
                                            <div class=" input-group">
                                                <input type="text" class="form-control" id="total_price"
                                                       <?php if(isset($invoices)): ?> value="<?php echo e($invoices->total_price); ?>"
                                                       <?php endif; ?>  name="total_price"
                                                       aria-describedby="name"
                                                       aria-label="Text input with segmented dropdown button" required>
                                                <input name="exchange" id="exchange" value="1" type="hidden">
                                                <input name="currency" id="currency" value="1" type="hidden">
                                                <span class="input-group-text" id="exchange_text">1.00</span>
                                                <button type="button" class="btn btn-outline-primary"> <span id="currencySymbol" style="font-weight: 800;margin-right: 10px;">₺</span> Döviz</button>
                                                <button type="button"
                                                        class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a class="dropdown-item" onclick="currencyCalculate('<?php echo e($currency->symbol); ?>',<?php echo e($currency->id); ?>,<?php echo e($currency->exchange_rate); ?>)" data-id="<?php echo e($currency->id); ?>" data-exchange="<?php echo e($currency->exchange_rate); ?>" href="javascript:void(0);"><?php echo e($currency->name); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <hr>

                                    <div class="row">
                                        <label for="total_price" class="col-md-3 col-form-label">Dönem</label>
                                        <div class="col-md-9">
                                            <div class=" input-group">
                                                <select class="form-select" id="periodMounth" name="periodMounth">
                                                        <option value="1" >Ocak</option>
                                                        <option value="2" >Şubat</option>
                                                        <option value="3" >Mart</option>
                                                        <option value="4" >Nisan</option>
                                                        <option value="5" >Mayıs</option>
                                                        <option value="6" >Haziran</option>
                                                        <option value="7" >Temmuz</option>
                                                        <option value="8" >Ağustos</option>
                                                        <option value="9" >Eylül</option>
                                                        <option value="10" >Ekim</option>
                                                        <option value="11" >Kasım</option>
                                                        <option value="12" >Aralık</option>
                                                </select>
                                                <select class="form-select" id="periodYear" name="periodYear">
                                                    <?php for($i=2000; $i < 2100; $i++): ?>
                                                        <option value="<?php echo e($i); ?>" <?php if($i == \Carbon\Carbon::now()->format('Y')): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <hr class="my-4 mx-n4">
                            <div class="row py-sm-3">
                                <div class="col-md-6 mb-md-0 mb-3" id="safeArea"></div>
                            </div>


                            <hr class="my-4">

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Not:</label>
                                        <textarea class="form-control" name="description" rows="3" id="note"> <?php if(isset($invoices)): ?>
                                                <?php echo e($invoices->description); ?>

                                            <?php endif; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12 invoice-actions">
                    <div class="card mb-4 ">
                        <div class="card-body">
                            <button onclick="save()" type="button" class="btn btn-primary d-grid w-100 mb-3">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-paper-plane bx-xs me-1"></i>Kaydet</span>
                            </button>
                        </div>
                    </div>
                    <div class="card bg-secondary text-white mb-3  mb-4 ">
                        <div class="card-body">

                            <p class="mb-2"><i class="bx bx-money bx-md me-1"></i> Ödeme Durumu</p>
                            <select name="paymentStatus" id="paymentStatus" class="form-select mb-4">
                                <option value="unpaid">Ödenecek</option>
                                <option value="paid">Ödendi</option>
                                <option value="paidOutOfPocket">Çalışan Cebinden Ödedi</option>
                            </select>
                            <p class="mb-2"><i class="bx bx-credit-card bx-md me-1"></i> Ödeme Tipi</p>
                            <select name="payment_type" class="form-select mb-4">
                                <option value="1">Havale</option>
                                <option value="2">Kredi Kartı</option>
                                <option value="3">Nakit</option>
                            </select>
                            <p class="mb-2"><i class="bx bx-folder-open bx-md me-1"></i> Kategori</p>
                            <select name="accounting_category_id" class="form-select mb-4">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($category->id == '6'): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p class="mb-2"><i class="bx bx-calendar bx-md me-1"></i> Ödeneceği Tarih</p>
                            <input type="text" class="form-control flatpickr-input" placeholder="DD-MM-YYYY" id="flatpickr-date" readonly="readonly">
                        </div>
                    </div>
                    <!-- /Invoice Actions -->

                </div>
        </form>
        <div id="loader" class="lds-dual-ring display-none overlay"></div>
    </div>
<?php $__env->stopSection(); ?>

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

    <script src="<?php echo e(asset('assets/js/forms-extras.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/forms-pickers.js')); ?>"></script>
    <script>


        function save() {
            var postUrl = window.location.origin + '/invoice/store';   // Returns base URL (https://example.com)
            $.ajax({
                type: "POST",
                url: postUrl,
                data: $("#invoiceForm").serialize(),
                dataType: "json",
                encode: true,
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


        $("#paymentStatus").change(function () {
            var type = $(this).val();
            if(type == 'paid')
            {
                $("#safeArea").html('<div class="d-flex align-items-center mb-3">'+
                    '<label for="salesperson" class="form-label me-5 fw-semibold">Kasa / Banka:</label>'+
                    '<select id="selectpickerLiveSearch" class="form-select w-100" data-style="btn-default" name="staff_id" data-live-search="true">'+
                    <?php $__currentLoopData = $safes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $safe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<option <?php if(isset($invoices)): ?> <?php echo e($invoices->hasSafe($safe->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($safe->id); ?>" data-value="<?php echo e($safe->id); ?>"><?php echo e($safe->name); ?></option>'+
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        '</select>'+
                    '</div>');
            }else if(type == 'paidOutOfPocket')
            {
                $("#safeArea").html('<div class="d-flex align-items-center mb-3">'+
                    '<label for="salesperson" class="form-label me-5 fw-semibold">İsim Soyisim:</label>'+
                    '<input type="text" id="pay_to" class="form-control" name="pay_to" <?php if(isset($invoices)): ?> value="<?php echo e($invoices->pay_to); ?>" <?php endif; ?> />'+
                    '</div>');
            }else{
                $("#safeArea").html(' ');
            }
        })

        function currencyCalculate(symbol,currency,exchange)
        {
            var price = $("#total_price").val();
            $("input[name='exchange']").text(exchange);
            $("input[name='currency']").text(currency);
            $("#exchange_text").text(parseFloat(exchange, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#currencySymbol").text(symbol);
            if(price == '')
            {
                $("#total_price").val(null);
            }else{
                var total_price = (price * exchange);
                $("#total_price").val(total_price);
            }

        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/invoice/tax.blade.php ENDPATH**/ ?>