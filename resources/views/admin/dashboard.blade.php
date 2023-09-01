@extends('admin.layout.app')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-xl-6">
        <div id="user-activity" class="card">
            <div class="card-header border-0 pb-0 d-sm-flex d-block">
                <div>
                    <h2 class="main-title mb-1">Earnings</h2>
                </div>
                <div class="card-action card-tabs mt-3 mt-sm-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#user" role="tab">
                                Monthly
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bounce" role="tab">
                                Weekly
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#session-duration" role="tab">
                                Today
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="user" role="tabpanel"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="activity" class="chartjs chartjs-render-monitor" height="325" style="display: block; height: 260px; width: 655px;" width="818"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
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
                    <div class="card-footer pt-0 pb-0 text-center">
                        <div class="row">
                            <div class="col-6 pt-3 pb-3 border-end">
                                <h3 class="mb-1">{{$total['expense']}}</h3><span>Expense</span>
                            </div>
                            <div class="col-6 pt-3 pb-3">
                                <h3 class="mb-1">{{$total['revenue']}}</h3><span>Revenu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
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
                    <div class="card-footer pt-0 pb-0 text-center">
                        <div class="row">
                            <div class="col-6 pt-3 pb-3 border-end">
                                <h3 class="mb-1">{{$monthly['expense']}}</h3><span>Expense</span>
                            </div>
                            <div class="col-6 pt-3 pb-3">
                                <h3 class="mb-1">{{$monthly['revenue']}}</h3><span>Revenue</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h2 class="card-title">Expenses</h2>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($expenses as $item)
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>{{$item->expense_name}}</strong>
                                    <span class="mb-0">{{max(0, $item->my_expenses_sum_expense)}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer pt-0 pb-0 text-center">
                        <div class="row">
                            <div class="col-6 pt-3 pb-3 border-end">
                                <h3 class="mb-1">{{$monthly['expense']}}</h3><span>Expense</span>
                            </div>
                            <div class="col-6 pt-3 pb-3">
                                <h3 class="mb-1">{{$monthly['revenue']}}</h3><span>Revenu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Payment (5)</h4>
                        {{-- <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#payment_modal"><i class="fas fa-plus"></i></button> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($payments as $item)
                                        <tr>
                                            <td>{{$sr_no++}}</td>
                                            <td>{{$item->formatted_date}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->amount}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('payment.index')}}" class="card-link float-end">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('modal')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="payment_modal">
    <div class="modal-dialog modal-lg">
        <form action="{{route('payment.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">Modal body text goes here.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        
        </form>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="expense_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route('expense.store')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add General Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">Modal body text goes here.</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>
@endsection
