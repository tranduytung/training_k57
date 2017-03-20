<p>Dear <b>{{$user->username}}</b>,</p>
<p>You are requested reset your password at {{$time->format('H:i m/d/Y T')}}.<br>
Please click on bellow link for complete reset your password.</p>
<p><a class="btn btn-primary" href="charity.diet://password/setset?token={{$token}}">Reset password</a></p>
