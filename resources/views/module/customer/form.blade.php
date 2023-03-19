@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Müşteriler /</span> @if(isset($customers)) {{$customers->name}} @endif</h4>
        <div class="card  mb-4">
            <h5 class="card-header">Müşteri Bilgileri</h5>
            <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" @if(isset($customers)) value="{{$customers->id}}" @endif />
            <div class="card-body">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                            @if(isset($customers)) src="{{$customers->image}}" @else src="{{asset('assets/img/identity.jpg')}}" @endif
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Kimlik / Passport Ön Yüzü</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input
                                    type="file"
                                    id="upload"
                                    class="account-file-input"
                                    hidden
                                    accept="image/png, image/jpeg"
                                    name="image"
                                />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="firstname" class="form-label">İsim</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="firstname"
                                    name="firstname"
                                    @if(isset($customers)) value="{{$customers->firstname}}" @endif
                                    autofocus required
                                />
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="lastname" class="form-label">Soyisim</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="lastname"
                                    name="lastname"
                                    @if(isset($customers)) value="{{$customers->lastname}}" @endif
                                    autofocus required
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">TC Kimlik / Passport No</label>
                                <input class="form-control" type="text" name="tc" id="tc" @if(isset($customers)) value="{{$customers->tc}}" @endif maxlength="13" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    name="email"
                                    @if(isset($customers)) value="{{$customers->email}}" @endif
                                    placeholder="john.doe@example.com"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Iban</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="organization"
                                    name="iban"
                                    @if(isset($customers)) value="{{$customers->iban}}" @endif
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Telefon 1</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">TR (+90)</span>
                                    <input
                                        type="text"
                                        id="phoneNumber"
                                        name="phone1"
                                        class="form-control"
                                        @if(isset($customers)) value="{{$customers->phone1}}" @endif
                                        required
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Telefon 2</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">TR (+90)</span>
                                    <input
                                        type="text"
                                        id="phoneNumber"
                                        name="phone2"
                                        class="form-control"
                                        @if(isset($customers)) value="{{$customers->phone2}}" @endif
                                    />
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">Adres</label>
                                <textarea class="form-control"  id="address"  name="address">@if(isset($customers))  {{$customers->address}}  @endif</textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Not</label>
                                <textarea class="form-control"  id="note" name="note">@if(isset($customers)) {{$customers->note}}  @endif</textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">İl</label>
                                <input class="form-control" type="text" id="city" name="city" @if(isset($customers)) value="{{$customers->city}}" @endif />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">İlçe</label>
                                <input class="form-control" type="text" id="district" name="district" @if(isset($customers)) value="{{$customers->district}}" @endif />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zipCode" class="form-label">Şube</label>
                                <select id="seller" name="seller_id" class="select2 form-select">
                                    @foreach($sellers as $seller)
                                        <option  @if(isset($customers)) {{ $customers->hasSeller($seller->id) ? 'selected' : '' }} @endif  value="{{$seller->id}}">{{$seller->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zipCode" class="form-label">Firma Türü</label>
                                <select id="seller" name="company_type" class="select2 form-select">
                                  <option value="sahis">Şahıs</option>
                                  <option value="firma">Firma</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zipCode" class="form-label">Web Sitesi</label>
                                <input
                                    type="text"
                                    id="web_sites"
                                    name="web_sites"
                                    class="form-control"

                                />
                            </div>
                        </div>
                </div>
                <!-- /Account -->

                <hr class="my-5">
                <div>
                    <button type="submit" class="btn btn-danger btn-buy-now">Kaydet</button>
                </div>
            </div>
            </form>
        </div>
        <hr class="my-5">
    </div>
@endsection

@section('custom-js')
    <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection
