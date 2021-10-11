@extends('layout')

@section('title')
{{$barang->name}}
@endsection

@section('content')
<div class="row">
  <div class="col-sm-6">
    <h1>{{$barang->name}}</h1>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <form method="POST">
      {{csrf_field()}}
      <input type="text" class="fadeIn second form-control" name="name" placeholder="Nama" value="{{$barang->name}}">
      <input type="number" class="fadeIn second form-control" name="quantity" placeholder="Kuantitas" value="{{$barang->qty}}">
      <div class="input-group mb-3">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control" name="price" aria-label="Harga" value="{{$barang->price}}">
        <span class="input-group-text">.00</span>
      </div>
      <button class="btn btn-primary">Update</button>
    </form>

    <form action="{{$barang->id}}" method="POST">
      @method('delete')
      @csrf
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a class="btn btn-dark" href="/barang">Go Back</a>

  </div>
  
  <div class="col-sm-6">
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        <br>
    @endif
  </div>
  
</div>
@endsection