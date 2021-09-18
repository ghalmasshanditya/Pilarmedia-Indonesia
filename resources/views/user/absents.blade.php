@extends('layouts.master')
@section('title','Absents')
@section('page-name','Absents')
@section('content')
<div class="col-12">
    @if(session()->get('message') == 'Valid')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Tahnk you!</strong> {{ session()->get('message') }}
        </div>
    @elseif(session()->get('message') == 'Invalid')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> {{ session()->get('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"> Attendance List  </h3><br>
        <button type="button" class="btn btn-outline-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#comein" ><i class="fas fa-plus"></i> Come In</button>
        <button type="button" class="btn btn-outline-success btn-sm mt-2" data-toggle="modal" data-target="#comehome" ><i class="fas fa-plus"></i> Come Home</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th class="text-center">Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @if (count($absents) == 0)
                <tr class="text-center">
                    <td colspan="4" class="text-center">- No Data -</td>
                </tr>
                @endif

                @php
                    $no=1;
                @endphp
                @foreach ($absents as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        @php
                            echo date('d F Y', strtotime($data->created_at));
                        @endphp
                    </td>
                    <td>
                        @php
                            echo date('H:i:s', strtotime($data->created_at));
                        @endphp
                    </td>
                    <td class="text-center">
                        @if ($data->type == 1)
                        <span class="badge badge-primary">Come in</span>
                        @else
                        <span class="badge badge-success">Come home</span>
                        @endif
                    </td>
                    <td>

                        {{-- @php
                            $waktu =
                        @endphp --}}
                        @if ($data->type == 1)
                            @if (date('H:i:s', strtotime($data->created_at)) > '09:00:00')
                                Invalid absence <i class="fas fa-times text-danger ml-2"></i>
                            @else
                                Valid <i class="fas fa-check text-success ml-2"></i>
                            @endif
                        @else
                            @if (date('H:i:s', strtotime($data->created_at)) < '17:00:00')
                                Invalid absence <i class="fas fa-times text-danger ml-2"></i>
                            @else
                                Valid <i class="fas fa-check text-success ml-2"></i>
                            @endif
                        @endif

                    </td>
                </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th class="text-center">Status</th>
                    <th>Description</th>
                </tr>
            </tfoot>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Come In -->
<div class="modal fade" id="comein">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/absents/check/{{ Auth::user()->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Come In</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="language">Date</label>
                            <input type="text" class="form-control" value="@php echo date('l, d F Y'); @endphp" readonly>
                        </div>
                        <div class="form-group">
                            <label for="language">O'clock</label>
                            <input type="text" class="form-control" value="@php echo date('H:i:s'); @endphp" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Absent</button>
                </div>
                <input type="hidden" name="created_at" value="{{ now() }}">
                <input type="hidden" name="type" value="1">
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Come Home -->
<div class="modal fade" id="comehome">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/absents/check/{{ Auth::user()->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Come Home</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="language">Date</label>
                            <input type="text" class="form-control" value="@php echo date('l, d F Y'); @endphp" readonly>
                        </div>
                        <div class="form-group">
                            <label for="language">O'clock</label>
                            <input type="text" class="form-control" value="@php echo date('H:i:s'); @endphp" readonly>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="created_at" value="{{ now() }}">
                <input type="hidden" name="type" value="2">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Absent</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

