@extends('layout')

@section('title')
Data Perusahaan
@endsection

@section('content')
<div class="row">
  <h1>Data Perusahaan</h1>
</div>

<div class="row">
  <div class="col-sm-6">
    <form class="form-signin" method="POST"">
      {{csrf_field()}}
      <input type="text" class="fadeIn second form-control" name="name" placeholder="Nama">
      <input type="text" class="fadeIn second form-control" name="address" placeholder="Alamat">
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
          <th scope="col">Address</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($perusahaans as $perusahaan)
          <tr>
            <th scope="row"><a style="text-decoration:none; color:black" href="/perusahaan/{{$perusahaan->id}}">{{$perusahaan->id}}</a></th>
            <td>{{$perusahaan->name}}</td>
            <td>{{$perusahaan->address}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection