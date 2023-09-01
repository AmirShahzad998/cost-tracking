@extends('admin.layout.app')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h2 class="card-title">Project Detail</h2>
                </div>
                <div class="card-body pb-0">
                    <p>{{$project->created_at}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Name</strong>
                            <span class="mb-0">{{$project->project_name}}</span>
                        </li>
                        
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Type</strong>
                            <span class="mb-0">{{$project->type}}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Cost</strong>
                            <span class="mb-0">{{$project->cost}}</span>
                        </li>
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Customer Name</strong>
                            <span class="mb-0">{{$project->customer->customer_name}}</span>
                        </li>
                    </ul>
                </div>
                {{-- <div class="card-footer pt-0 pb-0 text-center">
                    <div class="row">
                        <div class="col-4 pt-3 pb-3 border-end">
                            <h3 class="mb-1 text-primary">150</h3>
                            <span>Projects</span>
                        </div>
                        <div class="col-4 pt-3 pb-3 border-end">
                            <h3 class="mb-1 text-primary">140</h3>
                            <span>Uploads</span>
                        </div>
                        <div class="col-4 pt-3 pb-3">
                            <h3 class="mb-1 text-primary">45</h3>
                            <span>Tasks</span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Project Payment</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('project.payment.store', $project)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="">Title: <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">Date: <span class="text-danger">*</span></label>
                                <input type="text" name="date" id="date" class="form-control"
                                    value="{{ old('date') }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">Payment: <span class="text-danger">*</span></label>
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
                    <h4>Project Payments</h4>
                    <span class="badge badge-danger">{{$project->payments()->sum('payment')}}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped" id="milestone_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($project->payments as $item)
                                        <tr>
                                            <td>{{$sr_no++}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{$item->payment}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{route('project.payment.delete', $item->id)}}" method="post">
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
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $('#milestone_table').DataTable();
        $('#date').flatpickr();

    </script>
@endsection