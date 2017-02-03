@extends('layouts.app')

@section('content')
	<section>
		<div class="container">
			<div class="row v-center mb20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
					<h2 class="marginless mb5">Read List</h2>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore ab minima repellat eligendi ut adipisci! Lorem ipsum dolor sit amet</p>		
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
					<div class="tabs-vertical" style="margin-top: 43px">
						<ul class="list-unstyled">
							<li>
								<a href="#"><i class="fa fa-list-alt fa-fw"></i> <span class="ml10">Reat list</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-trash-o fa-fw"></i> <span class="ml10">Trash</span></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-10 col-lg-10">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="list-actions">
								<div class="row">
									<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
										<ul class="cus-nav list-unstyled list-inline">
											<li class="dropdown">
								                <a href="#" class="dropdown-toggle" data-toggle="dropdown">All <i class="fa fa-caret-down fa-fw"></i></a>
								                <ul class="dropdown-menu dropdown-menu-left marginless">	
								                    <li><a href="#">All</a></li>
								                    <li><a href="#">Read</a></li>
								                    <li><a href="#">Unread</a></li>
								                </ul>
								            </li>
											<li><a href="#"><i class="fa fa-refresh fa-fw"></i> Refresh</a></li>
											<li>
												<a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
											</li>
											<li>
												<a href="#"><i class="fa fa-info-circle fa-fw"></i> Details</a>
											</li>
											<li class="dropdown">
								                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <i class="fa fa-caret-down fa-fw"></i></a>
								                <ul class="dropdown-menu dropdown-menu-left marginless">	
								                    <li><a href="#">Mark as read</a></li>
								                    <li><a href="#">Mark as unread</a></li>
								                </ul>
								            </li>
										</ul>	
									</div>
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
										<form method="get">
					                        <div class="form-group mb0">
					                            <input type="text" class="form-control input input-sm" placeholder="Filter by name">
					                            <span class="fa fa-search fa-fw text-muted" style="position: absolute; top: 8px; right: 23px;"></span>
					                        </div>
					                    </form>
									</div>
								</div>
							</div>		
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="list-group readlist-con">
								<a href="#" class="list-group-item readlist-item">
									<div class="row">
										<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
											<label class="marginless">
												<input type="checkbox" value="" class="marginless">
											</label>
											<span class="ml15">Consectetur labore neque</span>
										</div>
										<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
											<p class="marginless text-muted readlist-item-time"><i class="fa fa-clock-o fa-fw"></i> 3 minutes ago</p>	
										</div>
									</div>
								</a>
							</div>		
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>
@endsection