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
			                    <form action="{{ route('wikis.overview.update', [$team->slug, $space->slug, $wiki->slug]) }}" method="POST" role="form">
			                    	{{ method_field('patch') }}
			                    	<div class="row">
			                    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					                    	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					                    		<label for="name" class="control-label">Name</label>
					                    		<input type="text" name="name" class="form-control" id="name" value="{{ $wiki->name }}" required>
					                    		@if($errors->has('name'))
					                    		    <p class="help-block has-error">{{ $errors->first('name') }}</p>
					                    		@endif
					                    	</div>
			                    		</div>
			                    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<div class="form-group {{ $errors->has('space') ? 'has-error' : '' }}">
												<label for="space" class="control-label">Space</label>
												<select name="space" id="space" class="form-control" required="required">
													@foreach($spaces as $space)
														<option value="{{ $space->id }}" @if($wiki->space_id === $space->id) selected @endif>{{ $space->name }}</option>
													@endforeach
												</select>
												@if($errors->has('space'))
												    <p class="help-block has-error">{{ $errors->first('space') }}</p>
												@endif
											</div>
			                    		</div>
			                    	</div>
			                    	<div class="form-group">
			                    		<label for="">Description</label>
			                    		<input type="text" name="outline" class="form-control" id="" value="{{ $wiki->outline }}">
			                    	</div>
			                    	<div class="form-group">
			                    		<label class="control-label" for="tags">Tags</label>
			                    		<select class="form-control" name="tags[]" id="tags" multiple="multiple">
			                    			@foreach($wikiTags as $tag)
			                    			    <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
			                    			@endforeach
			                    		</select>
			                    	</div>
			                    	<button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw" style="font-size: 14px;"></i> Update</button>
			                    </form>
			                </div>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<div class="panel panel-default" style="margin-top: 40px;">
								<div class="panel-body">
									<div class="wiki-overview">
										<div style="margin-bottom: 4px;">
											<label style="margin-bottom: 0;">Created by</label>
											<p><a href="{{ route('users.show', [$team->slug, $wiki->user->slug]) }}">{{ $wiki->user->name }}</a></p>
										</div>
										<div style="margin-bottom: 4px;">
											<label style="margin-bottom: 0;">Created at</label>
											<p>{{ $wiki->created_at->toDayDateTimeString() }}</p>
										</div>
										<div>
											<label style="margin-bottom: 0;">Last updated</label>
											<p>{{ $wikiLastUpdated }}</p>
										</div>
										<hr>
										<div>
											<label class="pull-left" style="margin-bottom: 0;">Total Pages</label>
											<div class="pull-right label label-default" style="position: relative; top: 4px;">{{ $wiki->pages->count() }}</div>
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
	                            <a href="{{ route('wikis.destroy', [$team->slug, $space->slug, $wiki->slug]) }}" class="btn btn-danger" data-method="delete" data-confirm="Are you sure?" style="padding: 5px 6px;"><i class="fa fa-trash fa-fw"></i> Yes I understand, delete this wiki</a>
	                        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection