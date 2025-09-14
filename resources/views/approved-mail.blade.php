<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enrollment Approved</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; margin:0; padding:0;">

    <div style="max-width:600px; margin:30px auto; background-color:#ffffff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); overflow:hidden; padding:30px;">

        <h2 style="color:#2c3e50;">Hello {{ $registration->FirstName }} {{ $registration->MiddleName }} {{ $registration->LastName }},</h2>

        <p style="color:#555555; line-height:1.6;">
            Congratulations! Your enrollment has been <span style="font-weight:bold; color:#27ae60;">Approved</span> for Santa Rosa Senior High School.
        </p>

        <p style="color:#555555; line-height:1.6;">
            <strong>Enrollment Details:</strong>
        </p>
        <ul style="list-style-type:disc; padding-left:20px; color:#555555; line-height:1.6;">
            <li><strong>Registration ID:</strong> {{ $registration->RegistrationID }}</li>
            <li><strong>Name:</strong> {{ $registration->FirstName }} {{ $registration->MiddleName }} {{ $registration->LastName }}</li>
            <li><strong>Strand:</strong> {{ $registration->Strand }}</li>
            <li><strong>Grade Level:</strong> {{ $registration->GradeLevel }}</li>
        </ul>

        <p style="color:#555555; line-height:1.6;">
            Your student account has been created. You can now log in using the following credentials:
        </p>
        <ul style="list-style-type:disc; padding-left:20px; color:#555555; line-height:1.6;">
            <li><strong>Email:</strong> {{ $registration->Email }}</li>
            <li><strong>Password:</strong> <em>{{ $password }}</em></li>
        </ul>

        @if(count($missing) > 0)
            <p style="font-weight:bold; color:#2980b9;">
                Please note that the following items are still missing or incomplete. Bring these to the school for our records:
            </p>
            <ul style="list-style-type:disc; padding-left:20px; font-size:18px; color:#c0392b; margin-top:10px; margin-bottom:20px;">
                @foreach($missing as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @endif

        <p style="color:#555555; line-height:1.6;">Thank you and welcome to Santa Rosa Senior High School!</p>

        <div style="margin-top:30px; font-size:14px; color:#999999; text-align:center;">
            Santa Rosa National High School
        </div>
    </div>

</body>
</html>