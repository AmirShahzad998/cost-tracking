@extends('admin.layout.app')
@section('css')
<link href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add New Customer</h4>
            </div>
            <div class="card-body">
                <form action="{{route('customer.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-2">
                            <label for="">Customer Name: <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control" value="{{old('customer_name')}}">
                        </div>
                        <div class="col-lg-6 col-12 mb-2">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" value="{{old('email')}}">
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
                <h4>All Customer</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped" id="customer_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Projects</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @foreach ($customers as $item)
                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td><a href="{{route('customer.show', $item)}}">{{$item->customer_name}}</a></td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->projects_count}}</td>
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