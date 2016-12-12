<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    <div class="affix" style="overflow: auto; height: 81%; min-width: 270px;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left">
                    <img src="/images/no_organization_avatar.png" width="42" height="42" alt="Image" style="border-radius: 4px; margin-right: 10px;">
                </div>
                <div class="pull-left">
                    <h3 style="text-transform: capitalize; margin: 0;" title="{{ $organization->name }}">{{ $organization->name }}</h3>
                    <p><i class="fa fa-clock-o"></i> Joined on {{ $organization->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString()  }}</p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-default settings">
            <div class="panel-heading">Discover</div>
            <ul class="list-unstyled" style="margin-bottom: 0;">
                <li>
                    <a href="#">All activities</a>
                </li>
                <li>
                    <a href="#">My activities</a>
                </li>
                <li>
                    <a href="#">Saved for Later</a>
                </li>
            </ul>
        </div>
        <div class="panel panel-default settings">
            <div class="panel-heading">Wikis</div>
            <ul class="list-unstyled" style="margin-bottom: 0;">
                <?php $i = 0; ?>
                @foreach($wikis as $wiki)
                    @if($i >= 5) 
                        <?php break; ?>
                    @endif
                    <li>
                        <a href="#">{{ $wiki->name }}</a>
                    </li>
                    <?php $i++; ?>
                @endforeach
            </ul>
        </div>
                <!-- @if(\App\Helpers\ViewHelper::userHasOrganization($organization->slug))
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
                @endif -->
    </div>
</div>