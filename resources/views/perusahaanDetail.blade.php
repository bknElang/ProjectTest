@extends('layout')

@section('title')
{{$perusahaan->name}}
@endsection

@section('content')
<div class="row">
  <div class="col-sm-6">
    <h1>{{$perusahaan->name}}</h1>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <form class="form-signin" method="POST"">
      {{csrf_field()}}
      <input type="text" class="fadeIn second form-control" name="name" placeholder="Nama" value="{{$perusahaan->name}}">
      <input type="text" class="fadeIn second form-control" name="address" placeholder="Alamat" value="{{$perusahaan->address}}">
      <button class="btn btn-success">Update</button>
    </form>

    <form action="{{$perusahaan->id}}" method="POST">
      @method('delete')
      @csrf
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a class="btn btn-dark" href="/perusahaan">Go Back</a>

  </div>
  
  <div class="col-sm-6">
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        <br>
    @endif
  </div>
  
</div>
@endsection