<!DOCTYPE html>
<html>
<head>
    <title>Students Enrollment Request Report</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px; 
            display: flex;
            flex-direction: column;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .header h4 {
            margin: 2px 0;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        th, td { 
            border: 1px solid #000; 
            padding: 5px; 
            text-align: center; 
        }
        th { 
            background-color: #f2f2f2; 
        }
        .content {
            flex: 1; /* take remaining space */
        }
        .footer {
            width: 100%;
            margin-top: 30px;
        }
        .footer .left {
            float: left;
        }
        .footer .right {
            float: right;
            text-align: right;
        }
    </style>
</head>
<body>

    <!-- Header without Logo -->
    <div class="header">
        <h2>Santa Rosa Senior High School</h2>
        <h4>Students Enrollment Request Report</h4>
    </div>

    <!-- Content (Table + Total) -->
    <div class="content">
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
                @php $total = 0; @endphp
                @foreach($registrations as $reg)
                <tr>
                    <td>{{ $reg->RegistrationID }}</td>
                    <td>{{ $reg->FirstName }} {{ $reg->LastName }}</td>
                    <td>{{ $reg->Strand }}</td>
                    <td>{{ $reg->GradeLevel }}</td>
                    <td>{{ $reg->current_status }}</td>
                </tr>
                @php $total++; @endphp
                @endforeach
            </tbody>
        </table>

        <!-- Total Count -->
        <p><strong>Total Students Enrollment Request:</strong> {{ $total }}</p>
    </div>

    <!-- Footer with Centered Signature Line -->
    <div class="footer">
        <div class="left">
            <p><strong>Prepared by:</strong></p>
            <div style="text-align: center; margin-top: 20px;">
                <span style="display: inline-block; border-bottom: 1px solid #000; width: 200px;"></span>
            </div>
            <p style="text-align: center; margin-top: 5px;">{{ Auth::user()->name }}</p>
        </div>
        <div class="right">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
        </div>
    </div>

</body>
</html>
