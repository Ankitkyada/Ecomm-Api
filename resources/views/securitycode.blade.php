<!DOCTYPE html>
<html>

<head>
    <base target="_top">
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:80%;padding:20px 0">
            <div style="border-bottom:5px solid #eee">
        </div>

        <h1>{{$maildetails['Subject'] }}</h1>
        <p style="font-size:15px">Hello User</p>
        <p>To ensure the security of your account, we have implemented a two-step verification process.
                Please use the following 6-digit code to proceed with the password reset process</p>
        <p>Remember, Never share this code with anyone.</p>
        <p>This code is valid for 5 minutes only.</p>
        <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">{{$maildetails['securitycode'] }}</h2>
        <p>If you did not initiate this password reset request, please ignore this message. Your account's security is our priority.</p>
        <p style="font-size:12px;">Thanks and Regards,</p>
        </div>
</div>
</div>
</body>
</html>