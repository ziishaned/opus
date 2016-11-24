<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills" id="organization-nav" style="display: flex; justify-content: center;">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}') class="active" @endif><a href="{{ route('organizations.show', $organization->slug) }}">Organization</a></li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'organizations/{organization_slug}/members') class="active" @endif><a href="{{ route('organizations.members', $organization->slug) }}">Members</a></li>
            @if(\App\Helpers\ViewHelper::userHasOrganization($organization->slug))
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="manage-wiki-dropdown" style="color: #333;"><i class="fa fa-gear fa-lg"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu2" style="top: 37px; right: 10px;">
                        <li><a href="{{ route('organizations.wiki.create', $organization->slug) }}"><i class="fa fa-plus-square"></i> Create Wiki</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-organization').submit();"><i class="fa fa-trash-o"></i> Delete</a>
                            <form id="delete-organization" action="{{ route('organizations.destroy', $organization->id)  }}" method="POST" style="display: none;">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>