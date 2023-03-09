<div class="modal fade" id="editUser" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Yeni Müşteri Ekle</h3>
                </div>
                <form action="javascript():;" method="post" id="customerForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id"/>
                    <div class="card-body">
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                                <img
                                    src="{{asset('assets/img/identity.jpg')}}"
                                    alt="user-avatar"
                                    class="d-block rounded"
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
                        <hr class="my-0"/>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="fullname" class="form-label">İsim Soyisim</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="fullname"
                                        name="fullname"

                                        autofocus required
                                    />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">TC Kimlik / Passport No</label>
                                    <input class="form-control" type="text" name="tc" id="tc" maxlength="13" required/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="email"
                                        name="email"

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

                                        />
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">Adres</label>
                                    <textarea class="form-control" id="address" name="address"></textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">Not</label>
                                    <textarea class="form-control" id="note" name="note"></textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">İl</label>
                                    <select id="city" name="city" class="select2 form-select" onchange="getTown(this.value)">
                                        @foreach($citys as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">İlçe</label>
                                    <select id="district" name="district" class="select2 form-select"></select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="zipCode" class="form-label">Şube</label>
                                    <select id="seller" name="seller_id" class="select2 form-select">
                                        @foreach($sellers as $seller)
                                            <option value="{{$seller->id}}">{{$seller->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /Account -->

                        <hr class="my-5">
                        <div>
                            <button onclick="customerSave()" type="button" class="btn btn-danger btn-buy-now">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('custom-css')
    <style>
        html:not([dir=rtl]) .modal-simple .btn-close {
            right: -2rem;
        }

        html:not([dir=rtl]) .modal .btn-close {
            transform: translate(23px, -25px);
        }

        .modal-simple .btn-close {
            position: absolute;
            top: -2rem;
        }

        .modal .btn-close {
            background-color: #fff;
            border-radius: 0.5rem;
            opacity: 1;
            padding: 0.635rem;
            box-shadow: 0 0.125rem 0.25rem rgb(161 172 184 / 40%);
            transition: all .23s ease .1s;
        }
    </style>
@endsection
