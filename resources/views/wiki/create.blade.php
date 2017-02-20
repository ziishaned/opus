@extends('layouts.master')

@section('content')
	<div class="aside-content create-wiki-aside">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page-header">
					<img src="/img/icons/basic_notebook_pen.svg" width="28" height="28" class="icon"> Create Wiki
				</div>
				<form action="" method="POST" role="form" class="create-wiki-form">
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h4>Basic information</h4>
							<p class="text-muted">Beatae doloribus sapiente earum iusto hic labore porro facilis.</p>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" id="">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label>Category</label>
										<select name="" id="input" class="form-control" required="required">
											<option value="">Select a category</option>
											<option value="1">Engineering</option>
											<option value="0">Product</option>
											<option value="0">New Employee Onboarding</option>
											<option value="0">Marketing</option>
											<option value="0">Human Resuorces</option>
											<option value="0">Sales</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
									<div class="form-group">
										<label>Outline</label>
										<input type="text" name="" class="form-control">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="" class="form-control" rows="22" required="required" id="my1"></textarea>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="pull-right">
								<ul class="list-unstyled list-inline actions-btn">
									<li><a href="#" class="btn btn-link">Cancel</a></li>
									<li><a href="#" class="btn btn-primary">Save</a></li>
								</ul>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection