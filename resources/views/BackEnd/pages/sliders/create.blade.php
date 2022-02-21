@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Insert Your Division
                </div>
                <form action=" {{ route('admin.division.store') }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">Division Name</label>
                    <input type="text" class="form-control" name= "name" id="name" aria-describedby="emailHelp" placeholder="Enter your division name">
                  </div>

                  <div class="form-group">
                    <label for="priority"> Division Priority</label>
                    <input type="text" class="form-control" name= "priority" id="priority" aria-describedby="emailHelp" placeholder="Enter your division priority">
                  </div>

                  
                  <button type="submit" class="btn btn-primary">Add Division</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection