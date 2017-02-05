@extends('layouts.app')

@section('content')
	<section>
		<div class="container">
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div data-spy="affix" data-offset-top="10">
						@if(empty($user->profile_image))
						    <img src="{!! new Avatar($user->first_name .' '. $user->last_name, 'square', 194) !!}" class="media-object img-rounded" alt="">
						@else
						    <img src="/images/profile-pics/{{ $user->profile_image }}" class="img-rounded" width="194" height="194" alt="Image">
						@endif
						@if($user->first_name || $user->last_name)
						    <h3 title="{{ $user->first_name . ' ' . $user->last_name  }}">{{ $user->first_name . ' ' . $user->last_name  }}</h3>
						@endif
						<p>
						    <i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email  }}">{{ $user->email  }}</a>
						</p>
					</div>
				</div>
			    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
					<div style="min-height: 38px;">
                        <div class="index-head affix-top" data-spy="affix" data-offset-top="10" style="background-color: rgb(255, 255, 255); z-index: 10; width: 458px;">
                            <h4 class="marginless"><i class="fa fa-feed fa-fw"></i> All updates</h4>
                        </div>
                    </div>
					@include('layouts.partials.activity')
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">	
					<div data-spy="affix" data-offset-top="10">
						<div class="tabs-vertical">
                            <div class="index-head">
                                <h4 class="marginless"><i class="fa fa-star-o fa-fw"></i> Favourite wikis</h4>
                            </div>
                            <div class="index-body">
                                <p class="text-muted text-center">Fovourite list is empty...</p>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
