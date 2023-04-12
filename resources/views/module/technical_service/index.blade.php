@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Teknik Servis /</span> Teknik Servis listesi</h4>

        <div class="card">
            <div class="card-header">
                <a href="{{route('technical_service.create')}}" class="btn btn-primary float-end">Yeni Teknik Servis Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
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
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$technical_service->seller->name}}</td>
                            <td>{{$technical_service->customer->fullname}}</td>
                            <td>    {{$technical_service->brand}} /
                                    <?php
                                    $datas = json_decode($technical_service->version(), TRUE);
                                    foreach ($datas as $mykey => $myValue) {
                                        echo "$myValue</br>";
                                    }
                                    ?>
                            </span></td>
                            <td><span class="badge bg-label-primary me-1">{{$technical_service->process_type}}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{$technical_service->status}}</span></td>
                            <td>{{$technical_service->created_at}}</td>
                            <td>{{$technical_service->delivery->name}}</td>
                            <td>
                                <a href="#"
                                   class="btn btn-icon btn-danger"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Form Yazdır" onclick="technicalServiceOpen()">
                                    <span class="bx bxs-printer"></span>
                                </a>
                                <a  class="btn btn-icon btn-success"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Ödeme İşlemi" onclick="checkoutModalOpen()">
                                    <span class="bx bxs-dollar-circle"></span>
                                </a>
                                <a
                                   class="btn btn-icon btn-warning"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Sms Gönder" onclick="smsModalOpen()">
                                    <span class="bx bxs-message-add"></span>
                                </a>
                                <a href="{{route('technical_service.show',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-secondary"
                                   data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="Görüntüle">
                                    <span class="bx bxs-happy-heart-eyes"></span>
                                </a>
                                <a  onclick="return confirm('Silmek istediğinizden eminmisiniz?');" href="{{route('technical_service.delete',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-primary"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    data-bs-original-title="Sil">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="{{route('technical_service.edit',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-primary"
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
@section('custom-js')
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

