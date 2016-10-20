@extends('layouts.app')

@section('content')
    @include('layouts.partials.organization-nav')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <h3 style="margin: 0;">Members</h3>
                </div>
            </div>
            <hr style="margin-top: 12px;">
            <div class="row" style="margin-top: 20px;">
                @foreach($members as $member)
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="member-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <a href="{{ url('/users/' . $member-> member_id) }}"><img src="/images/default.png" style="width: 70px;" alt="Image"></a>
                            </div>
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left: 0px;">
                                <h4 style="margin: 0px 0px 5px;"><a href="{{ url('/users/' . $member-> member_id) }}">{{ $member->member_name }}</a></h4>
                                <p class="text-muted"><a href="{{ url('/users/' . $member-> member_id) }}">{{ $member->member_email  }}</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row text-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    {{ $members->links()  }}
                </div>
            </div>
        </div>
    </div>
@endsection
