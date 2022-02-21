@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Edit Brand
                </div>
                <form action=" {{ route('admin.brand.update', $brand->id) }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">Brand Title</label>
                    <input type="text" class="form-control" name= "name" id="name" value="{{ $brand->name }}">
                  </div>

                  <div class="form-group">
                    <label for="description"> Brand Description(Optional)</label>
                    <textarea name="description" id="description" class="form-control" cols="8" rows="10">{{ $brand->description }}</textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="oldimage">Brand Old Image</label><br>
                        <img src="{{ asset('images/brand/'.$brand->image) }}" alt="" width="100"><br>
                        <label for="image">Brand New Image(Optional)</label><br>
                        <input type="file" class="form-control" name= "image" id="image">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success">Update Brand</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection