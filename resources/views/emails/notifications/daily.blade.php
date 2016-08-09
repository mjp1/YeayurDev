<div style="height:85px;position:absolute;top:0px;left:0px;width:100%;background-color:#ff3300;color:#fff;">
  <div style="max-width:600px;margin:auto;padding-left:15px;">
    <img src="https://yeayur.com/images/logo_856469_web.png" style="width:45px;padding-top:22px;">
  </div>
</div>
<div style="position:relative;top:100px;">
  @foreach ($user->receivedPosts as $post)
  <div style="font-family:arial;color:#000;max-width:600px;margin:auto;padding:15px;margin-bottom:50px;">
    @if ($post->user->getImagePath() === "")
    @else
    <img src="https://s3-us-west-2.amazonaws.com/yeayur-local/images/profile/471100679.JPG" style="max-height:100px;border-radius:50%;float:left;margin-right:10px;margin-bottom:25px;" />
    @endif
    <h2>{{ $post->user->username }} posted on your profile!</h2>
    <h6 style="position:relative;bottom:15px;">{{ $post->created_at->diffForHumans() }}</h6>
    <span style="display:block;border-top:1px solid #e3e3e3;border-bottom: 1px solid #e3e3e3;padding-top:15px;padding-bottom:15px;clear:both;"><?php echo $post->body ?></span>
  </div>
  @endforeach
</div>
<div style="font-family:arial;color:#000;text-align:center;padding-top:15px;font-size:14px;position:relative;top:85px;">
  <ul style="list-style-type:none;margin:0px;padding:0px;">
    <li style="display:inline;padding-right:10px;border-right:1px solid #e3e3e3;"><a href="{{ route('index') }}" target="_blank" style="text-decoration:none;color:#000;">Yeayur</a></li>
    <li style="display:inline;padding-left:8px;padding-right:10px;border-right:1px solid #e3e3e3;"><a href="{{ route('terms') }}" target="_blank" style="text-decoration:none;color:#000;">Terms of Service</a></li>
    <li style="display:inline;padding-left:8px;"><a href="{{ route('privacy') }}" target="_blank" style="text-decoration:none;color:#000;">Privacy Policy</a></li>
  </ul>
  <h5>&copy; 2016 - Yeayur, Inc.</h5>
</div>