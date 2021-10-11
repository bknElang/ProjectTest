@extends('layout')

@section('title')
Data Transaksi
@endsection

@section('content')
  <h1>Data Transaksi</h1>
  
  <div class="row">
  <div class="col-sm-6">
      <label for="nameId">Nama User</label>
      <input type="text" id="nameId" class="fadeIn second form-control" name="name" placeholder="Nama" readonly value="{{$transaksi->uName}}">

      <label for="bNameId">Barang</label>
      <input type="text" id="bNameId" class="fadeIn second form-control" name="name" placeholder="Nama" readonly value="{{$transaksi->bName}}">

      <label for="qtyId">Kuantitas</label>
      <input type="text" id="qtyId" class="fadeIn second form-control" name="name" placeholder="Nama" readonly value="{{$transaksi->qty}}">

      <label for="pNameId">Perusahaan</label>
      <input type="text" id="pNameId" class="fadeIn second form-control" name="name" placeholder="Nama" readonly value="{{$transaksi->pName}}">
  </div> 
</div>

<div class="row">
  <div class="col-sm-6">
    <a class="btn btn-dark" href="/transaksi">Go Back</a>
  </div>

  <form action="{{$transaksi->id}}" method="POST">
      @method('delete')
      @csrf
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>

@endsection