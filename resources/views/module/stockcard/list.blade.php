@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok Kartları /</span> Stok Kart listesi
            <a href="{{route('stockcard.create',['category'=>$category])}}" class="btn btn-primary float-end">Yeni Stok Kartı Ekle</a>
        </h4>

        <div class="card">
            <div class="card-body">
                <form action="{{route('stockcard.list')}}" id="stockSearch" method="get">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$category}}" />
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label" for="multicol-username">Stok</label>
                            <input type="text" class="form-control" placeholder="············" name="stockName">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="multicol-email">Marka</label>
                            <div class="input-group input-group-merge">
                                <select type="text" name="brand" class="form-select" onchange="getVersion(this.value)" style="width: 100%">
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
                                    <select type="text" id="version_id" name="version" class="form-select" style="width: 100%">
                                        <option value="">Tümü</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-password-toggle">
                                <label class="form-label" for="multicol-password">Renk</label>
                                <div class="input-group input-group-merge">
                                    <select type="text" name="color" class="form-select" style="width: 100%">
                                        <option value="">Tümü</option>
                                        @foreach($colors as $color)
                                                 <option value="{{$color->id}}">{{$color->name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-password-toggle">
                                <label class="form-label" for="multicol-password">Şube</label>
                                <div class="input-group input-group-merge">
                                    <select type="text" name="seller" class="form-select" style="width: 100%">
                                        <option value="">Tümü</option>
                                        @foreach($sellers as $seller)
                                                 <option value="{{$seller->id}}">{{$seller->name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-password-toggle">
                                <label class="form-label" for="multicol-confirm-password">Seri Numarası</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="serialNumber" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button   type="submit" class="btn btn-sm btn-outline-primary">Ara</button>
                    </div>
                </form>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Stok Adı</th>
                        <th>Seri No</th>
                        <th>Satış F.</th>
                        <th>Kategori</th>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Renk</th>
                        <th>Tip</th>
                        <th>Şube</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     @foreach($stockcards as $stockcard)
                         <tr>
                            <td>{{$stockcard->id}}</td>
                            <td>{{$stockcard->stock->name}}</td>
                            <td>{{$stockcard->serial_number}}</td>
                            <td><strong>{{$stockcard->sale_price}} ₺</strong></td>
                            <td>{{$stockcard->stock->category->name}}</td>
                            <td>{{$stockcard->stock->brand->name}}</td>
                            <td><?php foreach ($stockcard->stock->version_id as $key) {
                                        echo \App\Models\Version::find($key)->name."</br>";
                                    }
                                    ?></td>
                            <td>{{$stockcard->color->name}}</td>
                            <td>
                                {{$stockcard->assigned_device == 1?'Temlikli Cihaz':'-'}}
                                {{$stockcard->assigned_accessory == 1?'Temlikli Aksesuar':'-'}}
                            </td>
                            <td>{{$stockcard->seller->name}}</td>
                            <td>
                                <button type="button" title="Sevk Et" onclick="openModal('{{$stockcard->serial_number}}')"
                                        class="btn btn-icon btn-success">
                                    <span class="bx bx-transfer"></span>
                                </button>
                                <button type="button" onclick="priceModal({{$stockcard->id}})"
                                        class="btn btn-icon btn-danger">
                                    <span class="bx bxs-dollar-circle"></span>
                                </button>
                             </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-5">
    </div>
    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="transferForm">
                @csrf
                <input id="stockCardId" name="stock_card_id" type="hidden">
                <input id="id" name="id" type="hidden">
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
                            <input type="text" id="serialBackdrop" class="form-control" name="serial_number[]"/>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kapat
                    </button>
                    <button type="submit" class="btn btn-primary">Sevk İşlemi Başlat</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="priceModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="priceForm">
                @csrf
                <input id="stockCardMovementId" name="stock_card_id" type="hidden">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Fiyat Değişiklik İşlemi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Satış Fiyatı</label>
                            <input type="text" id="serialBackdrop" class="form-control" name="sale_price" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kapat
                    </button>
                    <button type="submit" class="btn btn-primary">Fiyat Değiştir</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        function priceModal(id) {
            $("#priceModal").modal('show');
            $("#priceModal #stockCardMovementId").val(id);
        }
        function openModal(id) {
            $("#backDropModal").modal('show');
            $("#serialBackdrop").val(id);
            $("#stockCardId").val(id);
        }

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

        $("#priceForm").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var actionUrl = '{{route('stockcard.singlepriceupdate')}}';
            $.ajax({
                type: "POST",
                url: actionUrl + '?id=' + $("#stockCardMovementId").val() + '',
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
                    $("#priceModal").modal('hide');
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
                    $("#priceModal").modal('hide');
                }
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

            $scope.getStockCard = function () {
                $scope.loading = true; // Show loading image
                var postUrl = window.location.origin + '/getStockCardCategory?id='+{{$category}}+'';   // Returns base URL (https://example.com)
                $http({
                    method: 'GET',
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
@endsection

