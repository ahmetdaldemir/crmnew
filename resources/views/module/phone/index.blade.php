@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Telefonlar /</span> Telefon listesi</h4>

        <div class="card">
            <div class="card-header">

                <div class="btn-group demo-inline-spacing float-end">
                    <a href="{{route('phone.create')}}" class="btn btn-primary float-end">Yeni Telefon Ekle</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Tipi</th>
                        <th>Hafıza</th>
                        <th>Renk</th>
                        <th>Pil</th>
                        <th>Garanti</th>
                        <th>Bayi</th>
                        <th>Alış F</th>
                        <th>Satış F</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($phones as $phone)
                        <tr>
                            <td>{{$phone->brand->name}}</td>
                            <td>{{$phone->version->name}}</td>
                            <td>{{\App\Models\Phone::TYPE[$phone->type]}}</td>
                            <td>{{$phone->memory}}</td>
                            <td>{{$phone->color->id}}</td>
                            <td>{{$phone->batery}}</td>
                            <td>{{$phone->warranty}}</td>
                            <td>{{$phone->seller->name}}</td>
                            <td>{{$phone->cost_price}} ₺</td>
                            <td>{{$phone->sale_price}} ₺</td>
                            <td>
                                @if($phone->status == 0)
                                <button class="btn btn-sm btn-success"><i class="bx bx-transfer"></i></button>
                                    <a href="{{route('phone.sale',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-secondary"><i class="bx bx-shopping-bag"></i></a>
                                @endif
                                <a href="{{route('phone.barcode',['id' => $phone->id])}}"
                                   class="btn btn-sm btn-warning"><i class="bx bx-barcode"></i></a>
                                <a href="{{route('phone.show',['id' => $phone->id])}}" class="btn btn-sm btn-dark"><i
                                        class="bx bx-show"></i></a>
                                <a href="{{route('phone.edit',['id' => $phone->id])}}"
                                   class="btn btn-sm btn-dribbble"><i class="bx bx-edit"></i></a>
                                @if($phone->status == 0)
                                <a onclick="return confirm('Silmek istediğinizden eminmisiniz?')"
                                   href="{{route('phone.delete',['id' => $phone->id])}}"
                                   class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                @endif
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
