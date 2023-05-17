@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Teknik Servis /</span> Teknik Servis listesi</h4>

        <div class="card">
            <div class="card-header">
                <form action="javascript():;" id="stockSearch" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label" for="multicol-username">Müşteri</label>
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
                                <label class="form-label" for="multicol-password">Bayi</label>
                                <div class="input-group input-group-merge">
                                    <select type="text" name="category" class="form-select" style="width: 100%">
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
                                    <select type="text" name="category" class="form-select" style="width: 100%">
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
                                    <select type="text" name="category" class="form-select" style="width: 100%">
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
                        <button ng-click="getStockSearch()" type="button" class="btn btn-sm btn-outline-primary">Ara</button>
                    </div>
                </form>
            </div>
            <div class="card-header">
                <a href="{{route('technical_service.covering')}}" class="btn btn-danger ">Yeni Kaplama Ekle</a>
                <a href="{{route('technical_service.create')}}" class="btn btn-primary float-end">Yeni Teknik Servis Ekle</a>
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
                            <td><a href="{{route('technical_service.detail',['id' => $technical_service->id])}}">#{{$technical_service->id}}</a></td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$technical_service->seller->name}}</td>
                            <td>{{$technical_service->customer->fullname ?? "Silinmiş"}}</td>
                            <td>{{$technical_service->brand->name}} /
                                    <?php
                                    $datas = json_decode($technical_service->version(), TRUE);
                                    foreach ($datas as $mykey => $myValue) {
                                        echo "$myValue</br>";
                                    }
                                    ?>
                            </span></td>
                            <td><span class="badge bg-label-primary me-1">{{$technical_service->process_type}}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{$technical_service->status}}</span></td>
                            <td>{{\Carbon\Carbon::parse($technical_service->created_at)->format('d-m-Y')}}</td>
                            <td>{{$technical_service->delivery->name}}</td>
                            <td>
                                <a href="#"
                                   class="btn btn-icon btn-danger btn-sm"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Form Yazdır" onclick="technicalServiceOpen()">
                                    <span class="bx bxs-printer"></span>
                                </a>
                                <a  class="btn btn-icon btn-success btn-sm"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Ödeme İşlemi" onclick="checkoutModalOpen()">
                                    <span class="bx bxs-dollar-circle"></span>
                                </a>
                                <a
                                   class="btn btn-icon btn-warning btn-sm"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Sms Gönder" onclick="smsModalOpen()">
                                    <span class="bx bxs-message-add"></span>
                                </a>
                                <a href="{{route('technical_service.show',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-secondary btn-sm"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Görüntüle">
                                    <span class="bx bxs-happy-heart-eyes"></span>
                                </a>
                                <a  onclick="return confirm('Silmek istediğinizden eminmisiniz?');" href="{{route('technical_service.delete',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-primary btn-sm"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    data-bs-original-title="Sil">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="{{route('technical_service.detail',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-primary btn-sm"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
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
        <hr class="my-5">
    </div>
@endsection
@include('components.technical_service_modal')
@include('components.smsmodal')
@include('components.technical_service_checkout_modal')

