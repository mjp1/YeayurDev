<div style="height:85px;position:absolute;top:0px;left:0px;width:100%;background-color:#ff3300;color:#fff;">
  <div style="max-width:600px;margin:auto;padding-left:15px;">
    <img src="https://yeayur.com/images/logo_856469_web.png" style="width:45px;padding-top:22px;">
  </div>
</div>
<div style="font-family:arial;color:#000;position:relative;top:100px;max-width:600px;margin:auto;padding:15px;">
  @if ($replier->getImagePath() === "")
  @else
  <img src="{{ $replier->getImagePath() }}" style="max-height:100px;border-radius:50%;float:left;margin-right:10px;margin-bottom:25px;"/>
  @endif
  <h2>{{ $replier->username }} has just replied to your post on <a href="{{ route('profile', ['username' => $profile->username]) }}" target="_blank">{{ $profile->username }}'s profile</a>.</h2>
  <span style="display:block;color:#000000;border-top:1px solid #e3e3e3;padding-top:15px;padding-bottom:15px;clear:both;"><?php echo $reply->body ?></span>
  <div style="border-top:1px solid #e3e3e3;text-align:center;padding-top:15px;font-size:14px;">
    <ul style="list-style-type:none;margin:0px;padding:0px;">
      <li style="display:inline;padding-right:10px;border-right:1px solid #e3e3e3;"><a href="{{ route('index') }}" target="_blank" style="text-decoration:none;color:#000;">Yeayur</a></li>
      <li style="display:inline;padding-left:8px;padding-right:10px;border-right:1px solid #e3e3e3;"><a href="{{ route('terms') }}" target="_blank" style="text-decoration:none;color:#000;">Terms of Service</a></li>
      <li style="display:inline;padding-left:8px;"><a href="{{ route('privacy') }}" target="_blank" style="text-decoration:none;color:#000;">Privacy Policy</a></li>
    </ul>
    <h5>&copy; 2016 - Yeayur, Inc.</h5>
  </div>
</div>



