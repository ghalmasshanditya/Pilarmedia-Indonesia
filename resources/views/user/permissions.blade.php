@extends('layouts.master')
@section('title','Permissions')
@section('page-name','Permissions')
@section('content')
<div class="col-12">
    @if(session()->get('message') == 'valid')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Tahnk you!</strong> Your leave permit will be processed immediately.
        </div>
    @elseif(session()->get('message') == 'invalid')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Your leave permit will is invalid
        </div>
    @endif
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"> Permission List  </h3><br>
        <button type="button" class="btn btn-outline-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#sick" ><i class="fas fa-plus"></i> Sick Permission</button>
        <button type="button" class="btn btn-outline-success btn-sm mt-2 mr-2" data-toggle="modal" data-target="#paid" ><i class="fas fa-plus"></i> Paid Leave</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th class="text-center">Type</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($permissions) == 0)
                    <tr class="text-center">
                        <td colspan="5" class="text-center">- No Data -</td>
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
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th class="text-center">Type</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
          </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Come In -->
<div class="modal fade" id="sick">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/permissions/sick/{{ Auth::user()->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Sick Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
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
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="File">File</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
                            <small>Acceptable file types are <strong>PDF, JPG, JPEG, AND PNG</strong>.</small>
                            <br>
                            <small>Max file size is <strong>5 MB</strong>.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Input</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="paid">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/permissions/paid-leave/{{ Auth::user()->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Paid Leave Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
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
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="Description">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Input</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

