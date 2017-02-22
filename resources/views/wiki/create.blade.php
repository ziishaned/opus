@extends('layouts.master')

@section('content')
	<div class="aside-content create-wiki-aside">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page-header">
					<img src="/img/icons/basic_notebook_pen.svg" width="28" height="28" class="icon"> Create Wiki
				</div>
				<form action="{{ route('wikis.store', [$team->slug, ]) }}" method="POST" role="form" class="create-wiki-form">
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<h4>Basic information</h4>
							<p class="text-muted">Beatae doloribus sapiente earum iusto hic labore porro facilis.</p>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
									<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
										<label class="control-label" for="name">Name</label>
										<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" required>
										@if($errors->has('name'))
										    <p class="help-block has-error">{{ $errors->first('name') }}</p>
										@endif
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
										<label for="category" class="control-label">Category</label>
										<select name="category" id="category" class="form-control" required>
											<option value="">Select a category</option>
											@foreach($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
											@endforeach
										</select>
										@if($errors->has('category'))
										    <p class="help-block has-error">{{ $errors->first('category') }}</p>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
									<div class="form-group">
										<label class="control-label" for="outline">Outline</label>
										<input type="text" name="outline" id="outline" class="form-control">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="wiki-description">Description</label>
						<textarea name="description" class="form-control" data-height="380" id="wiki-description"></textarea>
					</div>
					<button type="submit" class="btn btn-primary pull-right">Save</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
@endsection