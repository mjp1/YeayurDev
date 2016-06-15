@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="{{ asset('images/logo_full.png') }}" class="welcome-logo" />
		<h3 class="main-mission">Find Your Streamer</h3>
		<form class="search-main col-sm-6 col-sm-offset-3" role="search" action="{{ route('search.results') }}">
			<input type="text" class="form-control input-global" name="query" id="main-search-input" placeholder="Search for a streamer"/>
			<span class="input-group-btn head-search-btn">
                <button class="btn main-search-icon" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
		</form>
	</div>
	<div class="main-posts-nav">
		<ul class="main-posts-nav-list">
			<li><a href="{{ route('discover.community') }}" class="main-posts-nav-tab">Community</a></li>
			<li><a href="{{ route('discover.connections') }}" class="main-posts-nav-tab visible">My Connections</a></li>
		</ul>
	</div>
	<div class="main-posts connections">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($connectionsPosts->count())
			    @foreach ($connectionsPosts as $Posts)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      @if ($Posts->request_streamer)
						<div class="thumbnail request-streamer-thumbnail">
				      @else
				      	<div class="thumbnail">
		      		  @endif
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="{{ route('profile', ['username' => $Posts->user->username]) }}">
				            @if ($Posts->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ $Posts->user->getImagePath() }}" alt="{{ $Posts->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="{{ route('profile', ['username' => $Posts->user->username]) }}">
				            <h5 class="streamer-post-name">{{ $Posts->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $Posts->created_at->diffForHumans() }}</span>
				        </div>
				        @if ($Posts->request_streamer)
							<button class="btn btn-global request-streamer-respond-btn">Respond</button>
							<span class="respond-btn-count">10 responses left</span>
						@endif
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				          	<span class="help-block request-streamer-title">Help me find a streamer!</span>
				            <span>{{ $Posts->body }}</span>
				            <br>
							<img src="{{ $Posts->getImagePath() }}" class="img-responsive" />
				          </div>
				        </div>
				        <ul class="streamer-post-message-footer">
				        	<li class="streamer-followers">
								<i class="fa fa-users" title="Followers"></i>
								<span class="fan-count">{{ $Posts->user->followers()->count() }}</span>
							</li>
							<li class="streamer-post-like-count">
								<img src="{{ asset('images/logo_compact_black.png') }}" class="streamer-post-like-count-img" title="Likes" />
								<span class="like-count">{{ $Posts->likes->count() }}</span>
							</li>
						</ul>
						@if ($Posts->user->twitch_url)
							<a href="https://www.twitch.tv/{{ $Posts->user->twitch_url }}" target="_blank" class="external-link-twitch">
								<img src="{{ asset('images/twitch_oauth_logo.png') }}" class="img-responsive" /><i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						@elseif ($Posts->user->youtube_url)
							<a href="https://www.youtube.com/watch?v={{ $Posts->user->youtube_url }}" target="_blank" class="external-link-twitch">
								<img src="{{ asset('images/youtube_oauth_logo.png') }}" class="img-responsive" /><i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						@else
						@endif																																			
				      </div>
				    </div>
			    @endforeach
			    {!! $connectionsPosts->render() !!}
			@endif
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
	<script src="https://cdn.jsdelivr.net/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>

	<!-- Algolia Search -->

	<script>
		(function() {

			this.client = algoliasearch("IZ6RJN0FW4", '704e5e538cbcf83537940f36e1bef1a7');
			this.index = this.client.initIndex('users_local');

			$('#main-search-input').typeahead({ hint: false, minLength: 2 }, {
				source: this.index.ttAdapter(),
				displayKey: 'username',
				templates: {
					empty: function() {
						return 	'<div class="main-search-no-results">'+
								'<h4>This streamer is not registered</h4>'+
								'<p>Instead, you can quickly create a <span class="no-results-popup" data-toggle="tooltip" data-placement="top" title="A fan page is a basic page of information for a streamer that any registered user can add to. That streamer can register for Yeayur and turn the fan page into a full profile page.">fan page</span> for this streamer. <a href="#" class="no-results-fan-page-link"><i class="fa fa-hand-o-right" aria-hidden="true"></i></a></p>'
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
			$('#main-search-input').bind('typeahead:render', function(ev, suggestion) {
			  $('[data-toggle="tooltip"]').tooltip();
			});

			/*Take value from Typeahead input and update search input*/
			var myVal = $('.typeahead').typeahead('val');
			$('#main-search-input').val(myVal);

		})();
	
	</script>

	<script>

	/*Activate reponse modal*/

	$('.request-streamer-respond-btn').click(function(){
		var requestorName = $(this).siblings('.streamer-post-id').find('.streamer-post-name').text();
		$('#request-streamer-respnse-modal').find('.modal-title').text("Respond to "+requestorName);
		$('#request-streamer-respnse-modal').modal('toggle');
	});

		//===================================================
		//		TWITTER EMOJI PLUGIN
		//===================================================
		
		

		twemoji.parse(document.body, {
		    folder: 'svg',
		    ext: '.svg',
		    callback: function(icon, options, variant) {
		        switch ( icon ) {
		            case 'a9':      // © copyright
		            case 'ae':      // ® registered trademark
		            case '2122':    // ™ trademark
		                return false;
		        }
		        return ''.concat(options.base, options.size, '/', icon, options.ext);
		    }
		});
		  

	</script>


@stop