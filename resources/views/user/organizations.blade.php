@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="nav nav-pills" id="organization-nav">
                <li><a href="{{ url('/users/' . $user->id)  }}">Profile</a></li>
                <li class="active"><a href="{{ url('/users/' . $user->id . '/organizations')  }}">Organizations</a></li>
                <li><a href="#">Follower <span class="badge">3</span></a></li>
                <li><a href="#">Following <span class="badge">6</span></a></li>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0;">Organizations</h3>
                </div>
            </div>
            <hr style="margin-top: 12px;">
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="user-profile-pic">
                        <img src="/images/default.png" class="img-responsive img-rounded" alt="Image">
                    </div>
                    <p style="margin-top: 5px; margin-bottom: 0; font-size: 24px; text-transform: capitalize;">{{ $user->name  }}</p>
                    <p><i class="fa fa-envelope"></i> {{ $user->email  }}</p>
                    <p><i class="fa fa-clock-o"></i> Joined on {{  $user->created_at->toFormattedDateString() }}</p>
                    <a href="#" class="btn btn-default btn-block" style="margin-top: 10px;"><i class="fa fa-user-plus"></i> Follow</a>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form action="" method="POST" class="form-inline" role="form">
                            	<div class="form-group">
                            		<input type="email" class="form-control" name="" id="" placeholder="Filter by name">
                            	</div>
                            	<button type="submit" class="btn btn-default">Search</button>
                            </form>
                            <hr style="margin-bottom: 0px;">
                            <div class="activity">
                                <ul class="list-group">
                                    @foreach($organizations as $organization)
                                        <li class="list-group-item" style="border-color: #eee;; margin-bottom: 0px; border-top: none; border-radius: 0; border-left: 0; border-right: 0;">
                                            <div class="row">
                                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <a href="{{ url('/organizations/' . $organization->id)  }}" class="text-left" style="color: #2b2b2b; font-weight: 600; font-size: 17px;">{{ $organization->name  }}</a>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                                    <ul class="list-unstyled list-inline">
                                                        <li>
                                                            <i class="fa fa-book"></i> {{ $organization->total_wikis  }}
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-users"></i> {{ $organization->total_members }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            {{ $organizations->links()  }}
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
