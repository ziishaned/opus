@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <h3 style="margin: 0; margin-bottom: 10px;">Activity</h3>
                <select name="name" id="inputID" class="form-control">
                    <option value="" selected> All </option>
                    @foreach($user->organizations as $organization)
                        <option value="{{ $organization->id  }}">{{ $organization->name }} </option>
                    @endforeach
                </select>
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
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Personal Wikis</h3>
            </div>
            <div class="list-group">
                @foreach($wikis as $wiki)
                    <a href="{{ $wiki->id }}" class="list-group-item">{{ $wiki->name }} <span class="badge"><i class="fa fa-star"></i> {{ $wiki->total_star }}</span></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
