@extends(Config::get('chatter.master_file_extend'))

@section(Config::get('chatter.yields.head'))
    <link href="{{ url('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css') }}" rel="stylesheet">
	<link href="{{ url('/vendor/devdojo/chatter/assets/css/chatter.css') }}" rel="stylesheet">
	@if($chatter_editor == 'simplemde')
		<link href="{{ url('/vendor/devdojo/chatter/assets/css/simplemde.min.css') }}" rel="stylesheet">
	@elseif($chatter_editor == 'trumbowyg')
		<link href="{{ url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/ui/trumbowyg.css') }}" rel="stylesheet">
		<style>
			.trumbowyg-box, .trumbowyg-editor {
				margin: 0px auto;
			}
		</style>
	@endif
@stop

@section('content')
<div id="chatter" class="chatter_home">
<div class="page-wrapper fixed-footer">
    <!--Breadcrumb section starts-->
    <div class="breadcrumb-section" style="background-image: url(/img/breadcrumb.png)">
        <?php $headline_logo = Config::get('chatter.headline_logo'); ?>
        @if( isset( $headline_logo ) && !empty( $headline_logo ) )
            <img src="{{ Config::get('chatter.headline_logo') }}">
        @endif
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row align-items-center  pad-top-80">
                <div class="col-md-6 col-12">
                    <div class="breadcrumb-menu">
                        <h2 class="page-title">@lang('chatter::intro.headline')</h2>
                        <p>@lang('chatter::intro.description')</p>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="breadcrumb-menu text-right sm-left">
                        <ul>
                            <li class="active"><a href="{{ route('start') }}">Home</a></li>
                            <li><a href="#">Forum</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section ends-->

	@if(config('chatter.errors'))
		@if(Session::has('chatter_alert'))
			<div class="chatter-alert alert alert-{{ Session::get('chatter_alert_type') }}">
				<div class="container">
					<strong><i class="chatter-alert-{{ Session::get('chatter_alert_type') }}"></i> {{ Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type')) }}</strong>
					{{ Session::get('chatter_alert') }}
					<i class="chatter-close"></i>
				</div>
			</div>
			<div class="chatter-alert-spacer"></div>
		@endif

		@if (count($errors) > 0)
			<div class="chatter-alert alert alert-danger">
				<div class="container">
					<p><strong><i class="chatter-alert-danger"></i> @lang('chatter::alert.danger.title')</strong> @lang('chatter::alert.danger.reason.errors')</p>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
    @endif

    <!--Blog section starts-->
    <div class="blog-area section-padding pad-bot-40 mar-top-20">
        <div class="container">
            <div class="row">
            <!-- left Sidebar starts-->
                <div class="col-xl-3 col-md-12 sidebar">
					<div class="chatter_sidebar">
						<div class="widget search">
							<form>
								<input type="text" class="form-control" placeholder="Search">
								<button type="submit" class="search-button"><i class="ion-ios-search"></i></button>
							</form>
						</div>
						
							<button class="btn btn-primary" id="new_discussion_btn"><i class="chatter-new"></i> @lang('chatter::messages.discussion.new')</button>
							{{--<a href="/{{ Config::get('chatter.routes.home') }}"><i class="chatter-bubble"></i> @lang('chatter::messages.discussion.all')</a>--}}

						<div class="widget categories">
							<h3 class="widget-title">Categories</h3>
							<ul class="icon">
								{!! $categoriesMenu !!}
							</ul>
						</div>
						<div class="widget recent-posts">
							<h3 class="widget-title">Recent Posts</h3>
								<ul class="post-list">
									<li class="row mar-top-30">
										<div class="col-lg-5 col-4">
											<div class="entry-img">
												<img src="images/blog/blog-thumb-1.jpg" alt="...">
											</div>
										</div>
										<div class="col-lg-7 col-8">
											<div class="entry-text">
												<h4 class="entry-title"><a href="single-news-one.html">Best caffe in London </a></h4>
												<span class="entry-date">Aug 16th, 2017</span>
											</div>
										</div>
									</li>
									<li class="row mar-top-30">
										<div class="col-lg-5 col-4">
											<div class="entry-img">
												<img src="images/blog/blog-thumb-2.jpg" alt="...">
											</div>
										</div>
										<div class="col-lg-7  col-8">
											<div class="entry-text">
												<h4 class="entry-title"><a href="single-news-one.html">3 Ways to style city street</a></h4>
												<span class="entry-date">Oct 12th, 2017</span>
											</div>
										</div>
									</li>
									<li class="row mar-top-30">
										<div class="col-lg-5  col-4">
											<div class="entry-img">
												<img src="images/blog/blog-thumb-3.jpg" alt="...">
											</div>
										</div>
										<div class="col-lg-7  col-8">
											<div class="entry-text">
												<h4 class="entry-title"><a href="single-news-one.html">Best Cheap Hotel in London</a></h4>
												<span class="entry-date">Sep 25th, 2017</span>
											</div>
										</div>
									</li>
								</ul>
						</div>
							<!-- Tags -->
							<div class="widget">
								<h3 class="widget-title">Tags</h3>
								<ul class="list-tags">
									<li><a href="#" class="btn v6 dark">Hotel</a></li>
									<li><a href="#" class="btn v6 dark">Travel</a></li>
									<li><a href="#" class="btn v6 dark">Living</a></li>
									<li><a href="#" class="btn v6 dark">Eat &amp; Drink</a></li>
									<li><a href="#" class="btn v6 dark">Luxury</a></li>
									<li><a href="#" class="btn v6 dark">Food</a></li>
									<li><a href="#" class="btn v6 dark">Restaurant</a></li>
								</ul>
							</div>
					</div>
				</div>
                <!-- left Sidebar ends -->
                <div class="col-md-9 right-column">
                    <div class="panel">
                        <ul class="discussions">
                            @foreach($discussions as $discussion)
                                <li>
                                    <a class="discussion_list" href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                                        <div class="chatter_avatar">
                                            @if(Config::get('chatter.user.avatar_image_database_field'))

                                                <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                                                <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                                @if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') )
                                                    <img src="{{ $discussion->user->{$db_field}  }}">
                                                @else
                                                    <img src="{{ Config::get('chatter.user.relative_url_to_image_assets') . $discussion->user->{$db_field}  }}">
                                                @endif

                                            @else

                                                <span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}) ?>">
                                                    {{ strtoupper(substr($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}, 0, 1)) }}
                                                </span>

                                            @endif
                                        </div>

                                        <div class="chatter_middle">
                                            <h3 class="chatter_middle_title">{{ $discussion->title }} <div class="chatter_cat" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</div></h3>
                                            <span class="chatter_middle_details">@lang('chatter::messages.discussion.posted_by') <span data-href="/user">{{ ucfirst($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}) }}</span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}</span>
                                            @if($discussion->post[0]->markdown)
                                                <?php $discussion_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $discussion->post[0]->body ); ?>
                                            @else
                                                <?php $discussion_body = $discussion->post[0]->body; ?>
                                            @endif
                                            <p>{{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif</p>
                                        </div>

                                        <div class="chatter_right">

                                            <div class="chatter_count"><i class="chatter-bubble"></i> {{ $discussion->postsCount[0]->total }}</div>
                                        </div>

                                        <div class="chatter_clear"></div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="page-num text-center">
						<div id="pagination">
							{{ $discussions->links() }}
						</div>
					</div>
                </div>
            </div>
        </div>
	</div>
	
    <div id="chatter" class="chatter_home">
    <div id="new_discussion">

    	<div class="chatter_loader dark" id="new_discussion_loader">
		    <div></div>
		</div>

    	<form id="chatter_form_editor" action="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}" method="POST">
        	<div class="row">
	        	<div class="col-md-7">
		        	<!-- TITLE -->
	                <input type="text" class="form-control" id="title" name="title" placeholder="@lang('chatter::messages.editor.title')" value="{{ old('title') }}" >
	            </div>

	            <div class="col-md-4">
		            <!-- CATEGORY -->
					<select id="chatter_category_id" class="form-control" name="chatter_category_id">
						<option value="">@lang('chatter::messages.editor.select')</option>
						@foreach($categories as $category)
							@if(old('chatter_category_id') == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@elseif(!empty($current_category_id) && $current_category_id == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@else
								<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endif
						@endforeach
					</select>
		        </div>

		        <div class="col-md-1">
		        	<i class="chatter-close"></i>
		        </div>
	        </div><!-- .row -->

            <!-- BODY -->
        	<div id="editor">
        		@if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
					<label id="tinymce_placeholder">@lang('chatter::messages.editor.tinymce_placeholder')</label>
    				<textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
    			@elseif($chatter_editor == 'simplemde')
    				<textarea id="simplemde" name="body" placeholder="">{{ old('body') }}</textarea>
				@elseif($chatter_editor == 'trumbowyg')
					<textarea class="trumbowyg" name="body" placeholder="@lang('chatter::messages.editor.tinymce_placeholder')">{{ old('body') }}</textarea>
				@endif
    		</div>

            <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

            <div id="new_discussion_footer">
            	<input type='text' id="color" name="color" /><span class="select_color_text">@lang('chatter::messages.editor.select_color_text')</span>
            	<button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> @lang('chatter::messages.discussion.create')</button>
            	<a href="/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">@lang('chatter::messages.words.cancel')</a>
            	<div style="clear:both"></div>
            </div>
        </form>
    </div>
</div>
</div>

<!-- #new_discussion -->
    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
        <input type="hidden" id="chatter_tinymce_toolbar" value="{{ Config::get('chatter.tinymce.toolbar') }}">
        <input type="hidden" id="chatter_tinymce_plugins" value="{{ Config::get('chatter.tinymce.plugins') }}">
    @endif
    <input type="hidden" id="current_path" value="{{ Request::path() }}">

    @endsection

    @section(Config::get('chatter.yields.footer'))


    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
        <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/tinymce.js') }}"></script>
        <script>
            var my_tinymce = tinyMCE;
            $('document').ready(function(){
                $('#tinymce_placeholder').click(function(){
                    my_tinymce.activeEditor.focus();
                });
            });
        </script>
    @elseif($chatter_editor == 'simplemde')
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/simplemde.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/chatter_simplemde.js') }}"></script>
    @elseif($chatter_editor == 'trumbowyg')
        <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/trumbowyg.js') }}"></script>
    @endif

    <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js') }}"></script>
    <script src="{{ url('/vendor/devdojo/chatter/assets/js/chatter.js') }}"></script>
    <script>
        $('document').ready(function(){

            $('.chatter-close, #cancel_discussion').click(function(){
                $('#new_discussion').slideUp();
            });
            $('#new_discussion_btn').click(function(){
                @if(Auth::guest())
                    window.location.href = "{{ route('login') }}";
                @else
                    $('#new_discussion').slideDown();
                    $('#title').focus();
                @endif
            });

            $("#color").spectrum({
                color: "#333639",
                preferredFormat: "hex",
                containerClassName: 'chatter-color-picker',
                cancelText: '',
                chooseText: 'close',
                move: function(color) {
                    $("#color").val(color.toHexString());
                }
            });

            @if (count($errors) > 0)
                $('#new_discussion').slideDown();
                $('#title').focus();
            @endif
        });
    </script>
    @stop
</div>
