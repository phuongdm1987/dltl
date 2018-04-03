@extends('emails/layouts/subscriber_layout')

@section('content')
<tr>
 <td>
    <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff" width="620" style="font-size:13px; color:#555; padding:20px;line-height:2em;">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0px 0px 10px 0px;">
                        Chào <span style="color:#00aeef; font-weight:bold">{{ $user->nickname }},</span>
                    </p>
                    <p style="margin:0px 0px 10px 0px;">
                        Bạn hoặc ai đó vừa yêu cầu lấy lại mật khẩu từ FSD14. Nếu bạn thực sự yêu cầu điều này, vui lòng bấm vào link bên dưới để thay đổi mật khẩu.
                    </p>
                    <p style="margin:0px">
                        <a href="{{ $forgotPasswordUrl }}">{{ $forgotPasswordUrl }}</a>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin:5px 0px 5px 0px;">
                        Cảm ơn,
                    </p>
                    <p style="margin:0px 0px 0px 0px;">
                        <span style="color:#00aeef;font-weight:bold">FSD14</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
 </td>
</tr>

<p>Hello {{ $user->last_name }},</p>

<p>Welcome to Flypaper! Please click on the following link to confirm your Flypaper account:</p>

<p><a href="{{ $activationUrl }}">{{ $activationUrl }}</a></p>

<p>Best regards,</p>

<p>Flypaper Team</p>
@stop
