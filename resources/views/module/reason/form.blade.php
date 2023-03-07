@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nedenler /</span> @if(isset($reasons)) {{$reasons->name}} @endif</h4>
        <div class="card  mb-4">
            <h5 class="card-header">NEden Bilgileri</h5>
            <form action="{{route('reason.store')}}" method="post">
                @csrf
                <input type="hidden" name="id" @if(isset($reasons)) value="{{$reasons->id}}" @endif />
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Neden Tipi</label>
                    <select name="type" class="form-control" id="type" >
                         <option value="1">İPTAL</option>
                         <option value="2">İADE</option>
                         <option value="3">SATIŞ</option>
                         <option value="4">TEKNİK SERVİS</option>
                    </select>
                    <div id="name" class="form-text">
                        We'll never share your details with anyone else.
                    </div>
                </div>
                <div>
                    <label for="defaultFormControlInput" class="form-label">NEden Adı</label>
                    <input type="text" class="form-control" id="name"  @if(isset($reasons)) value="{{$reasons->name}}" @endif  name="name" aria-describedby="name">
                    <div id="name" class="form-text">
                        We'll never share your details with anyone else.
                    </div>
                </div>

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
