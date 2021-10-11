@extends('layout')

@section('title')
Data Transaksi
@endsection

@section('content')
  <h1>Data Transaksi</h1>
  
  <div class="row">
  <div class="col-sm-6">
    <form class="form-signin" method="POST">
      {{csrf_field()}}
      <input type="text" class="fadeIn second form-control" name="name" placeholder="Nama" readonly value="{{auth()->user()->name}}">
      <select class="form-select" name="barang">
        <option disabled selected>--Pilih Barang--</option>
        @foreach ($barangs as $barang)
            <option value="{{$barang->id}}">{{$barang->name}}</option>
        @endforeach
      </select>
      <input type="number" class="fadeIn second form-control" name="quantity" placeholder="Kuantitas">
      <select class="form-select" name="perusahaan">
        <option disabled selected>--Pilih Perusahaan--</option>
        @foreach ($perusahaans as $perusahaan)
            <option value="{{$perusahaan->id}}">{{$perusahaan->name}}</option>
        @endforeach
      </select>
      <button class="btn btn-success">Create</button>
    </form>
  </div>

  <div class="col-sm-6">
    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
        <br>
    @endif

    @if(Session::has('failedOrder'))
        <div class="alert alert-warning">{{ Session::get('failedOrder') }}</div>
        <br>
    @endif

    @if(Session::has('successDelete'))
        <div class="alert alert-danger">{{ Session::get('successDelete') }}</div>
        <br>
    @endif
  </div>
  
</div>

  <div class="row text-muted">
  <div class="col-sm-12">
    Click ID to show details!
  </div>
</div>


<div class="row mt-2">
  <div class="col-sm-12">
    <table class="table">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">User</th>
          <th scope="col">Barang</th>
          <th scope="col">Quantity</th>
          <th scope="col">Perusahaan</th>
          <th scope="col">Tanggal Transaksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transaksis as $transaksi)
          <tr>
            <th scope="row"><a style="text-decoration:none; color:black" href="/transaksi/{{$transaksi->id}}">{{$transaksi->id}}</a></th>
            <td>{{$transaksi->uName}}</td>
            <td>{{$transaksi->bName}}</td>
            <td>{{$transaksi->qty}}</td>
            <td>{{$transaksi->pName}}</td>
            <td>{{$transaksi->created_at}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection