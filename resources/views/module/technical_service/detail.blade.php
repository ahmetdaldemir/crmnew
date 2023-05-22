@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span
                class="text-muted fw-light">Teknik Servis Formu /</span> @if(isset($technical_services))
                {{$technical_services->name}}
            @endif</h4>
        <form action="javascript():;" id="technicalForm" method="post">
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
                                    <select id="selectpickerLiveSearch" class="selectpicker w-100"
                                            data-style="btn-default" name="customer_id"
                                            onchange="getCustomer(this.value)" id="customer_id"
                                            data-live-search="true">
                                        <option value="1" data-tokens="ketchup mustard">Genel Müşteri</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}"
                                                    @if(isset($technical_services) && $customer->id == $technical_services->customer_id) selected
                                                    @endif data-value="{{$customer->id}}">{{$customer->fullname}}</option>
                                        @endforeach
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
                                <textarea class="form-control" id="physical_condition" name="physical_condition" aria-describedby="physical_condition">@if(isset($technical_services)) {{$technical_services->physical_condition}} @endif </textarea>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Aksesuar</label>
                                <textarea class="form-control" id="accessories" name="accessories" aria-describedby="accessories">@if(isset($technical_services))  {{$technical_services->accessories}} @endif</textarea>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Arıza Açıklaması</label>
                                <textarea class="form-control" id="fault_information" name="fault_information" aria-describedby="fault_information">@if(isset($technical_services)) {{$technical_services->fault_information}} @endif</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <h5 class="card-header">Özellikler</h5>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Şube Adı</label>
                                    <select id="seller_id" name="seller_id" class="select2 form-select">
                                        @foreach($sellers as $seller)
                                            <option
                                                @if(isset($technical_services) && $technical_services->seller_id == $seller->id) selected
                                                @endif  value="{{$seller->id}}">{{$seller->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Marka</label>
                                    <select id="brand_id" name="brand_id" class="select2 form-select"
                                            onchange="getVersion(this.value)" required>
                                        <option>Seçiniz</option>
                                        @foreach($brands as   $value)
                                            <option @if(isset($technical_services) && $technical_services->brand_id == $value->id) selected @endif  value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Model</label>
                                    <select id="version_id" name="version_id" class="select2 form-select" required>
                                        <option>Seçiniz</option>
                                        @foreach($versions as $value)
                                            <option @if(isset($technical_services) && $technical_services->version_id == $value->id) selected @endif  value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Durum</label>
                                    <select class="form-control" id="status" name="status">
                                        @foreach(\App\Models\TechnicalService::STATUS as $key=>$value)
                                            <option @if($technical_services->status == $key) selected @endif value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Toplam Tutar</label>
                                    <input type="text" class="form-control" id="total_price"
                                           @if(isset($technical_services)) value="{{$technical_services->sumPrice()}}"
                                           @endif  name="total_price" aria-describedby="total_price" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Müşteri Fiyatı</label>
                                    <input type="text" class="form-control" id="customer_price"
                                           @if(isset($technical_services)) value="{{$technical_services->customer_price}}"
                                           @endif  name="customer_price" aria-describedby="customer_price">
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Cihaz Şifresi</label>
                                    <input type="text" class="form-control" id="device_password"  name="device_password"
                                           @if(isset($technical_services)) value="{{$technical_services->device_password}}"
                                           @endif aria-describedby="device_password">
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Teslim Alan Personel</label>
                                    <select id="brand_id" name="delivery_staff" class="select2 form-select">
                                        @foreach($users as $user)
                                            <option
                                                @if(isset($technical_services) && $technical_services->user_id == $user->id) selected
                                                @endif  value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card card-bg-secondary">
                        <div class="card-header">
                            <button type="button" onclick="save()" class="btn btn-danger btn-buy-now">Kaydet</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
        <hr class="my-1">

        <div class="row">
            <form method="post" action="{{route('technical_service.detailstore')}}">
                @csrf
                <input type="hidden" name="id" value="{{$technical_services->id}}">
                <input type="hidden" name="stock_card_movement_id" id="stock_card_movement_id">
            <div class="mb-3" >
                <div class="pt-0 pt-md-4">
                    <div class="d-flex border rounded position-relative pe-0">
                        <div class="row w-100 m-0 p-3">
                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                <p class="mb-2 ">Stok</p>
                                <select name="stock_card_id" id="stock_card_id" onchange="stockCardId(this.value)" class="form-select item-details mb-2">
                                    <option>Seçiniz</option>
                                    @foreach($stocks as $stock)
                                        <option value="{{$stock->id}}">{{$stock->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                <p class="mb-2 ">Seri No</p>
                                <input type="text" class="form-control" name="serial" id="serial"
                                       placeholder="11111111"/>
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                <p class="mb-2 ">Destekli Maliyet</p>
                                <input type="text" class="form-control invoice-item-price" name="base_cost_price" id="base_cost_price" readonly/>
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                <p class="mb-2 ">Satış Fiyatı</p>
                                <input type="text" class="form-control invoice-item-price" name="sale_price"  id="sale_price"/>
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                <p class="mb-2 ">Adet</p>
                                <input type="number" class="form-control invoice-item-qty" name="quantity" id="quantity" min="1" max="50">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"  >Ürün Ekle
                    </button>
                </div>
            </div>
            </form>
        </div>
        <hr class="my-5">
        <table class="table table-responsive">
            <tr>
                <td>Ürün Adı</td>
                <td>Seri No</td>
                <td>Fiyat</td>
                <td>İşlemler</td>
            </tr>
            @foreach($technical_service_products as $technical_service_product)
            <tr>
                <td>{{$technical_service_product->stock_card->name}}</td>
                <td>{{$technical_service_product->serial_number}}</td>
                <td>{{$technical_service_product->sale_price}}</td>
                <td><a href="{{route('technical_service.detaildelete',['id' => $technical_service_product->id,'technical_service_id' => $technical_service_product->technical_service_id])}}">Sil</a></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
@include('components.customermodal')
@section('custom-js')

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
                    Swal.fire("Güncellendi");
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");
                    $(placeholder).append(xhr.statusText + xhr.responseText);
                    $(placeholder).removeClass('loading');
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
                       $("#stock_card_movement_id").val("");
                       $("#sale_price").val("");
                       $("#quantity").val("");
                   }else{
                       $("#serial").val(data.serialNumber);
                       $("#base_cost_price").val(data.baseCostPrice);
                       $("#sale_price").val(data.salePrice);
                       $("#stock_card_movement_id").val(data.stockmovementId);
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
@endsection
