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
                        <th>Telefon</th>
                        <th>Kayıt Tarihi</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($technical_services as $technical_service)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{$technical_service->name}}</strong></td>
                            <td><span class="badge bg-label-primary me-1">{{$technical_service->phone}}</span></td>
                            <td><span class="badge bg-label-primary me-1">{{$technical_service->created_at}}</span></td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateStatus('technical_services/update',{{$technical_service->id}},{{$technical_service->is_status == 1 ? 0:1}})"
                                           id="flexSwitchCheckChecked" {{$technical_service->is_status == 1 ? 'checked':''}} />
                                </div>
                            </td>
                            <td>
                                <a href="{{route('technical_services.delete',['id' => $technical_service->id])}}"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                <a href="{{route('technical_services.edit',['id' => $technical_service->id])}}"
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
