
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Check Log</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (count($absent) == 0)
        <tr class="text-center">
            <td colspan="5" class="text-center">- No Data -</td>
            </tr>
        @endif
        @php
            $no=1;
        @endphp
        @foreach ($absent as $data)
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
                <td>
                    @if ($data->type == 1)
                    Come in
                    @else
                    Come home
                    @endif
                </td>
                <td>
                    @if ($data->type == 1)
                        @if (date('H:i:s', strtotime($data->created_at)) > '09:00:00')
                            Invalid absence
                        @else
                            Valid
                        @endif
                    @else
                        @if (date('H:i:s', strtotime($data->created_at)) < '17:00:00')
                            Invalid absence
                        @else
                            Valid
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- <table>
    <thead>
        <th>No</th>
        <th>Day</th>
        <th>Time</th>
        <th>Status</th>
        <th>Description</th>>
    </thead>
    <tbody>
        @if (count($absent) == 0)
        <tr class="text-center">
            <td colspan="5" class="text-center">- No Data -</td>
            </tr>
        @endif
        @php
            $no=1;
        @endphp
        @foreach ($absent as $data)
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
                <td>
                    @if ($data->type == 1)
                    Come in
                    @else
                    Come home
                    @endif
                </td>
                <td>
                    @if ($data->type == 1)
                        @if (date('H:i:s', strtotime($data->created_at)) > '09:00:00')
                            Invalid absence
                        @else
                            Valid
                        @endif
                    @else
                        @if (date('H:i:s', strtotime($data->created_at)) < '17:00:00')
                            Invalid absence
                        @else
                            Valid
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table> --}}
