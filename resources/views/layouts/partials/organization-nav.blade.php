<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills" id="organization-nav">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{id}') class="active" @endif><a href="{{ route('organizations.show', $organization->id) }}">Activity</a></li>
            @if(\App\Helpers\ViewHelper::userHasOrganization($organization->id))
                <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{id}/wikis') class="active" @endif><a href="{{ route('organizations.wikis.show', $organization->id) }}">Wikis <span class="badge">{{ $organization->wikis->count() }}</span></a></li>
            @endif
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{id}/members') class="active" @endif><a href="{{ route('organizations.members', $organization->id) }}">Members <span class="badge">{{ $organization->members->count() }}</span></a></li>
            @if(\App\Helpers\ViewHelper::userHasOrganization($organization->id))
                <li><a href="{{ route('organizations.wiki.create', $organization->id) }}">Create Wiki</a></li>
            @endif
        </ul>
    </div>
</div>