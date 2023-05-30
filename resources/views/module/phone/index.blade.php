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
            <div class="card-body">
                <form action="{{route('phone.list')}}" id="stockSearch" method="get">
                    @csrf
                    <div class="row g-3">
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
                        <div class="col-md-3">
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
                                <label class="form-label" for="multicol-password">Renk</label>
                                <div class="input-group input-group-merge">
                                    <select type="text" name="color" class="form-select" style="width: 100%">
                                        <option value="">Tümü</option>
                                        @foreach($colors as $color)
                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-password-toggle">
                                <label class="form-label" for="multicol-password">Şube</label>
                                <div class="input-group input-group-merge">
                                    <select type="text" name="seller" class="form-select" style="width: 100%">
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
                                <label class="form-label" for="multicol-confirm-password">Seri Numarası</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" name="barcode" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <button   type="submit" class="btn btn-sm btn-outline-primary">Ara</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Barkod</th>
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
                            <td>{{$phone->barcode}}</td>
                            <td>{{$phone->brand->name}}</td>
                            <td>{{$phone->version->name}}</td>
                            <td>{{\App\Models\Phone::TYPE[$phone->type]}}</td>
                            <td>{{$phone->memory}}</td>
                            <td>{{$phone->color->name}}</td>
                            <td>{{$phone->batery}}</td>
                            <td>{{$phone->warranty}}</td>
                            <td>{{$phone->seller->name}}</td>
                            <td>{{$phone->cost_price}} ₺</td>
                            <td>{{$phone->sale_price}} ₺</td>
                            <td>

                                @if($phone->status == 0 && $phone->is_confirm == 1)
                                    <button class="btn btn-sm btn-success"><i class="bx bx-transfer"></i></button>
                                    <a href="{{route('phone.sale',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-secondary"><i class="bx bx-shopping-bag"></i></a>



                                    <a href="{{route('phone.edit',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-dribbble"><i class="bx bx-edit"></i></a>

                                @endif
                                @if($phone->is_confirm == 0)
                                    <a onclick="return confirm('Onaylamak istediğinizden eminmisiniz?')"
                                       href="{{route('phone.confirm',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-success"><i class="bx bxl-ok-ru"></i></a>
                                        <a onclick="return confirm('Silmek istediğinizden eminmisiniz?')"
                                           href="{{route('phone.delete',['id' => $phone->id])}}"
                                           class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                @endif
                                    <a target="_blank" href="{{route('phone.barcode',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-warning"><i class="bx bx-barcode"></i></a>
                                    <a href="{{route('phone.show',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-dark"><i
                                            class="bx bx-show"></i></a>
                                    <a href="{{route('phone.printconfirm',['id' => $phone->id])}}"
                                       class="btn btn-sm btn-danger"><i class="bx bx-printer"></i></a>
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
