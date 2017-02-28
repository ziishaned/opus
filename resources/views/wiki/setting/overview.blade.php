@extends('layouts.master')

@section('content')
	@include('wiki.partials.menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wiki-setting">
					<div class="wiki-setting-header">
					  	Wiki Settings
					</div>
					<div role="tabpanel">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="wiki-overview.html">General</a>
							</li>
							<li role="presentation" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="You don't have access to this option.">
								<a href="#"><i class="fa fa-lock"></i> Permissions</a>
							</li>
							<li role="presentation">
								<a href="#">Integrations</a>
							</li>
							<li role="presentation">
								<a href="#">Notifications</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<div class="wiki-info">
					                    <h2>Wiki Overview</h2>
					                    <form action="" method="POST" role="form">
					                    	<div class="row">
					                    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							                    	<div class="form-group">
							                    		<label for="">Name</label>
							                    		<input type="text" class="form-control" id="" value="Demonstration Space">
							                    	</div>
					                    		</div>
					                    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<div class="form-group">
														<label for="">Category</label>
														<select name="" id="input" class="form-control" required="required">
															<option value="">Marketing</option>
															<option value="">Sale</option>
															<option value="">Human Resource</option>
														</select>
													</div>
					                    		</div>
					                    	</div>
					                    	<div class="form-group">
					                    		<label for="">Description</label>
					                    		<input type="text" class="form-control" id="" value="Lorem ipsum dolor sit, tempor incididunt ut labore et dolore magna aliqua.">
					                    	</div>
					                    	<button type="submit" class="btn btn-success">Update</button>
					                    </form>
					                </div>
            		                <div class="delete-team" style="border-bottom: 0px;">
                                        <h2>Delete Wiki</h2>
                                        <p class="text-muted action-info">
                                            This wiki will be permanently deleted from this team and you can't restore it.
                                        </p>
                                        <form action="" method="POST" role="form">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Yes I understand, delete this wiki</button>
                                        </form>
                                    </div>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="panel panel-default" style="margin-top: 40px;">
										<div class="panel-body">
											<div class="wiki-overview">
												<div style="margin-bottom: 4px;">
													<label style="margin-bottom: 0;">Created by</label>
													<p><a href="#">Zeeshan Ahmed</a></p>
												</div>
												<div style="margin-bottom: 4px;">
													<label style="margin-bottom: 0;">Created at</label>
													<p>Feb 25, 2016 at 2:27pm</p>
												</div>
												<div>
													<label style="margin-bottom: 0;">Last updated</label>
													<p>Feb 25, 2016 at 2:27pm</p>
												</div>
												<hr>
												<div>
													<label class="pull-left" style="margin-bottom: 0;">Total Pages</label>
													<div class="pull-right label label-default" style="position: relative; top: 4px;">4</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-default administrators-list">
										<div class="panel-body">
											<div class="panel-top">
												<div class="list-heading pull-left"><i class="fa fa-user-circle-o fa-fw"></i> <a href="#">Administrators</a></div>
												<div class="list-total label label-default pull-right">9</div>
												<div class="clearfix"></div>
											</div>
											<ul class="list-unstyled list-inline" style="margin-bottom: 0;">
												<li>
													<a href="#">
														<img src="/img/christian.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Christian">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/elliot.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Elliot">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/helen.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Helen">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/jenny.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Jenny">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/joe.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Joe">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/justen.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Justen">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/laura.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Laura">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/matt.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Matt">
													</a>
												</li>
												<li>
													<a href="#">
														<img src="/img/steve.jpg" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Steve">
													</a>
												</li>
											</ul>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection