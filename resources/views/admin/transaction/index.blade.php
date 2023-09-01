@extends('admin.layout.app')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="fas fa-dollar-sign"></i>                                
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">Total Profit</p>
                                    <h4 class="mb-0">{{$total_profit}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="fas fa-dollar-sign"></i>                                
                                </span>
                                <div class="media-body">
                                    <p class="mb-1">This Month Profit</p>
                                    <h4 class="mb-0">{{$monthly_profit}}</h4>
                                    @if ($percentage)
                                        <span class="badge badge-primary">{{$percentage}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon d-flex">
                                <span class="me-3 bgl-primary text-danger">
                                    <i class="fas fa-arrow-down"></i>
                                </span>
                                <div class="media-body">
                                    <h4 class="mb-0 text-black"><span class="counter ms-0">{{$total['expense']}}</span></h4>
                                    <p class="mb-0">Expense</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon d-flex">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="fas fa-arrow-up"></i>
                                </span>
                                <div class="media-body">
                                    <h4 class="mb-0 text-black"><span class="counter ms-0">{{$total['revenue']}}</span></h4>
                                    <p class="mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon d-flex">
                                <span class="me-3 bgl-primary text-danger">
                                    <i class="fas fa-arrow-down"></i>
                                </span>
                                <div class="media-body">
                                    <h4 class="mb-0 text-black"><span class="counter ms-0">{{$monthly['expense']}}</span></h4>
                                    <p class="mb-0">Expense</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget-stat card">
                        <div class="card-body p-4">
                            <div class="media ai-icon d-flex">
                                <span class="me-3 bgl-primary text-primary">
                                    <i class="fas fa-arrow-up"></i>
                                </span>
                                <div class="media-body">
                                    <h4 class="mb-0 text-black"><span class="counter ms-0">{{$monthly['revenue']}}</span></h4>
                                    <p class="mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Payment List</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-striped" id="project_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>{{ $sr_no++ }}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->description}}</td>
                                            <td><i class="{{getPaymentClass($item->type)}}"></i> {{$item->amount}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('project.edit', $item)}}">Edit</a>
                                                        <form action="{{route('project.destroy', $item)}}" method="post">
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

    <script>
        var table = $('#project_table').DataTable();
    </script>
@endsection
