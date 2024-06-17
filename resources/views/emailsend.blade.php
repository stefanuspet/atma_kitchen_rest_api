<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
</head>

<body>
    <p style="font-size: x-large; font-weight: bolder">Reset Your Password</p>
    <p>
        If you requested a password reset for <b>{{ $details['username'] }}</b>!
    </p>
    <p>
        Click the link below to reset your password and complete the process.
    </p>
    <p>If you didn't make this request, please disregard this email.</p>
    <center>
        <b style="color: blue">{{ $details['url'] }}</b>
    </center>
</body>

</html>