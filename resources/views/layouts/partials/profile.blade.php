<div class="row user-profile">
    {{-- <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
    </div> --}}
    <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10">
        <div class="user-profile-pic">
            @if(empty($user->profile_image))
                <img src="/images/default.png" class="img-rounded pull-left" width="120" height="120" alt="Image">
            @else
                <img src="/images/profile-pics/{{ $user->profile_image }}" class="img-rounded pull-left" width="120" height="120" alt="Image">
            @endif
        </div>
        <div class="pull-left" style="margin-left: 15px;">
            @if(!empty($user->full_name))
                <h3 style="text-transform: capitalize;" title="{{ $user->full_name }}">{{ $user->full_name }}</h3>
            @endif
            <p style="cursor: default; display: inline-block;" data-toggle="tooltip" data-placement="top" title="{{ $user->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $user->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}"><i class="fa fa-clock-o"></i> Member since {{  $user->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }}</p>    
            <p>
                <span class="@if(!empty($user->location)) dot-divider @endif">
                    <i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email  }}">{{ $user->email  }}</a>
                </span> 
                @if(!empty($user->location))
                    <span><i class="fa fa-map-marker"></i> {{ $user->location }}</span>
                @endif
            </p>
            @if(!empty($user->bio))
                <p>{{ $user->bio }}</p>
            @endif
            @if($user->id != Auth::user()->id)
                <div class="profile-btn">
                    <ul class="list-unstyled list-inline">
                        <li style="padding: 0;">
                            @if(ViewHelper::isFollowing($user->id)) 
                                <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Unfollow" onclick="event.preventDefault(); document.getElementById('unfollow-form').submit();"><i class="fa fa-minus"></i></a>
                                <form id="unfollow-form" action="{{ route('users.unfollow') }}" method="POST" class="hide">
                                    {!! method_field('post') !!}
                                    {{ csrf_field() }}
                                    <input type="text" name="user_id" class="hide" value="{{ $user->id }}">
                                </form>
                            @else 
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Follow" onclick="event.preventDefault(); document.getElementById('follow-form').submit();"><i class="fa fa-plus"></i></a>
                                <form id="follow-form" action="{{ route('users.follow') }}" method="POST" class="hide">
                                    {!! method_field('post') !!}
                                    {{ csrf_field() }}
                                    <input type="text" name="user_id" class="hide" value="{{ $user->id }}">
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>    
            @endif
            @if($user->organizations->count() > 0)
                <ul class="list-unstyled list-inline" style="width: 260px; margin: auto; line-height: 3.5em;">
                    @foreach($user->organizations as $organization)
                        <li class="list-group-item" style="padding: 0px; border: none;" data-toggle="tooltip" data-placement="bottom" title="{{ $organization->name }}">
                            <a href="{{ route('organizations.show', $organization->slug)  }}">
                                <img src="/images/no_organization_avatar.png" width="40" height="40" alt="Image" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 3px;">
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>  
</div>