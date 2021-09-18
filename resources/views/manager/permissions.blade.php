@extends('layouts.master')
@section('title','Permissions')
@section('page-name','Permissions')
@section('content')
<div class="col-12">
    @if(session()->get('message') == 'approve')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Permissions has been approved.
        </div>
    @elseif(session()->get('message') == 'reject')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Permissions has been rejected.
        </div>
    @endif
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"> Permission List  </h3><br>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th class="text-center">Type</th>
                    <th>File</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($permissions) == 0)
                    <tr class="text-center">
                        <td colspan="7" class="text-center">- No Data -</td>
                    </tr>
                    @endif
                @php
                    $no=1;
                @endphp
                @foreach ($permissions as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        @php
                            echo date('d F Y', strtotime($data->date));
                        @endphp
                    </td>
                    <td class="text-center">
                        @if ($data->type == 1)
                            <span class="badge badge-primary">Sick</span>
                        @else
                            <span class="badge badge-success">Paid Leave</span>
                        @endif
                    </td>
                    <td> <a href="../assets/file/{{ $data->file }}"><i class="fas fa-download"> </i> download</a></td>
                    <td>{{ $data->description }}</td>
                    <td>
                        @if ($data->status == 1)
                            <span class="badge badge-success">Approved</span>
                        @elseif ($data->status == 2)
                            <span class="badge badge-warning">Requested</span>
                        @elseif ($data->status == 3)
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button style="width: 100%" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#approve{{ $data->id }}" ><i class="fas fa-check"></i> Approve</button><br>
                        <button style="width: 100%" type="button" class="btn btn-outline-danger btn-sm mt-2" data-toggle="modal" data-target="#reject{{ $data->id }}" ><i class="fas fa-times"></i> Reject</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th class="text-center">Type</th>
                        <th>File</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
            </table>
          </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Come In -->
@foreach ($permissions as $data)
<div class="modal fade" id="approve{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/permissions/approve/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Approve Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" placeholder="name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Type">Type</label>
                            <select class="form-control @error('type') is-invalid @enderror select2bs4" name="type" value="{{ old('type') }}" readonly>
                                <option disabled>- Permission Type -</option>
                                <option selected value="1">Sick</option>
                                <option value="2">Paid leave</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Date">Date</label>
                            <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="@php echo date('d F Y', strtotime($data->date)); @endphp" placeholder="Date" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $data->description }}" placeholder="Description" readonly>
                        </div>
                        <div class="form-group">
                            <label for="File">File</label><br>
                            <a href="../assets/file/{{ $data->file }}"><i class="fas fa-download"> </i> download</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

@foreach ($permissions as $data)
<div class="modal fade" id="reject{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/permissions/reject/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Reject Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" placeholder="name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Type">Type</label>
                            <select class="form-control @error('type') is-invalid @enderror select2bs4" name="type" value="{{ old('type') }}" readonly>
                                <option disabled>- Permission Type -</option>
                                <option value="1">Sick</option>
                                <option selected value="2">Paid leave</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Date">Date</label>
                            <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="@php echo date('d F Y', strtotime($data->date)); @endphp" placeholder="Date" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $data->description }}" placeholder="Description" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach
@endsection

