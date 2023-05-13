@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok Kartları /</span> Stok Kart listesi</h4>

        <div class="card">
            <div class="card-body">
                @include('components.searchactionstockcard')
            </div>
            <div class="card-header">
                <a href="{{route('stockcard.create')}}" class="btn btn-primary float-end">Yeni Stok Kartı Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" style="font-size: 13px;">
                    <thead>
                    <tr>
                        <th>Stok Adı</th>
                        <th>SKU</th>
                        <th>Barkod</th>
                        <th>Adet</th>
                        <th>Kategori</th>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Alış F</th>
                        <th>Destek. F.</th>
                        <th>Satış F.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($stockcards as $stockcard)
                         <tr>
                            <td><strong>{{$stockcard['name']}}</strong></td>
                            <td><strong>{{$stockcard['sku']}}</strong></td>
                            <td><strong>{{$stockcard['barcode']}}</strong></td>
                            <td><strong>{{$stockcard['quantity']}}</strong></td>
                            <td><strong>{{$stockcard['category'] ?? "Belirtilmedi"}}</strong></td>
                            <td><strong>{{$stockcard['brand']}}</strong></td>
                            <td> <?php
                                     foreach ($stockcard['version'] as $mykey => $myValue) {
                                         echo "$myValue</br>";
                                     }
                                     ?></td>
                            <td>{{$stockcard['cost_price']}}</td>
                            <td>{{$stockcard['base_cost_price']}}</td>
                            <td>{{$stockcard['sale_price']}}</td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           onclick="updateStatus('stockcard/update',{{$stockcard['id']}},{{$stockcard['is_status'] == 1 ? 0:1}})"
                                           id="flexSwitchCheckChecked" {{$stockcard['is_status'] == 1 ? 'checked':''}} />
                                </div>
                            </td>
                            <td>
                                <a href="{{route('invoice.create',['id' => $stockcard['id']])}}" title="Fatura Ekle"  class="btn btn-icon btn-danger">
                                    <span class="bx bx-list-plus"></span>
                                </a>
                                <button type="button" title="Sevk Et" onclick="openModal({{$stockcard['id']}})"
                                        class="btn btn-icon btn-success">
                                    <span class="bx bx-transfer"></span>
                                </button>
                                <!-- a title="Hareket Ekle" href="{{route('stockcard.movement',['id' => $stockcard['id']])}}"
                                   class="btn btn-icon btn-success">
                                    <span class="bx bxl-product-hunt"></span>
                                </a -->
                                <a title="Düzenle" href="{{route('stockcard.edit',['id' => $stockcard['id']])}}"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bx-edit-alt"></span>
                                </a>
                                <a title="Sil" href="{{route('stockcard.delete',['id' => $stockcard['id']])}}"
                                   class="btn btn-icon btn-danger">
                                    <span class="bx bxs-trash"></span>
                                </a>
                                  <button type="button" onclick="priceModal({{$stockcard['id']}})"
                                     class="btn btn-icon btn-success">
                                      <span class="bx bxs-dollar-circle"></span>
                                  </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-5">
    </div>

    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="transferForm">
                @csrf
                <input id="stockCardId" name="stock_card_id" type="hidden">
                <input id="id" name="id" type="hidden">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Sevk İşlemi</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Serial Number</label>
                            <input
                                type="text"
                                id="serialBackdrop"
                                class="form-control"
                                placeholder="Seri Numarası"
                                name="serial_number"
                            />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="sellerBackdrop" class="form-label">Şube</label>
                            <select class="form-control" name="seller_id" id="sellerBackdrop">
                                @foreach($sellers as $seller)
                                    <option value="{{$seller->id}}">{{$seller->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="sellerBackdrop" class="form-label">Neden</label>
                            <select class="form-control" name="reason_id" id="sellerBackdrop">
                                @foreach($reasons as $reason)
                                    <option value="{{$reason->id}}">{{$reason->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kapat
                    </button>
                    <button type="submit" class="btn btn-primary">Sevk İşlemi Başlat</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="priceModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="priceForm">
                @csrf
                <input id="stockCardId" name="stock_card_id" type="hidden">
                 <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Fiyat Değişiklik İşlemi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Alış Fiyatı</label>
                            <input type="text" id="serialBackdrop" class="form-control" name="cost_price" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Destekli Satış Fiyatı</label>
                            <input type="text" id="serialBackdrop" class="form-control" name="base_cost_price" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Satış Fiyatı</label>
                            <input type="text" id="serialBackdrop" class="form-control" name="sale_price" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Kapat
                    </button>
                    <button type="submit" class="btn btn-primary">Fiyat Değiştir</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('custom-js')
    <script>
        function priceModal(id) {
            $("#priceModal").modal('show');
            $("#priceModal #stockCardId").val(id);
        }
        function openModal(id) {
            $("#backDropModal").modal('show');
            $("#stockCardId").val(id);
        }

        $("#transferForm").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var actionUrl = '{{route('stockcard.sevk')}}';
            $.ajax({
                type: "POST",
                url: actionUrl + '?id=' + $("#stockCardId").val() + '',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data, status) {
                    Swal.fire({
                        icon: status,
                        title: data,
                        customClass: {
                            confirmButton: "btn btn-success"
                        },
                        buttonsStyling: !1
                    });
                    $("#backDropModal").modal('hide');
                },
                error: function (request, status, error) {
                    Swal.fire({
                        icon: status,
                        title: request.responseJSON,
                        customClass: {
                            confirmButton: "btn btn-danger"
                        },
                        buttonsStyling: !1
                    });
                    $("#backDropModal").modal('hide');
                }
            });

        });
        $("#priceForm").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var actionUrl = '{{route('stockcard.priceupdate')}}';
            $.ajax({
                type: "POST",
                url: actionUrl + '?id=' + $("#stockCardId").val() + '',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data, status) {
                    Swal.fire({
                        icon: status,
                        title: data,
                        customClass: {
                            confirmButton: "btn btn-success"
                        },
                        buttonsStyling: !1
                    });
                    $("#priceModal").modal('hide');
                },
                error: function (request, status, error) {
                    Swal.fire({
                        icon: status,
                        title: request.responseJSON,
                        customClass: {
                            confirmButton: "btn btn-danger"
                        },
                        buttonsStyling: !1
                    });
                    $("#priceModal").modal('hide');
                }
            });

        });
    </script>
@endsection
