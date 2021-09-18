@extends('layouts.master')
@section('title','Absents')
@section('page-name','Absents')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title" style="float: left;"> Attendance List  </h3><br>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>No</th>
                    <th class="text-center">Photo</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Level</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($user) == 0)
                    <tr class="text-center">
                        <td colspan="5" class="text-center">- No Data -</td>
                    </tr>
                    @endif

                    @php
                        $no=1;
                    @endphp
                    @foreach ($user as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-center">
                            <img style="width: 50px; height: 50px" class="profile-user-img img-fluid img-circle" @if (Auth::user()->photo == '') src="{{ asset('assets') }}/dist/img/profile.png" @else src="{{ asset('assets') }}/dist/img/profile/{{ Auth::user()->photo }}" @endif alt="User profile picture">
                        </td>
                        <td>
                            {{$data->name}}
                        </td>
                        <td>{{ $data->gender }}</td>
                        <td>
                            @if ($data->level == 1)
                                Manager
                            @elseif($data->level == 2)
                                HRD
                            @elseif($data->level == 3)
                                Employee
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="/absence-report/{{ $data->id }}">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-eye"> </i> See Absent</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th class="text-center">Photo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Level</th>
                        <th class="text-center">Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- /.card-body -->
    </div>
</div>

@endsection

