<?php

class SendEmail {
   public function fire($job, $data) {
      $data = $data['message'];
      $user = $data['user'];
      // Send the activation code through email
      //
      Mail::send('emails.register-activate', $data, function($m) use ($user) {
         $m->to($user->email, $user->last_name);
         $m->subject('Kích hoạt tài khoản ' . $user->last_name . ' tại Waa');
      });

      $job->release();
   }
}