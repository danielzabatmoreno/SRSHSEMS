<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enrollment Successful</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; margin:0; padding:0;">

    <div style="max-width:600px; margin:30px auto; background-color:#ffffff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); overflow:hidden; padding:30px;">
        
        <h2 style="color:#2c3e50;">Hello {{ $student->FirstName }} {{ $student->LastName }},</h2>

        <p style="color:#555555; line-height:1.6;">
            Your enrollment has been submitted successfully. Currently, your registration status is 
            <span style="font-weight:bold; color:#d35400;">Pending</span>.
        </p>

        @if(count($missing) > 0)
            <p style="font-weight:bold; color:#2980b9;">
                The following items are missing or incomplete in your registration. You must bring these documents to the school before your enrollment can be approved:
            </p>
            <ul style="list-style-type:disc; padding-left:20px; font-size:18px; color:#c0392b; margin-top:10px; margin-bottom:20px;">
                @foreach($missing as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <p style="color:#555555; line-height:1.6;">
                Once all required documents are submitted to the school, your registration will be reviewed and approved.
            </p>
        @else
            <div style="background-color:#ecfdf5; border:1px solid #2ecc71; padding:20px; border-radius:8px; margin-top:20px;">
                <h3 style="color:#27ae60; margin:0 0 10px 0;">🎉 Great news!</h3>
                <p style="color:#2c3e50; line-height:1.6; margin:0;">
                    All required information and documents have been successfully submitted. 
                    Your enrollment is now <span style="font-weight:bold; color:#27ae60;">complete</span> and is pending final review by the school.
                </p>
                <p style="color:#27ae60; font-weight:bold; margin-top:10px;">
                     Please wait for the approval email from the school. 
                </p>
            </div>
        @endif

        <p style="color:#555555; line-height:1.6;">Thank you!</p>

        <div style="margin-top:30px; font-size:14px; color:#999999; text-align:center;">
            Santa Rosa Senior High School
        </div>
    </div>

</body>
</html>
