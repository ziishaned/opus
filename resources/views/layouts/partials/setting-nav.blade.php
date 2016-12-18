<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <div class="settings">
        <ul class="list-unstyled">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/profile') class="active" @endif>
                <a href="{{ route('settings.profile', [$organization->slug, ]) }}">Profile</a>            
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/account') class="active" @endif>
                <a href="{{ route('settings.account', [$organization->slug, ]) }}">Account</a>        
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/emails') class="active" @endif>
                <a href="{{ route('settings.emails', [$organization->slug, ]) }}">Email</a>            
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/settings/notifications') class="active" @endif>
                <a href="{{ route('settings.notifications', [$organization->slug, ]) }}">Notifications</a>            
            </li>
        </ul>
    </div>
</div>