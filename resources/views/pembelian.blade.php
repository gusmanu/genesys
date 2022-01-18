@extends('layout.form-base')
@section('card-title', 'Pembelian')
@section('card-body')
<div class="card-body">
    @include('layout.alert')
    <form method="POST" action="{{route('pembelian', $inventory->inventory_id)}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="product-name">Nama</label>
                <input type="text" id="nama" class="form-control" value="{{$inventory->nama}}" disabled>
            </div>
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="amount">Jumlah</label>
                <input type="number" class="form-control" name="amount" id="amount" value="@if(old('amount')){{old('amount')}}@endif" placeholder="Jumlah">
                @error('amount')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" name="stok" id="stok" value="@if(old('stok')){{old('stok')}}@else{{$inventory->stok}}@endif" placeholder="Stok Produk">
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
