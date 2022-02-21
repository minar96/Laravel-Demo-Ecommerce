@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Insert Category
                </div>
                <form action=" {{ route('admin.category.store') }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">Category Title</label>
                    <input type="text" class="form-control" name= "name" id="name" aria-describedby="emailHelp" placeholder="Enter your category title">
                  </div>

                  <div class="form-group">
                    <label for="description"> Category Description</label>
                    <textarea name="description" id="description" class="form-control" cols="8" rows="10" placeholder="Write your Category Description."></textarea>
                  </div>

                  <div class="form-group">
                    <label for="parent-id"> Parent Category</label>
                    <select class="form-control" name="parent-id" id="">
                      <option value="">Please select a primary category</option>
                      @foreach($main_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Category Image</label>
                        <input type="file" class="form-control" name= "image" id="image">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection