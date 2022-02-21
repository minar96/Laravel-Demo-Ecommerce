@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Edit Product
                </div>
                <form action=" {{ route('admin.product.update', $product->id) }} " method="post" enctype="multipart/form-data">

                  {{ csrf_field() }}

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" name= "title" id="exampleInputEmail1" value="{{ $product->title }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDescription1">Description</label>
                    <textarea name="description" id="exampleInputDescription1" class="form-control" cols="8" rows="10" placeholder="Write your Product Description.">{{ $product->description }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="number" class="form-control" name= "price" id="exampleInputEmail1" value="{{ $product->price }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="number" class="form-control" name= "quantity" id="exampleInputEmail1" value="{{ $product->quantity }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Category</label>
                    <select class="form-control" name="category_id" id="">
                    <option value="">Select a category for this product</option>
                    @foreach('App\Models\Category'::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
                    <option value="{{ $parent->id }}" {{ $parent->id == $product->category->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                      @foreach('App\Models\Category'::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                        <option value="{{ $child->id }}" {{ $child->id == $product->category->id ? 'selected' : '' }}>----->{{ $child->name }}</option>
                      @endforeach
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Brand</label>
                    <select class="form-control" name="brand_id" id="">
                      <option value="">Select a brand for this product</option>
                      @foreach('App\Models\Brand'::orderBy('name', 'asc')->get() as $br)
                        <option value="{{ $br->id }}" {{ $br->id == $product->brand->id ? 'selected' : '' }}>{{ $br->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name= "product_image" id="product_image">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name= "product_image" id="product_image">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name= "product_image" id="product_image">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name= "product_image" id="product_image">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name= "product_image" id="product_image">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" name= "product_image" id="product_image">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection