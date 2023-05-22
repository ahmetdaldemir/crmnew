@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Teknik Servis /</span> Teknik Servis listesi
        </h4>

        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Teknik
                        Servis
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                        Kaplama Ve Baskı
                    </button>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <form action="javascript():;" id="stockSearch" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <label class="form-label" for="multicol-username">Müşteri</label>
                                        <input type="text" class="form-control" placeholder="············"
                                               name="stockName">
                                    </div>
                                    <div class="col-md-2">
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
                                                <select type="text" id="version_id" name="version" class="form-select"
                                                        style="width: 100%">
                                                    <option value="">Tümü</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-password-toggle">
                                            <label class="form-label" for="multicol-password">Bayi</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="category" class="form-select"
                                                        style="width: 100%">
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
                                            <label class="form-label" for="multicol-password">İşlem Durumu</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="category" class="form-select"
                                                        style="width: 100%">
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
                                            <label class="form-label" for="multicol-password">Ödeme Durumu</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="category" class="form-select"
                                                        style="width: 100%">
                                                    <option value="">Tümü</option>
                                                    @foreach($sellers as $seller)
                                                        <option value="{{$seller->id}}">{{$seller->name}}</option>
                                                    @endforeach
                                                </select>
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
                        </div>
                        <div class="card-header">
                            <a href="{{route('technical_service.create')}}" class="btn btn-primary float-end">Yeni
                                Teknik Servis Ekle</a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table" style="font-size:13px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Şube Adı</th>
                                    <th>Müşteri</th>
                                    <th>Marka/Model</th>
                                    <th>İşlem Durumu</th>
                                    <th>Ödeme Durumu</th>
                                    <th>Tarih</th>
                                    <th>Personel</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($technical_services as $technical_service)
                                    <tr>
                                        <td>
                                            <a href="{{route('technical_service.detail',['id' => $technical_service->id])}}">#{{$technical_service->id}}</a>
                                        </td>
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$technical_service->seller->name??"bulunamadı"}}
                                        </td>
                                        <td>{{$technical_service->customer->fullname ?? "Silinmiş"}}</td>
                                        <td>{{$technical_service->brand->name}} / {{$technical_service->version->name}}</td>
                                        <td><span
                                                class="badge bg-label-primary me-1">{{$technical_service->process_type}}</span>
                                        </td>
                                        <td><span
                                                class="badge bg-label-primary me-1">{{$technical_service->status}}</span>
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($technical_service->created_at)->format('d-m-Y')}}</td>
                                        <td>{{$technical_service->delivery->name}}</td>
                                        <td>
                                            <a target="_blank" href="{{route('technical_service.print',['id' => $technical_service->id])}}" class="btn btn-icon btn-danger btn-sm" >
                                                <span class="bx bxs-printer"></span>
                                            </a>
                                            <a class="btn btn-icon btn-success btn-sm" target="_blank" href="{{route('technical_service.payment',['id' => $technical_service->id])}}" >
                                                <span class="bx bxs-dollar-circle"></span>
                                            </a>
                                            <a
                                                class="btn btn-icon btn-warning btn-sm"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true"
                                                data-bs-original-title="Sms Gönder" onclick="smsModalOpen()">
                                                <span class="bx bxs-message-add"></span>
                                            </a>
                                            <a href="{{route('technical_service.show',['id' => $technical_service->id])}}"
                                               class="btn btn-icon btn-secondary btn-sm"
                                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                               data-bs-html="true"
                                               data-bs-original-title="Görüntüle">
                                                <span class="bx bxs-happy-heart-eyes"></span>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğinizden eminmisiniz?');"
                                               href="{{route('technical_service.delete',['id' => $technical_service->id])}}"
                                               class="btn btn-icon btn-primary btn-sm"
                                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                               data-bs-html="true"
                                               data-bs-original-title="Sil">
                                                <span class="bx bxs-trash"></span>
                                            </a>
                                            <a href="{{route('technical_service.detail',['id' => $technical_service->id])}}"
                                               class="btn btn-icon btn-primary btn-sm"
                                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                               data-bs-html="true"
                                               data-bs-original-title="Düzenle">
                                                <span class="bx bx-edit-alt"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <form action="javascript():;" id="stockSearch" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <label class="form-label" for="multicol-username">Müşteri</label>
                                        <input type="text" class="form-control" placeholder="············"
                                               name="stockName">
                                    </div>
                                    <div class="col-md-2">
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
                                                <select type="text" id="version_id" name="version" class="form-select"
                                                        style="width: 100%">
                                                    <option value="">Tümü</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-password-toggle">
                                            <label class="form-label" for="multicol-password">Bayi</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="category" class="form-select"
                                                        style="width: 100%">
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
                                            <label class="form-label" for="multicol-password">İşlem Durumu</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="category" class="form-select"
                                                        style="width: 100%">
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
                                            <label class="form-label" for="multicol-password">Ödeme Durumu</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="category" class="form-select"
                                                        style="width: 100%">
                                                    <option value="">Tümü</option>
                                                    @foreach($sellers as $seller)
                                                        <option value="{{$seller->id}}">{{$seller->name}}</option>
                                                    @endforeach
                                                </select>
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
                        </div>
                        <div class="card-header">
                            <a href="{{route('technical_service.covering')}}" class="btn btn-danger ">Yeni Kaplama
                                Ekle</a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table" style="font-size:13px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Şube Adı</th>
                                    <th>Müşteri</th>
                                    <th>Marka/Model</th>
                                     <th>Ödeme Durumu</th>
                                    <th>Tarih</th>
                                    <th>Personel</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($technical_covering_services as $technical_service)
                                    <tr>
                                        <td>
                                           #{{$technical_service->id}}
                                        </td>
                                        <td  style="font-size: 12px;">
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$technical_service->seller->name??"bulunmadı"}}
                                        </td>
                                        <td style="font-size: 12px;">{{$technical_service->customer->fullname ?? "Silinmiş"}}</td>
                                        <td style="font-size: 12px;">{{$technical_service->brand->name??"bulunamadı"}} / </span></td>
                                        <td style="font-size: 12px;"></td>
                                        <td style="font-size: 12px;">{{\Carbon\Carbon::parse($technical_service->created_at)->format('d-m-Y')}}</td>
                                        <td style="font-size: 12px;">{{$technical_service->delivery->name??"bulunamadı"}}</td>
                                        <td>
                                            <a  target="_blank"  href="{{route('technical_service.coverprint',['id' => $technical_service->id])}}" class="btn btn-icon btn-danger btn-sm">
                                                <span class="bx bxs-printer"></span>
                                            </a>
                                            <a
                                                class="btn btn-icon btn-warning btn-sm"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                data-bs-html="true"
                                                data-bs-original-title="Sms Gönder" onclick="smsCoverModalOpen({{$technical_service->id}})">
                                                <span class="bx bxs-message-add"></span>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğinizden eminmisiniz?');"
                                               href="{{route('technical_service.delete',['id' => $technical_service->id])}}"
                                               class="btn btn-icon btn-primary btn-sm"
                                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                               data-bs-html="true"
                                               data-bs-original-title="Sil">
                                                <span class="bx bxs-trash"></span>
                                            </a>
                                            <a href="{{route('technical_service.coveredit',['id' => $technical_service->id])}}"
                                               class="btn btn-icon btn-primary btn-sm"
                                               data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                               data-bs-html="true"
                                               data-bs-original-title="Düzenle">
                                                <span class="bx bx-edit-alt"></span>
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
        </div>
        <hr class="my-5">
    </div>
@endsection
@include('components.smsmodal')


<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #section-to-print, #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
@section('custom-js')
    <script>
        function print(id) {

            var divName = 'barcodeFormSet'+id+'';
            var printContents = document.getElementById(divName).innerHTML;
            w = window.open();
            w.document.write(printContents);
            w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
            w.document.close();
            w.focus();
        }

        function getForm(id)
        {

        }
    </script>
    <script>
        function technicalServiceOpen() {
            $("#technicalServiceModal").modal('show');
        }
    </script>
    <script>
        function smsModalOpen() {
          $("#smsModal").modal('show');
        }
        function smsCoverModalOpen(id) {
            $("#smsCoverModal").modal('show');
            $("#smsCoverForm").find("input[name=id]").val(id);
        }
        function smsCoverSend() {
          alert("Kod Yazılacak");
        }
        function smsSend() {
            alert("Kod Yazılacak");
        }

    </script>
    <script>
        function checkoutModalOpen() {
            $("#checkoutModal").modal('show');
        }
    </script>
@endsection
<!-- route('technical_service.print',['id' => $technical_service->id])  -->

