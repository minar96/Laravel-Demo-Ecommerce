@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Edit Division
                </div>
                <form action=" {{ route('admin.division.update', $division->id) }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">Division Name</label>
                    <input type="text" class="form-control" name= "name" id="name" value="{{ $division->name }}">
                  </div>

                  <div class="form-group">
                    <label for="priority"> Division Priority</label>
                    <input type="text" class="form-control" name= "priority" id="priority" value="{{ $division->priority }}">
                  </div>

                  <button type="submit" class="btn btn-success">Update Division</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection