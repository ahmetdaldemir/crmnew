@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Firmalar /</span> Firma listesi</h4>

        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary float-end">Yeni Firma Ekle</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Firma Adı</th>
                        <th>Yetkili</th>
                        <th>Telefon</th>
                        <th>Kayıt Tarihi</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($companies as $company)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{$company->name}}</strong></td>
                            <td>{{$company->authorized}}</td>
                            <td><span class="badge bg-label-primary me-1">{{$company->phone}}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{$company->created_at}}</span></td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateStatus('company/update',{{$company->id}},{{$company->is_status == 1 ? 0:1}})"
                                           id="flexSwitchCheckChecked" {{$company->is_status == 1 ? 'checked':''}} />
                                </div>
                            </td>
                            <td>
                                <a href="{{route('company.delete',['id' => $company->id])}}"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="{{route('company.edit',['id' => $company->id])}}"
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
