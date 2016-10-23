@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <h3 style="margin: 0; margin-bottom: 10px;">Activity</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <div class="form-group" style="margin: 0;">
                    <select id="organization-input" name="organization_id" placeholder="Select Organization..">
                        <option value="all" selected="selected">All</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <button type="button" class="btn btn-default">Go</button>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="padding-left: 0px;">
                <h4 style="margin: 0px;"><a href="#">John Doe</a></h4>
                <div class="activity">
                    <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-text-o"></i> <a href="#">What is our motive.</a></p>
                    <p style="padding-left: 17px; margin-bottom: 0;">Updated 3 hours ago</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <img src="/images/default.png" style="width: 100px;" class="img-responsive" alt="Image">
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" style="padding-left: 0px;">
                <h4 style="margin: 0px;"><a href="#">John Doe</a></h4>
                <div class="activity">
                    <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> <a href="#">Screenshot-08-10-201.png</a></p>
                    <p style="padding-left: 17px; margin-bottom: 0;">Attached today at 3:45 PM</p>
                </div>
                <div class="activity">
                    <p style="margin-top: 5px; margin-bottom: 0;"><i class="fa fa-file-image-o"></i> <a href="#">Screenshot-08-10-201.png</a></p>
                    <p style="padding-left: 17px;">Attached today at 3:45 PM</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <h3 class="panel-title">Personal Wikis</h3>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-right">
                        <a href="{{ route('users.wikis', Auth::user()->id) }}">All</a>
                    </div>
                </div>
            </div>
            <div class="list-group">
                @if($wikis->count() > 0)
                    @foreach($wikis as $wiki)
                        <a href="{{ route('wikis.show', $wiki->slug) }}" class="list-group-item">{{ $wiki->name }} <span class="badge"><i class="fa fa-star"></i> {{ $wiki->total_star }}</span></a>
                    @endforeach
                @else 
                    <li class="list-group-item" style="text-align: center;">Nothing found</li>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
