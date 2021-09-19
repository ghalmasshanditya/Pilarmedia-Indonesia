@extends('layouts.master')
@section('title','Absents')
@section('page-name','Absents')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="float: left;"> Attendance List  </h3>
            <a href="/export/absen/{{ request()->segment('2') }}"><button type="button" style="float: right;" class="right btn btn-outline-primary btn-sm" target="_blank" ><i class="fas fa-print"></i> Print Report</button></a>
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

<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="float: left;"> Permission List  </h3>
        <a href="/export/izin/{{ request()->segment('2') }}"><button type="button" style="float: right;" class="right btn btn-outline-primary btn-sm" target="_blank" ><i class="fas fa-print"></i> Print Report</button></a>
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
                <td>
                    @if ($data->type == 1)
                    <a href="../assets/file/{{ $data->file }}"><i class="fas fa-download"> </i> download</a>
                    @else
                    -
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
                    <th>File</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
      </div>
    <!-- /.card-body -->
</div>
</div>

@endsection

