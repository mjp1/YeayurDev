<nav style="height:85px;position:absolute;top:0px;left:0px;width:100%;background-color:#ff3300;color:#fff;">
  <div style="max-width:600px;margin:auto;padding-left:15px;">
    <img src="https://yeayur.com/images/logo_856469_web.png" style="width:45px;padding-top:22px;">
  </div>
</nav>
<div style="font-family:arial;color:#000;position:relative;top:100px;max-width:600px;margin:auto;padding:15px;">
  @if ($poster->getImagePath() === "")
  @else
  <img src="{{ $poster->getImagePath() }}" style="height:100px;border-radius:50%;float:left;margin-right:10px;margin-bottom:25px;"/>
  @endif
  <h2>{{ $poster->username }} has just posted on your profile!</h2>
  <span style="display:block;border-top:1px solid #e3e3e3;padding-top:15px;padding-bottom:15px;clear:both;"><?php echo $post->body ?></span>
  <div style="border-top:1px solid #e3e3e3;text-align:center;padding-top:15px;font-size:14px;">
    <ul style="list-style-type:none;margin:0px;padding:0px;">
      <li style="display:inline;padding-right:10px;border-right:1px solid #e3e3e3;">Yeayur</li>
      <li style="display:inline;padding-left:8px;padding-right:10px;border-right:1px solid #e3e3e3;">Terms of Service</li>
      <li style="display:inline;padding-left:8px;"><a href="#" style="text-decoration:none;color:#000;">Privacy Policy</a></li>
    </ul>
    <h5>&copy; 2016 - Yeayur, Inc.</h5>
  </div>
</div>



