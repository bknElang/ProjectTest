@extends('layout')

@section('title')
Data Barang
@endsection

@section('content')
<div class="row">
  <h1>Data Barang</h1>
</div>

<div class="row">
  <div class="col-sm-6">
    <form class="form-signin" method="POST">
      {{csrf_field()}}
      <input type="text" class="fadeIn second form-control" name="name" placeholder="Nama">
      <input type="number" class="fadeIn second form-control" name="quantity" placeholder="Kuantitas">
      <div class="input-group mb-3">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control" name="price" aria-label="Harga">
        <span class="input-group-text">.00</span>
      </div>  
      <button class="btn btn-success">Create</button>
    </form>
  </div>
  <div class="col-sm-6">
    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
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
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($barangs as $barang)
          <tr>
            <th scope="row"><a style="text-decoration:none; color:black" href="/barang/{{$barang->id}}">{{$barang->id}}</a></th>
            <td>{{$barang->name}}</td>
            <td>{{$barang->qty}}</td>
            <td>{{$barang->price}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection