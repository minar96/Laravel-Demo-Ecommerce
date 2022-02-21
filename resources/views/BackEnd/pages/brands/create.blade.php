@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Insert Brand
                </div>
                <form action=" {{ route('admin.brand.store') }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">Brand Title</label>
                    <input type="text" class="form-control" name= "name" id="name" aria-describedby="emailHelp" placeholder="Enter your brand title">
                  </div>

                  <div class="form-group">
                    <label for="description"> Brand Description</label>
                    <textarea name="description" id="description" class="form-control" cols="8" rows="10" placeholder="Write your Brand Description."></textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Brand Image</label>
                        <input type="file" class="form-control" name= "image" id="image">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary">Add Brand</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection