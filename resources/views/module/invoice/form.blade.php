@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-add">
            <!-- Invoice Add-->

            <div class="col-lg-10 col-12 mb-lg-0 mb-4">
                <form class="form-repeater source-item py-sm-3">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <div class="row mb-4">
                                    <label for="selectpickerLiveSearch" class="form-label">Müşteri Seçiniz</label>
                                    <div class="col-md-9">
                                        <select id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default" name="customer_id" data-live-search="true">
                                            <option value="1" data-tokens="ketchup mustard">Genel Müşteri</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}" data-value="{{$customer->id}}">{{$customer->fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-secondary btn-primary" tabindex="0"  data-bs-toggle="modal" data-bs-target="#editUser" type="button"><span><i class="bx bx-plus me-md-1"></i></span></button>
                                    </div>
                                </div>
                                <div class="customerinformation">

                                </div>
                 
                            </div>
                            <div class="col-md-6">
                                <dl class="row mb-2">
                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                        <span class="h4 text-capitalize mb-0 text-nowrap">Invoice #</span>
                                    </dt>
                                    <dd class="col-sm-6 d-flex justify-content-md-end">
                                        <div class="w-px-150">
                                            <input type="text" class="form-control" disabled="" placeholder="3905"
                                                   value="3905" id="invoiceId">
                                        </div>
                                    </dd>
                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                        <span class="fw-normal">Fatura Tarihi:</span>
                                    </dt>
                                    <dd class="col-sm-6 d-flex justify-content-md-end">
                                        <div class="w-px-150">
                                            <input type="text" class="form-control datepicker flatpickr-input" value="{{date('d-m-Y')}}" >
                                        </div>
                                    </dd>

                                </dl>
                            </div>
                        </div>


                        <hr class="mx-n4">


                            <div class="mb-3" data-repeater-list="group-a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div class="row w-100 m-0 p-3">
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Seri No</p>
                                                <input type="text" class="form-control" name="serial"
                                                       placeholder="11111111"/>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Maliyet</p>
                                                <input type="text" class="form-control invoice-item-price" name="serial"
                                                       placeholder="00.00"/>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Destekli Maliyet</p>
                                                <input type="text" class="form-control invoice-item-price" name="serial"
                                                       placeholder="00.00"/>
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Satış Fiyatı</p>
                                                <input type="text" class="form-control invoice-item-price" name="serial"
                                                       placeholder="00.00"/>
                                            </div>
                                            <div class="col-md-1 col-12 mb-md-0 mb-3">
                                                <p class="mb-2 repeater-title">Qty</p>
                                                <input type="number" class="form-control invoice-item-qty"
                                                       placeholder="1" min="1" max="50">
                                            </div>
                                            <div class="col-md-3 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Renk</p>
                                                <select name="color" class="form-select item-details mb-2">
                                                    @foreach($colors as $color)
                                                        <option value="{{$color->id}}">{{$color->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Açıklama</p>
                                                <textarea class="form-control" rows="2"
                                                          placeholder="Item Information"></textarea>
                                            </div>
                                            <div class="col-md-3 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Neden</p>
                                                <select name="d" class="form-select item-details mb-2">
                                                    @foreach($reasons as $reason)
                                                        <option @if(isset($invoices))
                                                                    {{ $invoices->hasReason($reason->id) ? 'selected' : '' }}
                                                                @endif  value="{{$reason->id}}">{{$reason->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                            <i class="bx bx-x fs-4 text-muted cursor-pointer"
                                               data-repeater-delete=""></i>
                                            <div class="dropdown">
                                                <i class="bx bx-cog bx-xs text-muted cursor-pointer more-options-dropdown"
                                                   role="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                   data-bs-auto-close="outside" aria-expanded="false">
                                                </i>
                                                <div class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                                                     aria-labelledby="dropdownMenuButton">

                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label for="discountInput"
                                                                   class="form-label">İndirim (%)</label>
                                                            <input type="number" class="form-control" id="discountInput"
                                                                   min="0" max="100">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="taxInput1" class="form-label">Şube</label>
                                                            <select name="seller" id="taxInput1"
                                                                    class="form-select tax-select">
                                                                @foreach($sellers as $seller)
                                                                    <option
                                                                        value="{{$seller->id}}">{{$seller->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="taxInput2" class="form-label">Depo</label>
                                                            <select name="group-a[0][tax-2-input]" id="taxInput2"
                                                                    class="form-select tax-select">
                                                                @foreach($warehouses as $warehouse)
                                                                    <option
                                                                        value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="taxInput1" class="form-label">Tax 1</label>
                                                            <select name="group-a[0][tax-1-input]" id="taxInput1"
                                                                    class="form-select tax-select">
                                                                <option value="0" selected="">0%</option>
                                                                <option value="1">1%</option>
                                                                <option value="10">10%</option>
                                                                <option value="18">18%</option>
                                                                <option value="40">40%</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider my-3"></div>
                                                    <button type="button"
                                                            class="btn btn-label-primary btn-apply-changes">Uygulama
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-repeater-create="">Add Item
                                    </button>
                                </div>
                            </div>

                        <hr class="my-4 mx-n4">

                        <div class="row py-sm-3">
                            <div class="col-md-6 mb-md-0 mb-3">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="salesperson" class="form-label me-5 fw-semibold">Personel:</label>
                                    <select id="selectpickerLiveSearch" class="selectpicker w-100" data-style="btn-default" name="staff_id" data-live-search="true">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" data-value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="invoice-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Subtotal:</span>
                                        <span class="fw-semibold">$00.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Discount:</span>
                                        <span class="fw-semibold">$00.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Tax:</span>
                                        <span class="fw-semibold">$00.00</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="w-px-100">Total:</span>
                                        <span class="fw-semibold">$00.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label fw-semibold">Note:</label>
                                    <textarea class="form-control" rows="2" id="note"
                                              placeholder="Invoice note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <!-- /Invoice Add-->
            <!-- Invoice Actions -->
            <div class="col-lg-2 col-12 invoice-actions">
                <div class="card mb-4">
                    <div class="card-body">
                        <button class="btn btn-primary d-grid w-100 mb-3" data-bs-toggle="offcanvas"
                                data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-paper-plane bx-xs me-1"></i>Send Invoice</span>
                        </button>
                        <a href="./app-invoice-preview.html"
                           class="btn btn-label-secondary d-grid w-100 mb-3">Preview</a>
                        <button type="button" class="btn btn-label-secondary d-grid w-100">Save</button>
                    </div>
                </div>
                <div>
                    <p class="mb-2">Accept payments via</p>
                    <select class="form-select mb-4">
                        <option value="Bank Account">Bank Account</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Card">Credit/Debit Card</option>
                        <option value="UPI Transfer">UPI Transfer</option>
                    </select>
                    <div class="d-flex justify-content-between mb-2">
                        <label for="payment-terms" class="mb-0">Payment Terms</label>
                        <label class="switch switch-primary me-0">
                            <input type="checkbox" class="switch-input" id="payment-terms" checked="">
                            <span class="switch-toggle-slider">
            <span class="switch-on">
              <i class="bx bx-check"></i>
            </span>
            <span class="switch-off">
              <i class="bx bx-x"></i>
            </span>
          </span>
                            <span class="switch-label"></span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <label for="client-notes" class="mb-0">Client Notes</label>
                        <label class="switch switch-primary me-0">
                            <input type="checkbox" class="switch-input" id="client-notes">
                            <span class="switch-toggle-slider">
            <span class="switch-on">
              <i class="bx bx-check"></i>
            </span>
            <span class="switch-off">
              <i class="bx bx-x"></i>
            </span>
          </span>
                            <span class="switch-label"></span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label for="payment-stub" class="mb-0">Payment Stub</label>
                        <label class="switch switch-primary me-0">
                            <input type="checkbox" class="switch-input" id="payment-stub">
                            <span class="switch-toggle-slider">
            <span class="switch-on">
              <i class="bx bx-check"></i>
            </span>
            <span class="switch-off">
              <i class="bx bx-x"></i>
            </span>
          </span>
                            <span class="switch-label"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>
@endsection
@include('components.customermodal')





@section('custom-js')
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
    <script src="{{asset('assets/js/forms-extras.js')}}"></script>
@endsection

