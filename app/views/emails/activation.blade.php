<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>


    </style>
</head>
<body style="background-color: #e0e1e5;">
<div style=" background-color: #3B5998;">
    <img src="{{{$message->embed(asset('uploads/logo/logo.png')) }}}" style="width:100px;padding:20px 0px 20px 200px">
</div>
<div style="border-radius:4px;border: 1px solid #e5e5e5;padding-top:10px;">
    <div style="color: #7f7f7f;background-color: #ffffff;padding:10px;text-align: center;font-size: 20px;border-bottom: 1px solid #e5e5e5;margin-bottom: 40px;">
        You're almost done with the sign-up process
    </div>
    <div style="border: 1px solid #e5e5e5;margin:0px auto;padding: 20px;background-color: #ffffff;">
        <table style="margin: 0px auto;border: 1px solid #e5e5e5;">
            <tr>
                <td style="width:85px">
                    <img src="{{{$message->embed(asset('assets/images/avatar.jpg')) }}}" style="width:80px;padding: 20px">
                </td>
                <td style="padding-right:20px ">
                    <h2>{{ ucfirst($name) }}</h2>
                    <h4 style="color: #7f7f7f;">{{{ $email }}}</h4>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;padding-bottom: 20px">
                    <a style="display: block;padding: 10px 0px;margin:0px 20px;background-color: #3B5998;text-align: center;font-size: 20px;font-weight: bold;color: #fff;text-decoration: none;border-radius: 4px;" href="{{ $activationLink }}"> Activate Your Account </a>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>




