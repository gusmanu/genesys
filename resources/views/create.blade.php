@extends('layout.form-base')
@section('card-title', 'Buat Inventory')
@section('card-body')
<div class="card-body">
    @include('layout.alert')
    <form method="POST" action="{{route('create')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="product-name">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="@if(old('nama')){{old('nama')}}@endif" placeholder="Nama Produk">
                @error('nama')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="@if(old('harga')){{old('harga')}}@endif" placeholder="Harga Produk">
                @error('harga')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" name="stok" id="stok" value="@if(old('stok')){{old('stok')}}@else{{'5'}}@endif" placeholder="Stok Produk">
                @error('stok')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <br>
        <div style="text-align: right">
        <button type="submit" style="width: 30%" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
