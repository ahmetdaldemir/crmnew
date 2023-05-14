<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h5 class="card-title text-primary">SATIŞ! 🎉</h5>
                                <form action="javascript():;" id="stockSearch" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label" for="multicol-username">Stok</label>
                                            <input type="text" class="form-control" placeholder="············" name="stockName">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="multicol-email">Marka</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="brand" class="form-select"  style="width: 100%">
                                                    <option value="">Tümü</option>
                                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                             </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="multicol-password">Model</label>
                                                <div class="input-group input-group-merge">
                                                    <select type="text" name="version" class="form-select" style="width: 100%">
                                                        <option value="">Tümü</option>
                                                        <?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($version->id); ?>"><?php echo e($version->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="multicol-confirm-password">Seri Numarası</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="serialNumber" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button ng-click="getStockSearch()" type="button" class="btn btn-sm btn-outline-primary">Ara</button>
                                    </div>
                                </form>
                                <div id="nameText"></div>
                            </div>
                            <div class="card-footer">
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Ürün Adı</th>
                                        <th>Kategori</th>
                                        <th>Marka</th>
                                        <th>Model</th>
                                        <th>Adet</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    <tr ng-repeat="item in stockSearchLists">
                                        <td>{{item.name}}</td>
                                        <td>{{item.category}}</td>
                                        <td>{{item.brand}}</td>
                                        <td>{{item.version}}</td>
                                        <td>{{item.quantity}}</td>
                                        <td><a data-id="{{item.id}}" href="<?php echo e(route('invoice.sales')); ?>?id={{item.id}}">Satış</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h5 class="card-title text-primary">SATIŞ! 🎉</h5>
                                <form action="<?php echo e(route('e_invoice.create')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input class="form-control" name="sell" id="sell">
                                    <div class="col-12 mt-4">
                                        <button type="button" class="btn btn-sm btn-outline-primary">Satış Yap</button>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Fatura Kes</button>
                                    </div>
                                </form>
                                <div id="nameText"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Stok Sorgula</h5>
                        <form id="stockForm" action="javascript();" method="post">
                            <?php echo csrf_field(); ?>
                            <input class="form-control" name="serialCode">
                            <div class="col-12 mt-4">
                                <a href="javascript:;" onclick="getStock()" class="btn btn-sm btn-outline-primary">Sorgula</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
            <div class="col-md-12 col-lg-12 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Azalan Ürünler</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Ürün Adı</th>
                                    <th>Kalan Stok</th>
                                    <th>Son Maliyet</th>
                                    <th>Son Satış Fiyatı</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Denem Ürün</td>
                                    <td>2</td>
                                    <td>
                                        150.00 TL
                                    </td>
                                    <td>225.00 TL</td>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            <i class="bx bx-radar"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-sm btn-outline-primary dropdown-toggle"
                                            type="button"
                                            id="growthReportId"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            2022
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                            <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                            <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                            <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="growthChart"></div>
                            <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bx-dollar text-primary"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>2022</small>
                                        <h6 class="mb-0">$32.5k</h6>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-info p-2"><i
                                                class="bx bx-wallet text-info"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>2021</small>
                                        <h6 class="mb-0">$41.2k</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card"
                                             class="rounded"/>
                                    </div>
                                    <div class="dropdown">
                                        <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt4"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block mb-1">Payments</span>
                                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>
                                    -14.82%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                             class="rounded"/>
                                    </div>
                                    <div class="dropdown">
                                        <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt1"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Transactions</span>
                                <h3 class="card-title mb-2">$14,857</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    +28.14%</small>
                            </div>
                        </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div
                                        class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">Profile Report</h5>
                                            <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <small class="text-success text-nowrap fw-semibold"
                                            ><i class="bx bx-chevron-up"></i> 68.2%</small
                                            >
                                            <h3 class="mb-0">$84,686k</h3>
                                        </div>
                                    </div>
                                    <div id="profileReportChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    <script>
        $("#sell").keypress(function(){
            $("#nameText").html("");
            var postUrl = window.location.origin + '/searchStockCard?key=' + $(this).val() + '';   // Returns base URL (https://example.com)
            $.ajax({
                type: "GET",
                url: postUrl,
                encode: true,
            }).done(function (data) {
                 $.each(data, function(index, value) {
                    $("#nameText").append("<br>"+value.name);
                });
            });
        });
    </script>

    <script>
        app.directive('loading', function () {
            return {
                restrict: 'E',
                replace:true,
                template: '<p><img src="img/loading.gif"/></p>', // Define a template where the image will be initially loaded while waiting for the ajax request to complete
                link: function (scope, element, attr) {
                    scope.$watch('loading', function (val) {
                        val = val ? $(element).show() : $(element).hide();  // Show or Hide the loading image
                    });
                }
            }
        }).controller("mainController", function ($scope, $http, $httpParamSerializerJQLike, $window) {
            $scope.getStockSearch = function () {
                $scope.loading = true; // Show loading image
                var postUrl = window.location.origin + '/stockSearch';   // Returns base URL (https://example.com)
                $http({
                    method: 'POST',
                    url: postUrl,
                    data: $("#stockSearch").serialize(),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                   $scope.stockSearchLists = response.data;
                });
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/home.blade.php ENDPATH**/ ?>