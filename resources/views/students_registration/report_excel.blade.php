<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Strand</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registrations as $reg)
        <tr>
            <td>{{ $reg->RegistrationID }}</td>
            <td>{{ $reg->FirstName }} {{ $reg->LastName }}</td>
            <td>{{ $reg->Strand }}</td>
            <td>{{ $reg->GradeLevel }}</td>
            <td>{{ $reg->current_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
