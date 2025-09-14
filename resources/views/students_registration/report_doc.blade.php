<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Student Registration Report</h2>
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
</body>
</html>
