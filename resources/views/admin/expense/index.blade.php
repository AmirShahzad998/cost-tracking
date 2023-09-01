@extends('admin.layout.app')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add My Expense</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('my.expense.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-12 mb-3">
                                <label for="">Title: <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            </div>
                            <div class="col-lg-4 col-12 mb-3">
                                <label for="">Date: <span class="text-danger">*</span></label>
                                <input type="text" name="date" id="date" class="form-control" value="{{old('date')}}">
                            </div>
                            <div class="col-lg-4 col-12 mb-3">
                                <label for="">Type: <span class="text-danger">*</span></label>
                                <select name="expense_id" id="" class="form-control">
                                    @foreach ($expenses as $item)
                                        <option value="{{$item->id}}">{{$item->expense_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="">Expense: <span class="text-danger">*</span></label>
                                <input type="number" name="expense" class="form-control" value="{{old('expense')}}">
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
                    <h4>All expense</h4>
                    <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#add_expense_modal"><i class="fas fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped" id="expense_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Expense Name</th>
                                        <th>Total Expense</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($expenses as $item)
                                        <tr>
                                            <td>{{ $sr_no++ }}</td>
                                            <td><a href="{{ route('expense.show', $item) }}">{{ $item->expense_name }}</a></td>
                                            <td>{{max(0, $item->my_expenses_sum_expense)}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-danger light sharp"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <circle fill="#000000" cx="5" cy="12"
                                                                    r="2"></circle>
                                                                <circle fill="#000000" cx="12" cy="12"
                                                                    r="2"></circle>
                                                                <circle fill="#000000" cx="19" cy="12"
                                                                    r="2"></circle>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('expense.edit', $item) }}">Edit</a>
                                                        <form action="{{ route('expense.destroy', $item) }}" method="post">
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
@section('modal')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="add_expense_modal">
    <div class="modal-dialog modal-lg">
        <form action="{{route('expense.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Expense Name</label>
                            <input type="text" name="expense_name" class="form-control" value="{{old('expense_name')}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        var table = $('#expense_table').DataTable();
        $('#date').flatpickr();
    </script>
@endsection
