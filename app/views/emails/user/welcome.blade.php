<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>


<p>Welcome to Gabicus! {{$first_name}} {{$last_name}}, You are almost there.
    Just click the link below to confirm your email address.</p>
<p></p>
<span style="color: blue; font-weight: 900"><a href="{{route('user.confirm',$remember_token)}}">Click on this, to confirm your account!!
</a></span>
</p>
<p>
    Stay Awesome,<br> The team at Gabicus
</p>
<p>Thank you</p>

</body>
</html>