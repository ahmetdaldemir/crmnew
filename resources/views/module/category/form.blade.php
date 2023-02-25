@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kategoriler /</span> @if(isset($categorys)) {{$categorys->name}} @endif</h4>
        <div class="card  mb-4">
            <h5 class="card-header">Kategori Bilgileri</h5>
            <form action="{{route('category.store')}}" method="post">
                @csrf
                <input type="hidden" name="id" @if(isset($categories)) value="{{$categories->id}}" @endif />
            <div class="card-body">
                <div>
                    <label for="defaultFormControlInput" class="form-label">Kategori Adı</label>
                    <input type="text" class="form-control" id="name"  @if(isset($categories)) value="{{$categories->name}}" @endif  name="name" aria-describedby="name">
                    <div id="name" class="form-text">
                        We'll never share your details with anyone else.
                    </div>
                </div>
                <div>
                    <label for="parent_id" class="form-label">Üst Kategori</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">Üst Kategori</option>
                        @foreach($categories_all as $category)
                            <option  @if(isset($categories)) {{ $category->id == $categories->parent_id ? 'selected' : '' }} @endif  value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                     <div id="parent_id" class="form-text">
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
