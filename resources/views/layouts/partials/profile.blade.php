<div class="row user-profile hidden-md hidden-lg">
    <div class="col-xs-12 col-sm-12">
        <div style="border-bottom: 1px solid #ccc; padding-bottom: 20px; margin-bottom: 10px;">
            <div style="width: 195px;" class="center-block">
                <div class="user-profile-pic">
                    @if(empty($user->profile_image))
                        <img style="border: 1px solid rgba(248, 248, 248, 0.8); border-radius: 50%;" src="/images/default.png" class="img-rounded" width="195" height="195" alt="Image">
                    @else
                        <img style="border-radius: 50%; border: 1px solid rgba(248, 248, 248, 0.8);" src="/images/profile-pics/{{ $user->profile_image }}" class="img-rounded" width="195" height="195" alt="Image">
                    @endif
                </div>        
                <div style="margin-top: 10px; text-align: center;">
                    @if($user->first_name || $user->last_name)
                        <h3 title="{{ $user->first_name . ' ' . $user->last_name  }}">{{ $user->first_name . ' ' . $user->last_name  }}</h3>
                    @endif
                    <p>
                        <i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email  }}">{{ $user->email  }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row user-profile hidden-xs hidden-sm">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="user-profile-pic" style="margin-bottom: 20px;">
            @if(empty($user->profile_image))
                <img src="/images/default.png" class="img-rounded" width="195" height="195" alt="Image">
            @else
                <img src="/images/profile-pics/{{ $user->profile_image }}" class="img-rounded" width="195" height="195" alt="Image">
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @if($user->first_name || $user->last_name)
            <h3 title="{{ $user->first_name . ' ' . $user->last_name  }}">{{ $user->first_name . ' ' . $user->last_name  }}</h3>
        @endif
        <p>
            <i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email  }}">{{ $user->email  }}</a>
        </p>
    </div>
    {{-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3>Organization</h3>
        <ul class="list-unstyled">
            <li>
                <tt>Position:</tt>
                <td></td>
            </li>
            <li>
                <tt>Department:</tt>
                <td></td>
            </li>
            <li>
                <tt>Location:</tt>
                <td></td>
            </li>
        </ul>
    </div> --}}
</div>