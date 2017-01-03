@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row" style="margin-top: 170px;">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-offset-3">
				<div class="section text-center">
					<h1 style="font-weight: 600;">Wiki</h1>
					<p style="font-size: 16px;">A centralized place for your company to document who you are, what you do, and how to achieve results.</p>
					<div style="margin-top: 20px;">
						<div class="list-unstyled list-inline">
							<li>
								<a href="#" class="btn btn-success" style="padding-top: 10px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px; font-size: 16px;">Join an existing organization</a>
							</li>
							<li>
								<a href="{{ route('organizations.create', [1]) }}" class="btn btn-default" style="padding-top: 10px; padding-bottom: 10px; padding-left: 20px; padding-right: 20px; font-size: 16px;">Create a organization</a>
							</li>
						</div>
						<p style="margin-top: 5px; font-size: 16px;">Already joined a organization? <a href="{{ route('organizations.signin', [1]) }}">sign in</a></p>
					</div>
				</div>		
			</div>
		</div>
	</div>
@endsection