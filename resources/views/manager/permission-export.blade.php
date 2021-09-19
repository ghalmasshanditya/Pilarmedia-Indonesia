<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Type</th>
            <th>Description</th>
            <th>Status</th>
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
                <td>
                    @if ($data->type == 1)
                        Sick
                    @else
                        Paid Leave
                    @endif
                </td>
                <td>{{ $data->description }}</td>
                <td>
                    @if ($data->status == 1)
                        Approved
                    @elseif ($data->status == 2)
                        >Requested
                    @elseif ($data->status == 3)
                        Rejected
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
