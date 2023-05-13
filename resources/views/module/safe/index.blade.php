@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kasalar /</span> Kasa listesi</h4>

        <div class="card">
            <!-- div class="card-header">
                <a href="{{route('safe.create')}}" class="btn btn-primary float-end">Yeni Kasa Ekle</a>
            </div-->
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Kasa Adı</th>
                        <th>Sipariş No</th>
                        <th>Tip</th>
                        <th>Nakit Giriş</th>
                        <th>Nakit Çıkış</th>
                        <th>KK Giriş</th>
                        <th>Bayi</th>
                        <th>Kayıt Tarihi</th>
                        <th>Açıklama</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($safes as $safe)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$safe->name}}</strong></td>
                            <td><span class="badge bg-label-primary me-1">{{$safe->invoice_id}}</span></td>
                            <td>{{$safe->type == 'in'?'Giriş':'Çıkış'}}</td>
                            <td>{{$safe->incash}} TL</td>
                            <td>{{$safe->outcash}} TL</td>
                            <td>{{$safe->credit_card}} TL</td>
                            <td>{{$safe->user->seller->name}}</td>
                            <td>{{\Carbon\Carbon::parse($safe->created_at)->format('d-m-Y')}}</td>
                            <td>{{$safe->description}}</td>
                            <td>
                                <a href="{{route('safe.delete',['id' => $safe->id])}}"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="{{route('safe.edit',['id' => $safe->id])}}"
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
