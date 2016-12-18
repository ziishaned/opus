<div class="row user-profile">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border-right: 1px solid #eeeeee;">
        <div class="user-profile-pic">
            @if(empty($user->profile_image))
                <img src="/images/default.png" class="pull-left" width="95" height="95" alt="Image" style="border-radius: 4px;">
            @else
                <img src="/images/profile-pics/{{ $user->profile_image }}" class="pull-left" width="95" height="95" alt="Image" style="border-radius: 4px;">
            @endif
        </div>
        <div class="pull-left" style="margin-left: 15px;">
            @if($user->first_name || $user->last_name)
                <h3 title="{{ $user->first_name . ' ' . $user->last_name  }}">{{ $user->first_name . ' ' . $user->last_name  }}</h3>
            @endif
            <p>
                <i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email  }}">{{ $user->email  }}</a>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
    </div>
</div>