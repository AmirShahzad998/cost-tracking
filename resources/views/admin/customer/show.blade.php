@extends('admin.layout.app')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h2 class="card-title">Customer Detail</h2>
                </div>
                <div class="card-body pb-0">
                    <p>{{$customer->created_at}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex px-0 justify-content-between">
                            <strong>Name</strong>
                            <span class="mb-0">{{$customer->customer_name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
@endsection