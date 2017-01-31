<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
		<ul class="cus-nav cus-nav-right list-unstyled list-inline">
			<li><a href="{{ route('pages.edit', [$organization->slug, $category->slug, $wiki->slug, $page->slug]) }}"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
			<li><a href="#"><i class="fa fa-check-square-o fa-fw"></i> Add to read list</a></li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown-menu dropdown-menu-right marginless">  
                    <li><a href="#"><i class="fa fa-info fa-fw"></i> Overview</a></li>
                    <li><a href="#"><i class="fa fa-history fa-fw"></i> Page history</a></li>
                    <li><a href="#"><i class="fa fa-html5 fa-fw"></i> Page source</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Export to PDF</a></li>
                    <li><a href="#"><i class="fa fa-file-word-o fa-fw"></i> Export to Word Document</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-page').submit();}"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                        <form id="delete-page" action="{{ route('pages.destroy', [$organization->slug, $category->slug, $wiki->slug, $page->slug]) }}" method="POST" style="display: none;">
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </li>
                </ul>
            </li>
		</ul>
	</div>
</div>