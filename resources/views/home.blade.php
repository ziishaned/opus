@extends('layouts.app')

@section('content')
	<section class="marginless">		
		<div class="fullheight vertical-center">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-md-offset-3 col-lg-6 col-lg-offset-3">
						<section class="text-center">
							<h1 class="marginless">Wiki</h1>
							<div class="btn-group section-body">
								<p>A centralized place for your company to document who you are, what you do, and how to achieve results.</p>
								<ul class="list-unstyled list-inline">
									<li>
										<a href="{{ route('organizations.join') }}" class="btn btn-primary">Join an existing organization</a>
									</li>
									<li>
										<a href="{{ route('organizations.create') }}" class="btn btn-default">Create a organization</a>
									</li>
								</ul>
							</div>
							<p>Already joined a organization? <a href="{{ route('organizations.login') }}">Login</a></p>
						</section>		
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection