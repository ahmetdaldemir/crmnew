@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" onload="getTownLoad(34)">
        <h4 class="fw-bold py-3 mb-4"><span
                class="text-muted fw-light">Teknik Servis Formu /</span> @if(isset($technical_services))
                {{$technical_services->name}}
            @endif</h4>
        <form action="javascript():;" id="technicalForm" method="post" class="form-repeater source-item ">
            @csrf
            <input type="hidden" name="id" @if(isset($technical_services)) value="{{$technical_services->id}}" @endif />
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h5 class="card-header">Cihaz Bilgileri</h5>
                        <div class="card-body">
                            <div class="row mb-4">
                                <label for="selectpickerLiveSearch" class="form-label">Müşteri Seçiniz</label>
                                <div class="col-md-9">
                                    <select id="selectCustomer" class="w-100 select2"
                                            data-style="btn-default" name="customer_id" ng-init="getCustomers()">
                                        <option value="1" data-tokens="ketchup mustard">Genel Cari</option>
                                        <option ng-repeat="customer in customers" ng-selected="customer.id == idNew"
                                                value="@{{customer.id}}">
                                            @{{customer.fullname}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-secondary btn-primary" tabindex="0" data-bs-toggle="modal" data-bs-target="#editUser" type="button"><span><i class="bx bx-plus me-md-1"></i></span></button>
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Hizmet Tipi</label>
                                <div id="physical_condition" class="form-text">
                                    <select class="form-select" name="type">
                                        <option>Kaplama</option>
                                        <option>Kılıf Baskı</option>
                                    </select>
                                 </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Kaplama Bilgisi</label>
                                <textarea class="form-control" id="coating_information" name="coating_information"
                                          aria-describedby="accessories">@if(isset($technical_services))
                                        {{$technical_services->coating_information}}
                                    @endif</textarea>
                             </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Baskı Bilgisi</label>
                                <textarea class="form-control" id="print_information" name="print_information" aria-describedby="print_information">@if(isset($technical_services))
                                        {{$technical_services->print_information}}
                                    @endif</textarea>
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
                                    @foreach($sellers as $seller)
                                        <option
                                            @if(\Illuminate\Support\Facades\Auth::user()->seller_id == $seller->id) selected
                                            @endif  value="{{$seller->id}}">{{$seller->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Marka</label>
                                <select id="brand_id" name="brand_id" class="select2 form-select"
                                        onchange="getVersion(this.value)" required>
                                    <option>Seçiniz</option>
                                    @foreach($brands as $value)
                                        <option
                                            @if(isset($technical_services) && $technical_services->brand_id == $key) selected
                                            @endif  value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Model</label>
                                <select id="version_id" name="version_id" class="select2 form-select" required></select>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Durum</label>
                                <select class="form-control" id="status" name="status">
                                    @foreach(\App\Models\TechnicalService::STATUS as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Müşteri Fiyatı</label>
                                <input type="text" class="form-control" id="customer_price" value="0"
                                       name="customer_price" aria-describedby="customer_price" readonly>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Cihaz Şifresi</label>
                                <input type="text" class="form-control" name="device_password" id="device_password"
                                       @if(isset($technical_services)) value="{{$technical_services->device_password}}"
                                       @endif aria-describedby="device_password">
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Teslim Alan Personel</label>
                                <select id="brand_id" name="delivery_staff" class="select2 form-select">
                                    @foreach($users as $user)
                                        <option
                                            @if(isset($technical_services) && $technical_services->brand_id == $user->id) selected
                                            @endif  value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
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
@endsection
@include('components.customermodaltechnicservice')
@section('custom-js')
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
    <script src="{{asset('assets/js/forms-extras.js')}}"></script>


    <script>
        function save() {
            var postUrl = window.location.origin + '/technical_service/coveringstore';   // Returns base URL (https://example.com)
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
                    window.location.href =  window.location.origin + '/technical_service/index';
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $(placeholder).append(xhr.statusText + xhr.responseText);
                    $(placeholder).removeClass('loading');
                },
                complete: function () {
                    window.location.href = window.location.origin + '/technical_service/index';
                },

            });
        }

        function stockCardId(value) {
            var postUrl = window.location.origin + '/getStockCard?id=' + value + '';   // Returns base URL (https://example.com)
            $.ajax({
                type: "GET",
                url: postUrl,
                beforeSend: function () {
                    $('#loader').removeClass('display-none')
                },
                success: function (data) {
                    if (data == "") {
                        Swal.fire("Stok Bulunmamaktadır");
                        $("#serial").val("");
                        $("#base_cost_price").val("");
                        $("#sale_price").val("");
                        $("#quantity").val("");
                    } else {
                        $("#serial").val(data.serialNumber);
                        $("#base_cost_price").val(data.baseCostPrice);
                        $("#sale_price").val(data.salePrice);
                        $("#quantity").val(1).attr("max", data.quantity);
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

                if ($("input[name='phone1']").val() == "") {
                    alert('Telefon numarası boş olamaz');
                } else if ($("input[name='firstname']").val() == "") {
                    alert('İsim Alanı boş olamaz');
                } else if ($("input[name='lastname']").val() == "") {
                    alert('Soyisim alanı boş olamaz');
                } else {

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
                        $('#selectCustomer option:selected').val(response.data.id);
                        $scope.idNew = response.data.id;
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

            }
        });
    </script>
@endsection
