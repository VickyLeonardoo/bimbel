<p>Hello, {{ $user->name }}</p>

<p>We received a request to reset your password. Click the link below to reset it:</p>

<p><a href="{{ url('/reset-password/' . $token . '?email=' . $user->email) }}">Reset Password</a></p>

<p>If you did not request a password reset, no further action is required.</p>

<p>Regards,<br>Bimbel BUC TEVA</p>