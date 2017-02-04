@extends('layouts.app')

@section('content')
	<section class="marginless">
        <div class="container">
            <div class="v-center" style="min-height: 85vh;">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                        <div style="border-radius: 4px; overflow: hidden; border: 1px solid rgba(0,0,0,.15); -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175); box-shadow: 0 6px 12px rgba(0,0,0,.175);">
                            <img src="/images/app.png" alt="" width="652">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 text-center">
                        <div style="margin-top: 65px;">
                            <h1 class="marginless" style="margin-bottom: 20px; font-size: 38px;">Opus. <span style="font-weight: 300;">A place for teams</span></h1>
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
        </div>
	</section>
@endsection