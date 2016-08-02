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
        <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('index') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
        @if (Auth::check())
        <span class="hidden user-username">{{ Auth::user()->username }}</span>
        @endif
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        @if (Route::current()->getName() === 'auth.signup')
        @else
        <form class="head-search col-sm-6" role="search" action="{{ route('search.results') }}">
            <input type="text" class="form-control head-search-input" name="query" placeholder="Search for a streamer" />
            <span class="input-group-btn head-search-btn">
                <button class="btn search-icon">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </form>
        @endif
        @if (Auth::check())
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
              <!-- Display Auth user's reputation points -->
              <span class="reputation-points" data-toggle="tooltip" data-placement="bottom" title="Your reputation points. You earn reputation by posting content and receiving upvotes from other users on your posts.">({{ Auth::user()->user_points }})</span>
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
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> posted new content on <a href="{{ route('profile', ['username' => $notification->pivot->profile_name]) }}">{{ $notification->pivot->profile_name }}'s</a> profile.</div>
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
                @if ($notification->pivot->notification_type === "Fan")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> posted on <a href="{{ route('fan', ['displayName' => $notification->pivot->fan_page]) }}">{{ $notification->pivot->fan_page }}'s</a> fan page.</div>
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
              <a href="{{ route('oauth_twitch') }}" class="btn btn-default twitch-oauth-signin"><img src="{{ asset('images/twitch_logo_small.png') }}" style="height:22px;" /> Sign In / Register</a>
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
      this.index = this.client.initIndex('profilesAndFans_{{ env('ALGOLIA_CONNECTION') }}');

      $('.head-search-input').typeahead({ hint: false, minLength: 1 }, {
        source: this.index.ttAdapter(),
        displayKey: 'username',
        templates: {
          empty: function() {
            return  '<div class="main-search-no-results">'+
                '<h4>This streamer is not registered</h4>'+
                '<p>Instead, you can quickly create a <span class="no-results-popup" data-toggle="tooltip" data-placement="bottom" title="A fan page is a basic page of information for a streamer that any registered user can add to. That streamer can register for Yeayur and turn the fan page into a full profile page.">fan page</span> for this streamer. <span class="no-results-fan-page-link"><i class="fa fa-hand-o-right" aria-hidden="true"></i></span></p>'+
                '<p class="algolia-logo-no">Powered by <img src="{{ asset("images/Algolia_logo_bg-white.jpg") }}" /></p>'+
                '</div>'
          },
          suggestion: function(hit) {
            // Check if index object is a fan page by checking for display_name
            if (hit.display_name)
            {
              return '<a href="/fan/'+hit.display_name+'" class="main-search-results-item">' +
                  (hit.logo_url==null ? '<i class="fa fa-user-secret fa-3x search-result-item-image-unknown"></i>' : '<img src="'+hit.logo_url+'" class="search-result-item-image" />')+
                  '<p class="search-result-item-username">'+hit.display_name+' (Fan Page)</p>'+
                  '<p class="search-result-item-followers-count"><i class="fa fa-users" aria-hidden="true"></i>'+(hit.followers_count ? hit.followers_count : '0')+'</p>'+
                  '<p class="algolia-logo">Powered by <img src="{{ asset("images/Algolia_logo_bg-white.jpg") }}" /></p>'+
                  '</a>'
            } else {
              return '<a href="/'+hit.username+'" class="main-search-results-item">' +
                  (hit.image_path==null ? '<i class="fa fa-user-secret fa-3x search-result-item-image-unknown"></i>' : hit.image_upload==1 ? 
                  '<img src="https://s3-us-west-2.amazonaws.com/{{ env('S3_BUCKET') }}/images/profile/'+hit.image_path+'" class="search-result-item-image" />' : 
                  '<img src="'+hit.image_path+'" class="search-result-item-image" />')+
                  '<p class="search-result-item-username">'+hit.username+'</p>'+
                  '<p class="search-result-item-followers-count"><i class="fa fa-users" aria-hidden="true"></i>'+(hit.followers_count ? hit.followers_count : '0')+'</p>'+
                  '<p class="algolia-logo">Powered by <img src="{{ asset("images/Algolia_logo_bg-white.jpg") }}" /></p>'+
                  '</a>'
            }   
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

      // Go to page when selecting item from autocomplete search list
      $('.head-search-input').bind('typeahead:select', function(ev, suggestion) {
        if (suggestion.display_name)
        {
          window.location.href = "/fan/"+suggestion.display_name;
        } else {
          window.location.href = "/"+suggestion.username;
        }


      });

    })();
  
  </script>


</nav>