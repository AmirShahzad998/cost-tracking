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
                    <h4>Add New Project</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('project.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <label for="">Project Name</label>
                                <input type="text" name="project_name" class="form-control"
                                    value="{{ old('project_name') }}">
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <label for="">Customer Name</label>
                                <select name="customer_id" class="form-control" id="customer_id">
                                    @foreach ($customers as $item)
                                        <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <label for="">Project Type</label>
                                <select name="type" class="form-control">
                                    <option value="Fixed">Fixed</option>
                                    <option value="Hourly">Hourly</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <label for="">Cost</label>
                                <input type="number" name="cost" class="form-control" value="{{ old('cost') }}">
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
                    <h4>Project List</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-striped" id="project_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Client Name</th>
                                        <th>Cost</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($projects as $item)
                                        <tr>
                                            <td>{{ $sr_no++ }}</td>
                                            <td><a
                                                    href="{{ route('project.show', $item) }}">{{ $item->project_name }}</a>
                                            </td>
                                            <td>{{ $item->customer->customer_name }}</td>
                                            <td>{{ $item->cost }}</td>
                                            <td><span class="{{getStatusClass($item->status)}}">{{ $item->status }}</span></td>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        var table = $('#project_table').DataTable();
        $('#date').flatpickr();
    </script>
@endsection
