@extends('layouts.app')

@section('content')
	<section>
		<div class="container">
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div class="col3 affix-top" data-spy="affix" data-offset-top="10">
						@if(empty($user->profile_image))
						    <img src="/images/default.png" class="img-rounded" width="195" height="195" alt="Image">
						@else
						    <img src="/images/profile-pics/{{ $user->profile_image }}" class="img-rounded" width="195" height="195" alt="Image">
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
					<div class="activity-head affix-top collg5" data-spy="affix" data-offset-top="10">
                        <h2 class="mt0">All Updates</h2>
                        <hr class="m0">
                    </div>
					@include('layouts.partials.activity')
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">	
					<div class="col4 affix-top" data-spy="affix" data-offset-top="10">
						<div class="panel panel-default">
	                        <div class="panel-heading"><i class="fa fa-star-o"></i> Favourite wikis</div>
	                        <div class="panel-body">
	                            <ul class="list-unstyled marginless">
	                                <li class="text-center">Fovourite list is empty...</li>
	                            </ul>
	                        </div>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
