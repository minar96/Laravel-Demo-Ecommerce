@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Edit Category
                </div>
                <form action=" {{ route('admin.category.update', $category->id) }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">Category Title</label>
                    <input type="text" class="form-control" name= "name" id="name" value="{{ $category->name }}">
                  </div>

                  <div class="form-group">
                    <label for="description"> Category Description(Optional)</label>
                    <textarea name="description" id="description" class="form-control" cols="8" rows="10">{{ $category->description }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="parent-id"> Parent Category(Optional)</label>
                    <select class="form-control" name="parent_id" id="">
                      <option value="">Please select a primary category</option>
                      @foreach($main_categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id? 'selected' : '' }}>{{ $cat->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="oldimage">Category Old Image</label><br>
                        <img src="{{ asset('images/category/'.$category->image) }}" alt="" width="100"><br>
                        <label for="image">Category New Image(Optional)</label><br>
                        <input type="file" class="form-control" name= "image" id="image">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success">Update Category</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection