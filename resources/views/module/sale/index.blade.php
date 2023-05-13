@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Satışlar /</span> Satış listesi</h4>

        <div class="card">
            <div class="card-body">
                @include('components.search')
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Fatura No / Tarih</th>
                        <th style="text-align: center">Müşteri</th>
                        <th style="text-align: center">Ürün</th>
                        <th style="text-align: center">Satışı Yapan</th>
                        <th style="text-align: center">Satış Fiyatı</th>
                        <th style="text-align: center">Kredi Kartı</th>
                        <th style="text-align: center">Nakit</th>
                        <th style="text-align: center">Taksit</th>
                        <th style="text-align: center">Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($invoices as $invoice)
                        @if($invoice->type == 2)
                            <?php $detail = json_decode($invoice->detail,true);  ?>
                        <tr>
                            <td><a href="{{route('invoice.show',['id' => $invoice->id])}}">#{{$invoice->number??"#"}}</a> / {{\Carbon\Carbon::parse($invoice->created_at)->format('d-m-Y')}}</td>
                            <td style="text-align: center;"><strong>{{$invoice->account->fullname ?? "Genel Cari"}}</strong></td>
                            <td style="text-align: center;">@if(!empty($detail)) {{ \App\Models\StockCard::find($detail[0]['stock_card_id'])->name ?? "Silinmiş"}} @endif</td>
                            <td style="text-align: center;">{{$invoice->staff->name}}</td>
                            <td style="text-align: right;font-weight: 600">@if(!empty($detail)) {{ $detail[0]['sale_price']  ?? 0.00}} @endif ₺</td>
                            <td style="text-align: right;font-weight: 600"> {{ $invoice->credit_card ??  0.00}}   ₺</td>
                            <td style="text-align: right;font-weight: 600"> {{ $invoice->cash ??  0.00}}   ₺</td>
                            <td style="text-align: right;font-weight: 600"> {{ $invoice->installment ??  0.00}}   ₺</td>

                            <td style="text-align: center;">
                                @if($invoice->is_status == 1)
                                    <span data-bs-toggle="tooltip" data-bs-html="true"
                                          data-bs-original-title="<span>Gönderilmedi<br> Fiyat: {{$invoice->total_price}}<br>
                                           Fatura Tarihi: {{\Carbon\Carbon::parse($invoice->create_date)->format('d-m-Y')}}</span>"
                                          aria-describedby="tooltip472596"><span
                                            class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i
                                                class="bx bx-paper-plane bx-xs"></i></span></span>
                                @endif
                                @if($invoice->is_status == 2)
                                    <span data-bs-toggle="tooltip" data-bs-html="true"
                                          aria-label="<span>Partial Payment<br> Balance: 0<br> Due Date: 09/25/2020</span>"
                                          data-bs-original-title="<span>Partial Payment<br> Balance: 0<br> Due Date: 09/25/2020</span>"
                                          aria-describedby="tooltip478233"><span
                                            class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i
                                                class="bx bx-adjust bx-xs"></i></span></span>
                                @endif

                                @if($invoice->is_status == 3)
                                    <span data-bs-toggle="tooltip" data-bs-html="true"
                                          aria-label="<span>Past Due<br> Balance: 0<br> Due Date: 08/01/2020</span>"
                                          data-bs-original-title="<span>Past Due<br> Balance: 0<br> Due Date: 08/01/2020</span>"
                                          aria-describedby="tooltip774099"><span
                                            class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i
                                                class="bx bx-info-circle bx-xs"></i></span></span>
                                @endif


                            </td>
                            <td>
                                <a title="Düzenle" href="{{route('invoice.salesedit',['id' => $invoice->id])}}"  class="btn btn-icon btn-primary">
                                    <span class="bx bx-edit-alt"></span>
                                </a>
                                <a title="Sil" href="{{route('sale.delete',['id' => $invoice->id])}}" class="btn btn-icon btn-danger">
                                    <span class="bx bxs-trash"></span>
                                </a>
                            </td>
                        </tr>
                        @endif
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
                            <label for="invoiceBackdrop" class="form-label">Şube</label>
                            <select class="form-control" name="invoice_id" id="invoiceBackdrop">
                                @foreach($invoices as $invoice)
                                    <option value="{{$invoice->id}}">{{$invoice->name}}</option>
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
    </div>
@endsection

@section('custom-js')
    <script>

        function openModal(id) {
            $("#backDropModal").modal('show');
            $("#stockCardId").val(id);
        }
    </script>
@endsection
