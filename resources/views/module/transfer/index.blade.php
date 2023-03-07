@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sevkler /</span> Sevk listesi</h4>

        <div class="card">
            <div class="card-header">
                <a href="{{route('transfer.create')}}" class="btn btn-primary float-end">Yeni Sevk Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Gönderici Bayi</th>
                        <th>Tipi</th>
                        <th>Barkod</th>
                        <th>Miktar</th>
                        <th>Alıcı Bayi</th>
                        <th>Gönderen</th>
                        <th>Teslim Alan</th>
                        <th>Durum</th>
                        <th>Teslim Tarihi</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($transfers as $transfer)
                        <tr>
                            <td><input type="checkbox" class="vs-checkbox--input" value=""></td>
                            <td>Merkez Depo</td>
                            <td>Aksesuar: APPLE IPHONE 14 PRO ANTİSTATİK HAYALET KORUYUCU CAM (4)</td>
                            <td>801689</td>
                            <td>Carrefour</td>
                            <td>Erkan</td>
                            <td>Mert G. (C)</td>
                            <td>Tamamlandı</td>
                            <td>
                                <a href="{{route('transfer.delete',['id' => $transfer->id])}}"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="{{route('transfer.edit',['id' => $transfer->id])}}"
                                   class="btn btn-icon btn-primary">
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
