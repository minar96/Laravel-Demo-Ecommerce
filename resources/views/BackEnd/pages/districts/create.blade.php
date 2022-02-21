@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-body">
                <div class="card-header">
                  Insert Distirct
                </div>
                <form action=" {{ route('admin.district.store') }} " method="post" enctype="multipart/form-data">

                  @csrf

                  @include('BackEnd.partials.message')

                  <div class="form-group">
                    <label for="name">District Name</label>
                    <input type="text" class="form-control" name= "name" id="name" aria-describedby="emailHelp" placeholder="Enter your district name">
                  </div>

                  <div class="form-group">
                    <label for="division_id"> Select a division for this district</label>
                    <select  class="form-control" name="division_id" id="division_id">
                      <option value="">Please a Division</option>
                      @foreach($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary">Add District</button>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection