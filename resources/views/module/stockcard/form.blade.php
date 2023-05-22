@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok Kart /</span> @if(isset($stockcards))
                {{$stockcards->name}}
            @endif</h4>
        <form action="{{route('stockcard.store')}}" method="post">
            @csrf
            <input type="hidden" name="id" @if(isset($stockcards)) value="{{$stockcards->id}}" @endif />
            <div class="card">
                <h5 class="card-header">Stok Kart Bilgileri</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-8 col-sm-9 col-12 fv-plugins-icon-container">
                            <label for="defaultFormControlInput" class="form-label">Stok Adı</label>
                            <input type="text" class="form-control" id="name"
                                   @if(isset($stockcards)) value="{{$stockcards->name}}" @endif  name="name" aria-describedby="name">
                            <div id="name" class="form-text">
                                <select name="fakeproduct" class="form-select select2">
                                    <option value="">Seçiniz</option>
                                    @foreach($fakeproducts as $fakeproduct)
                                        <option value="{{$fakeproduct->name}}">{{$fakeproduct->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-5 col-12 fv-plugins-icon-container">
                            <label for="defaultFormControlInput" class="form-label">Barkod</label>
                            <input type="text" class="form-control" id="barcode"
                                   @if(isset($stockcards)) value="{{$stockcards->barcode}}" @endif  name="barcode"
                                   aria-describedby="barcode">
                            <div id="barcode" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-5 col-12 fv-plugins-icon-container">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku"
                                   @if(isset($stockcards)) value="{{$stockcards->sku}}" @endif  name="sku"
                                   aria-describedby="sku">

                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-6 col-12 fv-plugins-icon-container">
                            <label for="defaultFormControlInput" class="form-label">Stok Takibi</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="tracking"
                                       id="flexSwitchCheckChecked"/>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4  mb-4">
                <h5 class="card-header">Stok Ayarları</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Stok Takip Miktarı</label>
                                <input type="text" class="form-control" id="tracking_quantity"
                                       @if(isset($stockcards)) value="{{$stockcards->tracking_quantity}}"
                                       @endif  name="tracking_quantity"
                                       aria-describedby="tracking_quantity">

                            </div>

                            <div>
                                <label for="defaultFormControlInput" class="form-label">Kategori {{$request->category}}</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        @if(isset($request) && $request->category == $category->parent_id)
                                            <option
                                                @if(isset($stockcards) && $stockcards->category->id == $category->id) selected
                                                @endif  value="{{$category->id}}">{{$category->name}}</option>

                                        @endif
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="brand_id" class="form-label">Marka</label>
                                <select name="brand_id" id="brand_id" onchange="getVersion(this.value)"
                                        class="form-control" required>
                                    <option value="">Seçiniz</option>
                                    @foreach($brands as $brand)
                                        <option
                                            @if(isset($stockcards) and ($brand->id == $stockcards->brand_id))  selected
                                            @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Model</label>
                                <select name="version_id[]" @if(isset($stockcards)) @if(!is_null($stockcards->version_id)) data-version="{{implode(",",$stockcards->version_id)}}" @endif  @endif id="version_id" class="form-control select2" required  multiple></select>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Birim</label>
                                <select name="unit_id" class="form-control">
                                    @foreach($units as $key => $value)
                                        <option @if(isset($stockcards))
                                                    {{ $stockcards->hasSeller($key) ? 'selected' : '' }}
                                                @endif  value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <hr class="my-5">

                    </div>
                    <hr class="my-5">
                    <div>
                        <button type="submit" class="btn btn-danger btn-buy-now">Kaydet</button>
                    </div>
                </div>
            </div>
        </form>
        <hr class="my-5">
    </div>
@endsection

@section('custom-js')
    <script>
        "use strict";
        !function () {
            var e = document.querySelectorAll(".invoice-item-price"),
                t = document.querySelectorAll(".invoice-item-qty"), n = document.querySelectorAll(".date-picker");
            e && e.forEach(function (e) {
                new Cleave(e, {delimiter: "", numeral: !0})
            }), t && t.forEach(function (e) {
                new Cleave(e, {delimiter: "", numeral: !0})
            }), n && n.forEach(function (e) {
                e.flatpickr({monthSelectorType: "static"})
            })
        }(), $(function () {
            var n, o, a, i, l, r, e = $(".btn-apply-changes"), t = $(".source-item"), c = {
                "App Design": "Designed UI kit & app pages.",
                "App Customization": "Customization & Bug Fixes.",
                "ABC Template": "Bootstrap 4 admin template.",
                "App Development": "Native App Development."
            };

            function p(e, t) {
                e.closest(".repeater-wrapper").find(t).text(e.val())
            }

            $(document).on("click", ".tax-select", function (e) {
                e.stopPropagation()
            }), e.length && $(document).on("click", ".btn-apply-changes", function (e) {
                var t = $(this);
                l = t.closest(".dropdown-menu").find("#taxInput1"), r = t.closest(".dropdown-menu").find("#taxInput2"), i = t.closest(".dropdown-menu").find("#discountInput"), o = t.closest(".repeater-wrapper").find(".tax-1"), a = t.closest(".repeater-wrapper").find(".tax-2"), n = $(".discount"), null !== l.val() && p(l, o), null !== r.val() && p(r, a), i.val().length && t.closest(".repeater-wrapper").find(n).text(i.val() + "%")
            }), t.length && (t.on("submit", function (e) {
                e.preventDefault()
            }), t.repeater({
                show: function () {
                    $(this).slideDown(), [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (e) {
                        return new bootstrap.Tooltip(e)
                    })
                }, hide: function (e) {
                    $(this).slideUp()
                }
            })), $(document).on("change", ".item-details", function () {
                var e = $(this), t = c[e.val()];
                e.next("textarea").length ? e.next("textarea").val(t) : e.after('<textarea class="form-control" rows="2">' + t + "</textarea>")
            })
        });
    </script>

@endsection
