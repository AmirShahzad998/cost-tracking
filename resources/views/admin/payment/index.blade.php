@extends('admin.layout.app')
@section('css')
<link href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add New Payment</h4>
            </div>
            <div class="card-body">
                <form action="{{route('payment.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label for="">Payment</label>
                            <input type="number" name="payment" class="form-control" value="{{old('payment')}}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="6">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Payments</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped" id="customer_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Payment</th>
                                    <th>Projects</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @foreach ($payments as $item)
                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->payment}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('customer.edit', $item)}}">Edit</a>
                                                    <form action="{{route('customer.destroy', $item)}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('script')
<script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>

    <script>
        var table = $('#customer_table').DataTable();
    </script>
@endsection