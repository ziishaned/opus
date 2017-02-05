@extends('layouts.app')

@section('content')
	<section class="marginless">
        <div class="container">
            <div class="v-center" style="min-height: 85vh;">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-4 text-center">
                        <h1 class="marginless" style="margin-bottom: 20px; font-size: 38px; font-weight: 600;">Opus. <span style="font-weight: 300;">A place for teams</span></h1>
                        <div class="btn-group section-body">
                            <p style="font-size: 15px; line-height: 25.5px; margin-bottom: 25px;">Opus is a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
                            <ul class="list-unstyled list-inline">
                                <li>
                                    <a href="{{ route('organizations.join') }}" class="btn btn-primary">Join existing organization</a>
                                </li>
                                <li>
                                    <a href="{{ route('organizations.create') }}" class="btn btn-default">Create organization</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
@endsection