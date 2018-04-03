@extends('emails/layouts/default')

@section('content')
<p>Hello {{ $name }},</p>

<p>Please click on the following link to updated your password:</p>

<p>Note: A $message variable is always passed to e-mail views, and allows the inline embedding of attachments. So, it is best to avoid passing a message variable in your view payload.</p>

<p>Best regards,</p>

<p>FSD14 Team</p>
@stop
