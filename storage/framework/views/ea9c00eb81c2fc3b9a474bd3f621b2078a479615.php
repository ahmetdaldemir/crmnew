<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <form id="invoiceForm" method="post" class="form-repeater source-item py-sm-3">
            <input type="hidden" name="id" <?php if(isset($invoices)): ?> value="<?php echo e($invoices->id); ?>" <?php endif; ?> />
            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="col-lg-10 col-12 mb-lg-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <div class="row mb-4">
                                        <label for="selectCustomer" class="form-label">Cari Seçiniz</label>
                                        <div class="col-md-9">
                                            <select id="selectCustomer" class="w-100 select2"
                                                    data-style="btn-default" name="customer_id" ng-init="getCustomers()"
                                                    onchange="getCustomer(this.value)">
                                                <option value="1" data-tokens="ketchup mustard">Genel Cari</option>
                                                <option ng-repeat="customer in customers"
                                                        <?php if(isset($invoices) && '{{customer.id}}' == $invoices->customer_id): ?> selected
                                                        <?php endif; ?> data-value="{{customer.id}}" value="{{customer.id}}">
                                                    {{customer.fullname}}
                                                </option>
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
                                                       <?php if(isset($invoices)): ?> value="<?php echo e($invoices->number); ?>"
                                                       <?php endif; ?> name="number" id="invoiceId">
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
                                                <select class="form-control" data-style="btn-default" name="type" id="type">
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
                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Stok</p>
                                                <select name="stock_card_id" id="stock_card_id"  class="form-select item-details select2 mb-2">
                                                    <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($stock->id); ?>"><?php echo e($stock->name); ?> -
                                                            <small> <?php echo e($stock->brand->name); ?></small> - <b>  <?php
                                                               $datas = json_decode($stock->version(), TRUE);
                                                               foreach ($datas as $mykey => $myValue) {
                                                                   echo "$myValue,";
                                                               }
                                                               ?></b>
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Seri No</p>
                                                <input type="text" class="form-control" name="serial"  placeholder="11111111"/>
                                            </div>

                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Neden</p>
                                                <select name="reason_id"  class="js-example-basic-single js-states form-control " id="id_label_single"  tabindex="-1" aria-hidden="true">
                                                    <?php $__currentLoopData = \App\Models\Reason::ReasonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $myValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <optgroup label="<?php echo e($myValue); ?>">
                                                            <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($reason->type == $key): ?>
                                                                    <option value="<?php echo e($reason->id); ?>"><?php echo e($reason->name); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </optgroup>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Destekli Maliyet</p>
                                                <input type="text" class="form-control invoice-item-price" name="base_cost_price" readonly/>
                                            </div>
                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Satış Fiyatı</p>
                                                <input type="text" class="form-control invoice-item-price" name="sale_price" required="required"/>
                                            </div>
                                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                <p class="mb-2 repeater-title">Adet</p>
                                                <input type="number" class="form-control invoice-item-qty" value="1"  name="quantity" min="1" max="50" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-repeater-create="">Add Item
                                    </button>
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
                                <div class="col-md-6 mb-md-0 mb-3" id="safeArea"></div>
                                <hr>
                                <div class="col-md-12 d-flex justify-content-start">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Aratoplam:</span>
                                            <span class="fw-semibold"></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">İndirim:</span>
                                            <span class="fw-semibold"></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Kdv:</span>
                                            <span class="fw-semibold"></span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Toplam:</span>
                                            <span class="fw-semibold"> <?php if(isset($invoices)): ?>
                                                    <?php echo e($invoices->total_price); ?>

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
                <div class="col-lg-2 col-12 invoice-actions">
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
                                    <option <?php if($category->id == '1'): ?> selected
                                            <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p class="mb-2"><i class="bx bx-calendar bx-md me-1"></i> Ödeneceği Tarih</p>
                            <input type="text" class="form-control flatpickr-input" placeholder="DD-MM-YYYY"
                                   id="flatpickr-date" readonly="readonly">
                        </div>
                    </div>
                    <!-- /Invoice Actions -->

                </div>

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

        @keyframes  lds-dual-ring {
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
            var postUrl = window.location.origin + '/sale/store';   // Returns base URL (https://example.com)
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
            if (type == 'paid') {
                $("#safeArea").html('<div class="d-flex align-items-center mb-3">' +
                    '<label for="salesperson" class="form-label me-5 fw-semibold">Kasa / Banka:</label>' +
                    '<select id="selectpickerLiveSearch" class="form-select w-100" data-style="btn-default" name="staff_id" data-live-search="true">' +
                    <?php $__currentLoopData = $safes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $safe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<option <?php if(isset($invoices)): ?> <?php echo e($invoices->hasSafe($safe->id) ? 'selected' : ''); ?> <?php endif; ?> value="<?php echo e($safe->id); ?>" data-value="<?php echo e($safe->id); ?>"><?php echo e($safe->name); ?></option>' +
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        '</select>' +
                    '</div>');
            } else if (type == 'paidOutOfPocket') {
                $("#safeArea").html('<div class="d-flex align-items-center mb-3">' +
                    '<label for="salesperson" class="form-label me-5 fw-semibold">İsim Soyisim:</label>' +
                    '<input type="text" id="pay_to" class="form-control" name="pay_to" <?php if(isset($invoices)): ?> value="<?php echo e($invoices->pay_to); ?>" <?php endif; ?> />' +
                    '</div>');
            } else {
                $("#safeArea").html(' ');
            }
        })
    </script>

    <script>
        app.controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
            $scope.getCustomers = function () {
                var postUrl = window.location.origin + '/customers';   // Returns base URL (https://example.com)
                $http({
                    method: 'GET',
                    //url: './comment/change_status?id=' + id + '&status='+status+'',
                    url: postUrl,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.customers = response.data;
                });
            }
            $scope.customerSave = function () {
                var postUrl = window.location.origin + '/custom_customerstore';   // Returns base URL (https://example.com)
                var formData = $("#customerForm").serialize();

                $http({
                    method: 'POST',
                    url: postUrl,
                    data: formData,
                    dataType: "json",
                    encode: true,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $scope.getCustomers();
                    $(".customerinformation").html('<p className="mb-1">\'+data.address+\'</p>\n' + '<p className="mb-1">\'+data.phone1+\'</p>');
                    $('#selectCustomer option:selected').val(response.data.id);
                    var modalDiv = $("#editUser");
                    modalDiv.modal('hide');
                    modalDiv
                        .find("input,textarea,select")
                        .val('')
                        .end()
                        .find("input[type=checkbox], input[type=radio]")
                        .prop("checked", "")
                        .end();
                });
            }
        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/sale/form.blade.php ENDPATH**/ ?>