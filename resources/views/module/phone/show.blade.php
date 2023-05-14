@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Telefonlar /</span> Telefon listesi</h4>

        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-4" src="../../assets/img/avatars/10.png" height="110"
                                 width="110" alt="User avatar">
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{$phone->brand->name}} {{$phone->version->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                        <div class="d-flex align-items-start me-4 mt-3 gap-3">
                            <div>
                                <h5 class="mb-0">{{$phone->cost_price}} ₺ </h5>
                                <span>Alış Fiyatı</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mt-3 gap-3">
                            <div>
                                <h5 class="mb-0">{{$phone->sale_price}} ₺ </h5>
                                <span>Satış Fiyatı</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Detaylar</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Imei:</span>
                                <span>{{$phone->imei}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Barkod:</span>
                                <span>{{$phone->barcode}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Tipi:</span>
                                <span>{{\App\Models\Phone::TYPE[$phone->type]}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Hafıza:</span>
                                <span>{{$phone->memory}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Renk:</span>
                                <span class="badge bg-label-success">{{$phone->color->name}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Pil:</span>
                                <span>{{$phone->batery}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Garanti:</span>
                                <span>{{$phone->warranty}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Fizisel Durum:</span>
                                <span>(123) 456-7890</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Değişen Parçalar:</span>
                                <span>French</span>
                            </li>

                        </ul>
                        <div class="d-flex justify-content-center pt-3">
                            <a href="javascript:;" class="btn btn-label-danger suspend-user">Yazdır</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
