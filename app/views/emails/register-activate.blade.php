@extends('emails/layouts/notification')

@section('content')
<tr>
 <td>
    <table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#fff" width="620" style="font-size:13px; color:#555; padding:20px;line-height:2em;">
        <tbody>
            <tr>
                <td>
                    <p style="margin:0px 0px 10px 0px;">
                        Chào <span style="color:#00aeef; font-weight:bold">{{ $user->fullname }},</span>
                    </p>
                    <p style="margin:0px 0px 10px 0px;">
                        Cảm ơn bạn đã đăng ký tài khoản trên Vngoing. Để kích hoạt tài khoản, bạn vui lòng bấm vào link bên dưới.
                    </p>
                    <p style="margin:0px">
                        <a href="{{ $activationUrl }}">{{ $activationUrl }}</a>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin:5px 0px 5px 0px;">
                        Cảm ơn,
                    </p>
                    <p style="margin:0px 0px 0px 0px;">
                        <span style="color:#00aeef;font-weight:bold">VnGoing</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
 </td>
</tr>
@stop
