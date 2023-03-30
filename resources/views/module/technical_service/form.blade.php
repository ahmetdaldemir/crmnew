@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Şubeler /</span> @if(isset($technical_services)) {{$technical_services->name}}
            @endif</h4>
        <form action="{{route('seller.store')}}" method="post">
            @csrf
            <input type="hidden" name="id" @if(isset($technical_services)) value="{{$technical_services->id}}" @endif />
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <h5 class="card-header">Cihaz Bilgileri</h5>
                        <div class="card-body">

                            <div>
                                <label for="defaultFormControlInput" class="form-label">Müşteri</label>
                                <input type="text" class="form-control" id="name"
                                       @if(isset($technical_services)) value="{{$technical_services->name}}" @endif  name="name"
                                       aria-describedby="name">
                                <div id="name" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Fiziksel Durumu</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Aksesuar</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Arıza Açıklaması</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">İşlemler</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                <div class="d-flex border rounded position-relative pe-0">
                                    <div class="row w-100 m-0 p-3">
                                        <div class="col-md-5 col-12 mb-md-0 mb-3 ps-md-0">
                                            <p class="mb-2 repeater-title">Stok</p>
                                            <select name="stock_card_id" class="form-select item-details mb-2">
                                                @foreach($stocks as $stock)
                                                    <option value="{{$stock->id}}">{{$stock->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                            <p class="mb-2 repeater-title">Seri No</p>
                                            <input type="text" class="form-control" name="serial"
                                                   placeholder="11111111"/>
                                        </div>
                                        <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                            <p class="mb-2 repeater-title">Destekli Maliyet</p>
                                            <input type="text" class="form-control invoice-item-price"
                                                   name="base_cost_price"/>
                                        </div>
                                        <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                            <p class="mb-2 repeater-title">Satış Fiyatı</p>
                                            <input type="text" class="form-control invoice-item-price"
                                                   name="sale_price"/>
                                        </div>
                                        <div class="col-md-1 col-12 mb-md-0 mb-3">
                                            <p class="mb-2 repeater-title">Qty</p>
                                            <input type="number" class="form-control invoice-item-qty"
                                                   name="quantity" min="1" max="50">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr class="my-4 mx-n4">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-repeater-create="">Add Item
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
                                <input type="text" class="form-control" id="name"
                                       @if(isset($technical_services)) value="{{$technical_services->name}}" @endif  name="name"
                                       aria-describedby="name">
                                <div id="name" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Marka</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Model</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Durum</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Toplam Tutar</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Müşteri Fiyatı</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">process_type</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">device_password</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Teslim Alan Personel</label>
                                <input type="text" class="form-control" id="phone"
                                       @if(isset($technical_services)) value="{{$technical_services->phone}}" @endif  name="phone"
                                       aria-describedby="phone">
                                <div id="phone" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-danger btn-buy-now">Kaydet</button>
            </div>
        </form>
        <hr class="my-5">
    </div>
@endsection
