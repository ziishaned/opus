<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills" id="organization-nav" style="display: flex; justify-content: center;">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/profile') class="active" @endif>
                <a href="{{ route('settings.profile') }}">Profile</a>
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/account') class="active" @endif>
                <a href="{{ route('settings.account') }}">Account</a>
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/emails') class="active" @endif>
                <a href="#">Emails</a>
            </li>
            <li>
                <a href="#">Notifications</a>
            </li>   
        </ul>
    </div>
</div>