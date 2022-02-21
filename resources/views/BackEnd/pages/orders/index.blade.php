@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-header">
                  Manage Orders
              </div>
              <div class="card-body">

                @include('BackEnd.partials.message')
                
                <table class="table table-hover table-striped" id="dataTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Product ID</th>
                      <th>Orderer Name</th>
                      <th> Orderer Phone Number</th>
                      <th>Order Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>

                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>#LC{{ $order->id }}</td>
                      <td>{{ $order->name }}</td>
                      <td>{{ $order->phone_no }}</td>
                      <td>
                        @if($order->is_paid)
                          <button type="button" class="btn btn-success btn-sm">Paid</button>
                        @else 
                          <button type="button" class="btn btn-danger btn-sm">UnPaid</button>
                        @endif

                        @if($order->is_completed)
                          <button type="button" class="btn btn-success btn-sm">Completed</button>
                        @else 
                          <button type="button" class="btn btn-warning btn-sm">Not Completed</button>
                        @endif

                        @if($order->is_seen_by_admin)
                          <button type="button" class="btn btn-success btn-sm">Seen</button>
                        @else 
                          <button type="button" class="btn btn-warning btn-sm">UnSeen</button>
                        @endif
                      </td>

                      
                      <td>
                        <div class="modal-body">

                          {{-- <form action="{{ route('admin.order.show', $order->id) }}" method="post"> --}}
                            {{-- {{ csrf_field() }} --}}
                            <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-info btn-sm">View Order</a>
                          {{-- </form> --}}

                          <form action="{{ route('admin.order.delete', $order->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"> Delete</button>
                          </form>

                          
                        </div>
                      </td>
                    </tr>

                  @endforeach


                  </tbody>

                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Product ID</th>
                      <th>Orderer Name</th>
                      <th> Orderer Phone Number</th>
                      <th>Order Status</th>
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