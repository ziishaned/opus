@extends('layouts.app')

@section('content')
    @include('layouts.partials.organization-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0;">Wikis</h3>
                </div>
            </div>
            <hr style="margin-top: 12px;">
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @if($organization->wikis->count() > 0)
                        <div class="list-group">
                            @foreach($organization->wikis as $wiki)
                                <a href="#" class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <p style="margin: 0; font-weight: 500;">{{ $wiki->name }}</p>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                            <ul class="list-unstyled list-inline" style="margin: 0;">
                                                <li><i class="fa fa-user"></i> Created by <strong>{{ \App\Helpers\ViewHelper::getUsername($wiki->user_id) }}</strong></li>
                                                <li><i class="fa fa-clock-o"></i> {{  $wiki->created_at->toFormattedDateString() }}</li>
                                            </ul>    
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else 
                        <ul class="list-group">
                            <li class="list-group-item" style="font-size: 17px; font-weight: 600; color: #777777; box-shadow: inset 0 0 10px rgba(0,0,0,0.05); background-color: #ffffff; text-align: center;">Nothing found</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
