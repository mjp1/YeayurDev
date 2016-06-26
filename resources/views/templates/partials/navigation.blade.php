<nav class="navbar navbar-header navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
        @if (Route::current()->getName() === 'auth.signup' || Route::current()->getName() === 'forgotlogin')

        @else
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                       
          </button>
        @endif
      @if (Auth::check())
        <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('discover.connections') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
        <span class="hidden user-username">{{ Auth::user()->username }}</span>
      @elseif (!Auth::check())
        <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('index.public') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @endif
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        @if (Auth::check())
        @if (Route::current()->getName() === 'discover.community' || Route::current()->getName() === 'discover.connections')
        @else
        <form class="head-search col-sm-6" role="search" action="{{ route('search.results') }}">
            <input type="text" class="form-control head-search-input" name="query" placeholder="Search for a streamer" />
            <span class="input-group-btn head-search-btn">
                <button class="btn search-icon" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </form>
        @endif
        <!-- <div class="navbar-request-streamer-wrapper col-sm-2">
          <button class="btn btn-default navbar-request-streamer-wrapper-btn" data-toggle="modal" data-target="#request-streamer-modal">Request Streamer</button>
        </div>  --> 
        <ul class="nav navbar-nav navbar-right navbar-right-menu">
          <li class="navbar-img-menu navbar-right-menu-item">
            @if (Auth::user()->getImagePath() === "")
              <i class="fa fa-user-secret fa-3x dropdown-toggle navbar-img img-circle" data-toggle="dropdown"></i>
            @else
              <img src="{{ Auth::user()->getImagePath() }}" class="dropdown-toggle navbar-img img-circle" data-toggle="dropdown"/>
            @endif
              <ul class="dropdown-menu">
                <li><a href="{{ route('profile', ['username' => Auth::user()->username]) }}">My Profile</a></li>
                <li><a href="{{ route('profile.edit') }}">My Settings</a></li>
                <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
              </ul>
          </li>

         <!-- Display the user's notifications -->

          <li class="navbar-right-menu-item user-notifications">
            <span id="user-notifications-count">{{ Auth::user()->getNewNotifications() }}</span>
            <i class="fa fa-bell fa-2x dropdown-toggle user-notifications-bell" data-toggle="dropdown" aria-hidden="true"></i>
            <ul class="dropdown-menu user-notifications-list">
              <li class="dropdown-header notification-header">Notifications<span class="clear-notifications">Clear All</span></li>
              @if (!Auth::user()->notifications->count())
              <li class="no-notifications">You have no notifications</li>
              @else
              @foreach (Auth::user()->notifications as $notification)
              <li class="user-notification-item">
                @if ($notification->pivot->notification_type === "Follow")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> is following you.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                @if ($notification->pivot->notification_type === "Post")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> posted new content.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                @if ($notification->pivot->notification_type === "Like")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> liked your post.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                @if ($notification->pivot->notification_type === "Stream")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> added their stream.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                <span class="hidden notification-id">{{ $notification->pivot->id }}</span>
              </li>
              @endforeach
              @endif

            </ul>
          </li>
          <li class="navbar-right-menu-item navbar-right-menu-support">
            <a href="{{ route('support') }}"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></a>
          </li>
        </ul>
        @else
        <div class="navbar-right">
          <ul class="navbar-btns-public">
            <li>
              @if (Route::current()->getName() === 'auth.signup')
                <h5 style="color:#fff;">Already registered?</h5>
              @else
                <a href="{{ route('auth.signup') }}" class="btn btn-default register-btn">Register</a>
              @endif
            </li>
            <li>
              <a href="{{ route('oauth_twitch') }}" class="btn btn-default twitch-oauth-signin"><img src="{{ asset('images/twitch_logo_small.png') }}" style="height:22px;" /> Sign In</a>
            </li>
          </ul>
        </div>  
        @endif
    </div>
  </div>



  <!-- Keep notification menu open unless clicking the bell icon or clicking off the menu -->
  <script>
     $(document).on('click', 'body .dropdown-menu', function (e) {
        e.stopPropagation();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
  <script src="https://cdn.jsdelivr.net/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>

<!-- Algolia Search -->

  <script>
    (function() {

      this.client = algoliasearch("IZ6RJN0FW4", '704e5e538cbcf83537940f36e1bef1a7');
      this.index = this.client.initIndex('users_local');

      $('.head-search-input').typeahead({ hint: false, minLength: 2 }, {
        source: this.index.ttAdapter(),
        displayKey: 'username',
        templates: {
          empty: function() {
            return  '<div class="main-search-no-results">'+
                '<h4>This streamer is not registered</h4>'+
                '<p>Instead, you can quickly create a <span class="no-results-popup" data-toggle="tooltip" data-placement="bottom" title="A fan page is a basic page of information for a streamer that any registered user can add to. That streamer can register for Yeayur and turn the fan page into a full profile page.">fan page</span> for this streamer. <a href="#" class="no-results-fan-page-link"><i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>'
                '</div>'
          },
          suggestion: function(hit) {
            return '<div class="main-search-results-item">' +
                (hit.image_path==null ? '<i class="fa fa-user-secret fa-3x search-result-item-image-unknown"></i>' : 
                '<img src="https://s3-us-west-2.amazonaws.com/yeayur-local/images/'+hit.image_path+'" class="search-result-item-image" />')+
                '<p class="search-result-item-username">'+hit.username+'</p>'+
                '<p class="search-result-item-followers-count"><i class="fa fa-users" aria-hidden="true"></i>'+hit.followers_count+'</p>'+
                '</div>'
          }
        },
        
      });
      
      /* Initiate tooltip */
      $('.head-search-input').bind('typeahead:render', function(ev, suggestion) {
        $('[data-toggle="tooltip"]').tooltip();
      });

      /*Take value from Typeahead input and update search input*/
      var myVal = $('.typeahead').typeahead('val');
      $('.head-search-input').val(myVal);

    })();
  
  </script>


</nav>