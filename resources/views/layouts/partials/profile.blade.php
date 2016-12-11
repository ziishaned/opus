<div class="row user-profile">
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <div class="user-profile-pic">
            @if(empty($user->profile_image))
                <img src="/images/default.png" class="pull-left" width="95" height="95" alt="Image" style="border-radius: 4px;">
            @else
                <img src="/images/profile-pics/{{ $user->profile_image }}" class="pull-left" width="95" height="95" alt="Image" style="border-radius: 4px;">
            @endif
        </div>
        <div class="pull-left" style="margin-left: 15px;">
            @if(!empty($user->full_name))
                <h3 style="text-transform: capitalize;" title="{{ $user->full_name }}">{{ $user->full_name }}</h3>
            @endif
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
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
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
</div>