@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h5 class="card-title text-primary">SATIŞ! 🎉</h5>
                                <form action="javascript():;" id="stockSearch" method="post">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label" for="multicol-username">Stok</label>
                                            <input type="text" class="form-control" placeholder="············"
                                                   name="stockName">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="multicol-email">Marka</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="brand" class="form-select"
                                                        onchange="getVersion(this.value)" style="width: 100%">
                                                    <option value="">Tümü</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="multicol-password">Model</label>
                                                <div class="input-group input-group-merge">
                                                    <select type="text" id="version_id" name="version"
                                                            class="form-select" style="width: 100%">
                                                        <option value="">Tümü</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="multicol-password">Kategori</label>
                                                <div class="input-group input-group-merge">
                                                    <select type="text" name="category" class="form-select"
                                                            style="width: 100%">
                                                        <option value="">Tümü</option>
                                                        @foreach($categories as $category)
                                                            @if($category->parent_id == 0)
                                                                <option
                                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="multicol-confirm-password">Seri
                                                    Numarası</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" name="serialNumber" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button ng-click="getStockSearch()" type="button"
                                                class="btn btn-sm btn-outline-primary">Ara
                                        </button>
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
                                        <td>@{{item.name}}</td>
                                        <td>@{{item.category}}</td>
                                        <td>@{{item.brand}}</td>
                                        <td>@{{item.version}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary text-nowrap"
                                                    ng-click="getStockSeller(item.id)">
                                                @{{item.quantity}}
                                            </button>
                                        </td>
                                        <td><a ng-if="item.quantity > 0" data-id="@{{item.id}}"
                                               href="{{route('invoice.sales')}}?id=@{{item.id}}">Satış</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Atanan Sevkler</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Gönderici Bayi</th>
                                    <th>Oluşturma Zamanı</th>
                                    <th>Alıcı Bayi</th>
                                    <th>Gönderen</th>
                                    <th>Teslim Alan</th>
                                    <th>Durum</th>
                                    <th>Teslim Tarihi</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($transfers as $transfer)
                                    <tr>
                                        <td>
                                            <a href="{{route('transfer.show',['id'=>$transfer->id])}}">{{$transfer->number}}</a>
                                        </td>
                                        <td>{{$transfer->seller($transfer->main_seller_id)->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($transfer->created_at)->format('d-m-Y')}}</td>
                                        <td>{{$transfer->seller($transfer->delivery_seller_id)->name}}</td>
                                        <td>{{$transfer->user($transfer->user_id)->name}}</td>
                                        <td>{{$transfer->user($transfer->delivery_id)->name}}</td>
                                        <td><span
                                                class="badge bg-label-{{\App\Models\Transfer::STATUS_COLOR[$transfer->is_status]}}">{{\App\Models\Transfer::STATUS[$transfer->is_status]}}</span>
                                        </td>
                                        <td>{{$transfer->comfirm_date}}</td>
                                        <td>
                                            <a onclick="return confirm('Onaylamak istediğinizden eminmisiniz?');"
                                               href="{{route('transfer.update',['id' => $transfer->id,'is_status' => 2])}}"
                                               class="btn btn-icon btn-success">
                                                <span class="bx bx-navigation"></span>
                                            </a>
                                            <a onclick="return confirm('Reddetmek istediğinizden eminmisiniz?');"
                                               href="{{route('transfer.update',['id' => $transfer->id,'is_status' => 3])}}"
                                               class="btn btn-icon btn-danger">
                                                <span class="bx bx-sad"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
                                @foreach($stockTracks as $stockTrack)
                                    <tr>
                                        <td>{{$stockTrack['name']}}</td>
                                        <td>{{$stockTrack['quantity']}}</td>
                                        <td>{{$stockTrack['name']}}</td>
                                        <td>{{$stockTrack['name']}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger">
                                                <i class="bx bx-radar"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
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
                            <h5 class="card-header m-0 me-2 pb-3">{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="card">
                    <form class="modal-content" id="transferForm">
                        @csrf
                        <div class="card-header">Sevk İşlemi</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Serial Number</label>
                                    <input type="text" id="serialBackdrop" class="form-control"
                                           placeholder="Seri Numarası"
                                           name="serial_number[]">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="sellerBackdrop" class="form-label">Şube</label>
                                    <select class="form-control" name="seller_id" id="sellerBackdrop">
                                        @foreach($sellers as $seller)
                                            <option value="{{$seller->id}}">{{$seller->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="sellerBackdrop" class="form-label">Neden</label>
                                    <select class="form-control" name="reason_id" id="sellerBackdrop">
                                        <option value="4">SATIŞ</option>
                                        <option value="5">SIFIR</option>
                                        <option value="6">İKİNCİ El SATIŞ</option>
                                        <option value="7">SATIŞ İADE</option>
                                        <option value="8">HASARLI İADE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="padding: 10px;">
                            <button type="submit" class="btn btn-primary">Sevk İşlemi Başlat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="getCCModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center">
                        <table class="table table-bordered">
                            <tr>
                                <td>Bayi</td>
                                <td>Adet</td>
                            </tr>
                            <tr ng-repeat="item in data">
                                <td>@{{item.sellerName}}</td>
                                <td>@{{item.quantity}}</td>
                            </tr>
                        </table>

                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')

    <script>
        $("#sell").keypress(function () {
            $("#nameText").html("");
            var postUrl = window.location.origin + '/searchStockCard?key=' + $(this).val() + '';   // Returns base URL (https://example.com)
            $.ajax({
                type: "GET",
                url: postUrl,
                encode: true,
            }).done(function (data) {
                $.each(data, function (index, value) {
                    $("#nameText").append("<br>" + value.name);
                });
            });
        });
    </script>

    <script>
        $("#transferForm").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var actionUrl = '{{route('stockcard.sevk')}}';

            $.ajax({
                type: "POST",
                url: actionUrl + '?id=' + $("#stockCardId").val() + '',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data, status) {
                    Swal.fire({
                        icon: status,
                        title: data,
                        customClass: {
                            confirmButton: "btn btn-success"
                        },
                        buttonsStyling: !1
                    });
                    $("#backDropModal").modal('hide');
                    window.location.reload();
                },
                error: function (request, status, error) {
                    Swal.fire({
                        icon: status,
                        title: request.responseJSON,
                        customClass: {
                            confirmButton: "btn btn-danger"
                        },
                        buttonsStyling: !1
                    });
                    $("#backDropModal").modal('hide');
                }
            });
        });
    </script>

    <script>
        app.directive('loading', function () {
            return {
                restrict: 'E',
                replace: true,
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

                    if (typeof response.data.autoredirect !== "undefined" && response.data.autoredirect == false) {
                        Swal.fire('Stok Yetersiz');
                        $scope.stockSearchLists = null;
                    }
                    if (typeof response.data.autoredirect !== "undefined" && response.data.autoredirect) {
                        window.location.href = "{{route('invoice.sales')}}?id=" + response.data.id + "&serial=" + response.data.serial + "";
                    } else if (typeof response.data.autoredirect === "undefined") {
                        $scope.stockSearchLists = response.data;
                    }
                });
            }


            $scope.getStockSeller = function (id) {
                var postUrl = window.location.origin + '/getStockSeller?id=' + id + '';   // Returns base URL (https://example.com)
                $http({
                    method: 'GET',
                    url: postUrl,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(function successCallback(response) {
                    $("#getCCModal").modal('show');
                    $scope.data = response.data;
                });
            }

        });
    </script>
@endsection
