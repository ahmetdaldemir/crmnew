@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Teknik Servis /</span> {{$technical_service->customer->fullname}} </h4>
        <div class="card">
            <div class="card-body">
                <form  class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" method="post" action="{{route('technical_service.paymentcomplate')}}" novalidate="novalidate">
                   @csrf
                    <input value="{{$technical_service->id}}" name="id" type="hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="fullname">Ödemeyi Alan</label>
                            <select id="payment_person" name="payment_person" class="select2 form-select">
                                @foreach($users as $user)
                                    <option @if(isset($technical_services) && $technical_services->payment_person == $user->id) selected
                                            @endif  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="fullname">Teknik Personel</label>
                            <select id="technical_person" name="technical_person" class="select2 form-select">
                                @foreach($users as $user)
                                    <option @if(isset($technical_services) && $technical_services->technical_person == $user->id) selected @endif  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="fullname">Fiyat</label>
                            <input type="text" name="totalprice" id="totalprice" class="form-control" value="{{$technical_service->total_price}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="fullname">İndirim</label>
                            <input type="number" name="discount" id="credit_card" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="fullname">Kredi Kartı</label>
                            <input type="text" name="payment_type[credit_card]"  value="0"  id="credit_card" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="fullname">Nakit</label>
                            <input type="text" name="payment_type[cash]" id="money_order"   value="0"  class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="fullname">Taksitli</label>
                            <input type="text" name="payment_type[installment]" id="installment"  value="0"  class="form-control">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Kaydet</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                    <input type="hidden"></form>
            </div>
        </div>

    </div>
@endsection