<div class="modal fade modal-lg" id="technicalServiceModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="con-exemple-prompt">
                    <div id="barcodeFormSet1">
                        <table style="margin: 0px auto;">
                            <tbody>
                            <tr>
                                <td style="height: 52px;">&nbsp;</td>
                                <td style="height: 52px; width: 720px;">
                                    <table style="width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td style="text-align: left;"><img alt=""
                                                                               src="Helper/Barcode?barcodeText=17017&amp;width=80&amp;height=22">
                                                <div>Form No: 11741</div>
                                            </td>
                                            <td style="font-size: 25px; text-align: center;">Phone Hospital - Marmara
                                                Park
                                            </td>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px; text-align: right;">
                                                <b>phonehospital.com.tr</b><br> <b>444 23 70</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="height: 52px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height: 287px;">&nbsp;</td>
                                <td style="height: 287px; width: 720px;">
                                    <table style="height: 62px; width: 100%; border: 1px solid black; font-size: 14px;">
                                        <tbody>
                                        <tr>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px;">Müşteri
                                                Adı
                                            </td>
                                            <td style="text-align: center; width: 10px;">:</td>
                                            <td class="detay">CEYLAN BOŞNAK</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px;">Telefon</td>
                                            <td style="text-align: center; width: 10px;">:</td>
                                            <td class="detay">05426483440</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px;">Email</td>
                                            <td style="text-align: center; width: 10px;">:</td>
                                            <td class="detay"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table
                                        style="height: 208px; width: 100%; border: 1px solid black; font-size: 14px; margin-top: 5px;">
                                        <tbody>
                                        <tr>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px; height: 21px;">
                                                Marka/Model
                                            </td>
                                            <td style="text-align: center; width: 10px; height: 21px;">:</td>
                                            <td class="detay" style="height: 21px;">APPLE - IPHONE 12</td>
                                            <td style="font-weight: bold; padding-left: 5px; height: 21px; width: 60px;">
                                                Seri No
                                            </td>
                                            <td style="text-align: center; width: 10px; height: 21px;">:</td>
                                            <td style="height: 21px; padding-right: 5px; text-align: right; width: 120px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px; height: 21px;">
                                                Son Durum
                                            </td>
                                            <td style="text-align: center; width: 10px; height: 21px;">:</td>
                                            <td class="detay" style="height: 21px;">İşleme Alındı</td>
                                            <td style="font-weight: bold; padding-left: 5px; height: 21px; width: 60px;">
                                                Fiyat
                                            </td>
                                            <td style="text-align: center; width: 10px; height: 21px;">:</td>
                                            <td style="height: 21px; padding-right: 5px; text-align: right; width: 120px;">
                                                1700.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold; padding-left: 5px; width: 120px;">Geliş
                                                Tarihi
                                            </td>
                                            <td style="text-align: center; width: 10px;">:</td>
                                            <td class="detay"></td>
                                            <td style="font-weight: bold; padding-left: 5px; height: 21px; width: 60px;">
                                                Ücret
                                            </td>
                                            <td style="text-align: center; width: 10px; height: 21px;">:</td>
                                            <td style="height: 21px; padding-right: 5px; text-align: right; width: 120px;">
                                                Alınmadı
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top"
                                                style="font-weight: bold; padding-left: 5px; width: 120px;">Arıza
                                                Bilgisi
                                            </td>
                                            <td valign="top" style="text-align: center; width: 10px;">:</td>
                                            <td colspan="4" valign="top" class="detay">İÇ KULAKLIK DEĞİŞİMİ</td>
                                        </tr>
                                        <tr>
                                            <td valign="top"
                                                style="font-weight: bold; padding-left: 5px; width: 120px;">Cihaz
                                                Şifresi
                                            </td>
                                            <td valign="top" style="text-align: center; width: 10px;">:</td>
                                            <td colspan="4" valign="top" class="detay"> 010567</td>
                                        </tr>
                                        <tr>
                                            <td valign="top"
                                                style="font-weight: bold; padding-left: 5px; width: 120px;">Aksesuar
                                            </td>
                                            <td valign="top" style="text-align: center; width: 10px;">:</td>
                                            <td colspan="4" valign="top" class="detay"></td>
                                        </tr>
                                        <tr>
                                            <td valign="top"
                                                style="font-weight: bold; padding-left: 5px; width: 120px;">Fiziksel
                                                Durum
                                            </td>
                                            <td valign="top" style="text-align: center; width: 10px;">:</td>
                                            <td colspan="4" valign="top" class="detay"></td>
                                        </tr>
                                        <tr>
                                            <td valign="top"
                                                style="font-weight: bold; padding-left: 5px; width: 120px;">İşlemler
                                            </td>
                                            <td valign="top" style="text-align: center; width: 10px;">:</td>
                                            <td colspan="4" valign="top" class="detay"><p>2023-04-08 10:41 - İşleme
                                                    Alındı</p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="height: 25px;"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="height: 287px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height: 30px;">&nbsp;</td>
                                <td style="height: 30px; width: 720px;">
                                    <table style="width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td style="text-align: center;"><b>Teslim Alan / İmza</b></td>
                                            <td style="text-align: center;"><b>Teslim Eden / İmza</b></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">Phone Hospital - Tarek (M)</td>
                                            <td style="text-align: center;">CEYLAN BOŞNAK</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="height: 60px;"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="height: 30px;">{{setting('site.adwords')}}</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button onclick="print(1)" style="width: 100%" class="btn btn-danger">Yazdır</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
    </script>
    <script>
        function checkoutModalOpen() {
            $("#checkoutModal").modal('show');
        }
    </script>
@endsection
<!-- route('technical_service.print',['id' => $technical_service->id])  -->

