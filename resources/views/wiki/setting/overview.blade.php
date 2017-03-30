@extends('layouts.master')

@section('content')
	@include('wiki.partials.menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wiki-setting">
					<div class="row no-container">
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<div class="wiki-info" style="border-bottom: 0px;">
			                    <h2>Wiki Overview</h2>
			                    <hr>
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
												<label for="">Space</label>
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
						</div>
					</div>
					<hr style="border-top: 1px solid #eee; margin: 0px 15px 0px 15px;">
					<div class="row no-container">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection