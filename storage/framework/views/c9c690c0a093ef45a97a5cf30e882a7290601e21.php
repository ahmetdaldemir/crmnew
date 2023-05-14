<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span
                class="text-muted fw-light">Teknik Servis Formu /</span> <?php if(isset($technical_services)): ?>
                <?php echo e($technical_services->name); ?>

            <?php endif; ?></h4>
        <form action="javascript():;" id="technicalForm" method="post" class="form-repeater source-item ">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" <?php if(isset($technical_services)): ?> value="<?php echo e($technical_services->id); ?>" <?php endif; ?> />
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h5 class="card-header">Cihaz Bilgileri</h5>
                        <div class="card-body">
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
                                                    <?php if(isset($technical_services) && $customer->id == $technical_services->customer_id): ?> selected
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
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Fiziksel Durumu</label>
                                <textarea class="form-control" id="physical_condition" name="physical_condition" aria-describedby="physical_condition"><?php if(isset($technical_services)): ?> <?php echo e($technical_services->physical_condition); ?> <?php endif; ?> </textarea>
                                <div id="physical_condition" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Aksesuar</label>
                                <textarea class="form-control" id="accessories" name="accessories" aria-describedby="accessories"><?php if(isset($technical_services)): ?>  <?php echo e($technical_services->accessories); ?> <?php endif; ?></textarea>
                                <div id="accessories" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Arıza Açıklaması</label>
                                <textarea class="form-control" id="fault_information" name="fault_information" aria-describedby="fault_information"><?php if(isset($technical_services)): ?> <?php echo e($technical_services->fault_information); ?> <?php endif; ?></textarea>
                                <div id="fault_information" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">İşlemler</label>
                                <input id="TagifyBasic" class="form-control" name="process"
                                       <?php if(isset($technical_services)): ?>  value="<?php echo e($technical_services->process); ?>"
                                       <?php endif; ?> tabindex="-1">
                            </div>
                            <div class="mb-3" data-repeater-list="group_a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div class="row w-100 m-0 p-3">
                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Stok</p>
                                                <select name="stock_card_id" id="stock_card_id" onchange="stockCardId(this.value)" class="form-select item-details mb-2">
                                                   <option>Seçiniz</option>
                                                    <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($stock->id); ?>"><?php echo e($stock->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Seri No</p>
                                                <input type="text" class="form-control" name="serial" id="serial"
                                                       placeholder="11111111"/>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Destekli Maliyet</p>
                                                <input type="text" class="form-control invoice-item-price" name="base_cost_price" id="base_cost_price"/>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Satış Fiyatı</p>
                                                <input type="text" class="form-control invoice-item-price" name="sale_price"  id="sale_price"/>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                <p class="mb-2 repeater-title">Qty</p>
                                                <input type="number" class="form-control invoice-item-qty" name="quantity" id="quantity" min="1" max="50">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-repeater-create="">Ürün Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <h5 class="card-header">Özellikler</h5>
                        <div class="card-body">

                            <div>
                                <label for="defaultFormControlInput" class="form-label">Şube Adı</label>
                                <select id="seller_id" name="seller_id" class="select2 form-select">
                                    <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if(isset($technical_services) && $technical_services->seller_id == $seller->id): ?> selected
                                            <?php endif; ?>  value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div id="name" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Marka</label>
                                <select id="brand_id" name="brand_id" class="select2 form-select"
                                        onchange="getVersion(this.value)" required>
                                    <option>Seçiniz</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if(isset($technical_services) && $technical_services->brand_id == $key): ?> selected
                                            <?php endif; ?>  value="<?php echo e($key); ?>"><?php echo e($key); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div id="brand_id" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Model</label>
                                <select id="version_id" name="version_id" class="select2 form-select" required></select>
                                <div id="version_id" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Durum</label>
                                <input type="text" class="form-control" id="status"
                                       <?php if(isset($technical_services)): ?> value="<?php echo e($technical_services->status); ?>"
                                       <?php endif; ?>  name="status"
                                       aria-describedby="status">
                                <div id="status" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Toplam Tutar</label>
                                <input type="text" class="form-control" id="total_price"
                                       <?php if(isset($technical_services)): ?> value="<?php echo e($technical_services->total_price); ?>"
                                       <?php endif; ?>  name="total_price" aria-describedby="total_price">
                                <div id="total_price" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Müşteri Fiyatı</label>
                                <input type="text" class="form-control" id="customer_price"
                                       <?php if(isset($technical_services)): ?> value="<?php echo e($technical_services->customer_price); ?>"
                                       <?php endif; ?>  name="customer_price" aria-describedby="customer_price">
                                <div id="customer_price" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">İşlem Tipi</label>
                                <input type="text" class="form-control" id="process_type"
                                       <?php if(isset($technical_services)): ?> value="<?php echo e($technical_services->process_type); ?>"
                                       <?php endif; ?>  name="process_type"
                                       aria-describedby="process_type">
                                <div id="process_type" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Cihaz Şifresi</label>
                                <input type="text" class="form-control" id="device_password"
                                       <?php if(isset($technical_services)): ?> value="<?php echo e($technical_services->device_password); ?>"
                                       <?php endif; ?> aria-describedby="device_password">
                                <div id="device_password" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Teslim Alan Personel</label>
                                <select id="brand_id" name="delivery_staff" class="select2 form-select">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if(isset($technical_services) && $technical_services->brand_id == $user->id): ?> selected
                                            <?php endif; ?>  value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div id="delivery_staff" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-bg-secondary">
                <div class="card-header">
                    <button type="submit" onclick="save()" class="btn btn-danger btn-buy-now">Kaydet</button>
                </div>
            </div>
        </form>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.customermodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('custom-js'); ?>
    <script src="<?php echo e(asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pages-account-settings-account.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/forms-extras.js')); ?>"></script>

    <!--
    <script>
        $(document).ready(function () {
            $('#control').hide();
            $('#video').resize(function () {
                $('#cont').height($('#video').height());
                $('#cont').width($('#video').width());
                $('#control').height($('#video').height() * 0.1);
                $('#control').css('top', $('#video').height() * 0.9);
                $('#control').width($('#video').width());
                $('#control').show();
            });

            function opencam() {
                navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;
                if (navigator.getUserMedia) {
                    navigator.getUserMedia({video: true}, streamWebCam, throwError);
                }
            }

            function closecam() {

                video.pause();

                try {
                    video.srcObject = null;
                } catch (error) {
                    video.src = null;
                }

                var track = strr.getTracks()[0];  // if only one media track
                // ...
                track.stop();

            }

            var video = document.getElementById('video');
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var strr;

            function streamWebCam(stream) {
                const mediaSource = new MediaSource(stream);
                try {
                    video.srcObject = stream;
                } catch (error) {
                    video.src = URL.createObjectURL(mediaSource);
                }
                video.play();
                strr = stream;
            }

            function throwError(e) {
                alert(e.name);
            }

            $('#open').click(function (event) {
                opencam();
                $('#control').show();
            });
            $('#close').click(function (event) {
                closecam();
            });
            $('#snap').click(function (event) {
                canvas.width = video.clientWidth;
                canvas.height = video.clientHeight;
                context.drawImage(video, 0, 0);
                $('#vid').css('z-index', '20');
                $('#capture').css('z-index', '30');
            });
            $('#retake').click(function (event) {
                $('#vid').css('z-index', '30');
                $('#capture').css('z-index', '20');
            });
        });
    </script>
    -->
    <script>
        function save() {
            var postUrl = window.location.origin + '/technical_service/store';   // Returns base URL (https://example.com)
            $.ajax({
                type: "POST",
                url: postUrl,
                data: $("#technicalForm").serialize(),
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

        function stockCardId(value) {
            var postUrl = window.location.origin + '/getStockCard?id='+value+'';   // Returns base URL (https://example.com)
            $.ajax({
                type: "GET",
                url: postUrl,
                beforeSend: function () {
                    $('#loader').removeClass('display-none')
                },
                success: function (data) {
                   if(data == "")
                   {
                       Swal.fire("Stok Bulunmamaktadır");
                       $("#serial").val("");
                       $("#base_cost_price").val("");
                       $("#sale_price").val("");
                       $("#quantity").val("");
                   }else{
                       $("#serial").val(data.serialNumber);
                       $("#base_cost_price").val(data.baseCostPrice);
                       $("#sale_price").val(data.salePrice);
                       $("#quantity").val(1).attr("max",data.quantity);
                   }
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $(placeholder).append(xhr.statusText + xhr.responseText);
                    $(placeholder).removeClass('loading');
                },
                complete: function (data) {

                },
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/technical_service/form.blade.php ENDPATH**/ ?>