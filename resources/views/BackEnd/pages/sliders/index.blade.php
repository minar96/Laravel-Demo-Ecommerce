@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-header">
                  Manage Slider
              </div>
              <div class="card-body">

                @include('BackEnd.partials.message')
                {{-- Add new Slider start--}}
                <a href="#addModel" data-toggle="modal" class="btn btn-info float-right mb-2">Add new Slider</a>

                        <!-- Delete Modal -->
                          <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>

                                <div class="modal-body">
                                  <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1">Slider Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider title" required="required">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Image</label>
    <input type="file" class="form-control" name="image" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider feature image" required="required">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Related Text</label>
    <input type="text" class="form-control" name="button_text" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider related text (if need)">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Link</label>
    <input type="url" class="form-control" name="button_link" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider link (if need)">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Priority</label>
    <input type="number" class="form-control" name="priority" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider Priority" required="required">
  </div>

<div class="modal-footer">
  <button type="submit" class="btn btn-success">Add Slider</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>
                                  </form>
                                </div>


                                
                              </div>
                            </div>
                          </div>
                {{-- Add new Slider end--}}
                <table class="table table-hover table-striped" id="dataTable">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Slider Title</th>
                    <th>Slider Image</th>
                    <th>Slider Priority</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>

                  @foreach($sliders as $slider)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $slider->title }}</td>
                      <td>
                        <img src="{{ asset('images/sliders/'.$slider->image) }}" alt="" width="50">
                      </td>
                      <td>{{ $slider->priority }}</td>
                      <td>
                      <!-- Edit Modal Start-->
                        <a href="#editModel{{ $slider->id }}" data-toggle="modal" class="btn btn-success">Edit</a>
                        <div class="modal fade" id="editModel{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Update Your Content</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>

                                <div class="modal-body">
                                  <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="maltipart/form-data">
                                    {{ csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1">Slider Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider title" required="required" value="{{ $slider->title }}">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Image</label>
    <a href="{{ asset('images/sliders/'.$slider->image) }}" target="_blank">Previous Image</a>
    <input type="file" class="form-control" name="image" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider feature image">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Related Text</label>
    <input type="text" class="form-control" name="button_text" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider related text (if need)" value="{{ $slider->button_text }}">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Link</label>
    <input type="url" class="form-control" name="button_link" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider link (if need)" value="{{ $slider->button_link }}">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Slider Priority</label>
    <input type="number" class="form-control" name="priority" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slider Priority" required="required" value="{{ $slider->priority }}">
  </div>

  <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Update Slider</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                                </div>
                                    
                                  </form>
                                </div>


                                
                              </div>
                            </div>
                          </div>
                        <!-- End Modal End-->
                         <!-- Delete Modal Start-->
                        <a href="#deleteModel{{ $slider->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>

                       
                          <div class="modal fade" id="deleteModel{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Are your sure to delete this content!!</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>

                                <div class="modal-body">
                                  <form action="{{ route('admin.slider.delete', $slider->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                  </form>
                                </div>


                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal" >Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                           <!-- Delete Modal End-->
                      </td>
                    </tr>

                  @endforeach
                  </tbody>

                  <tfoot>
                    <tr>
                    <th>No</th>
                    <th>Slider Title</th>
                    <th>Slider Image</th>
                    <th>Slider Priority</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>

                </table>
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection