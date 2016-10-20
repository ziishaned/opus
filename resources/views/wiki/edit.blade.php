@extends('layouts.app')

@section('content')
	<div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <h3 style="margin: 0; margin-bottom: 10px;">Edit Wiki</h3>
        </div>
    </div>
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    	<form action="{{ route('wikis.update', $wiki->id) }}" method="POST" role="form" style="margin-bottom: 10px;">
             	{!! method_field('patch') !!}
                <div class="form-group @if($errors->has('wiki_name')) has-error  @endif">
                    <label for="organization_name" class="control-label">Wiki Name</label>
                    <input type="text" class="form-control" name="wiki_name" id="wiki_name" value="{{ $wiki->name }}">
                    @if($errors->has('wiki_name'))
                        <p class="text-danger">{{ $errors->first('wiki_name')  }}</p>
                    @endif
                </div>
            	<div class="form-group">
            		<label for="textarea" class="control-label">Description</label>
        			<textarea name="wiki_description" id="page-description" class="form-control">{{ $wiki->description }}</textarea>
            	</div>
            	<ul class="list-unstyled list-inline pull-right">
            		<li>
		                <input type="submit" class="btn btn-primary" value="Save">
            		</li>
            		<li>
		                <input type="submit" class="btn btn-default" value="Close">
            		</li>
            	</ul>
                <div class="clearfix"></div>
            </form>
	    	{{-- <div class="page-description">
	    		{!! $wiki->description !!}
	    	</div> --}}
	    	{{-- <div class="row">
	    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    			<ul class="list-unstyled list-inline">
	    				<li><a href="#"><i class="fa fa-thumbs-o-up"></i> Like <span class="badge">22</span></a></li>
	    				<li><i class="fa fa-comment-o"></i> Comments <span class="badge">2</span></li>
	    			</ul>
	    		</div>
	    	</div> --}}
	    	{{-- <div class="row">
	    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    			<div class="comments-section">
	    				<hr>
	    				<ul class="list-unstyled">
	    					{{ ViewHelper::makeCommentTree($wiki->comments) }}
	    				</ul>
	    				<hr>
	    			</div>
	    		</div>
	    	</div> --}}
	    	{{-- <div class="row" style="margin-bottom: 15px;">
	    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    			<form action="" method="POST" id="comment-form" role="form" data-toggle="validator"> 
	    				<div class="form-group" style="margin-bottom: 0;">
	    					<input type="text" name="enity_id" class="form-control hide" value="{{ $wiki->id }}">	
	    					<div class="row">
	    						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding-right: 0;">
	    							<img src="/images/default.png" class="img-responsive img-rounded" alt="Image">		
	    						</div>
	    						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
									<textarea id="comment-input" class="form-control" rows="3" placeholder="Submit your comment.." data-error="This comment field is required." required="required"></textarea>
								    <div class="help-block with-errors"></div>
	    						</div>
	    					</div>
	    				</div>
	    				<input type="submit" class="btn btn-primary pull-right" id="submit-comment" value="Submit">
	    				<div class="clearfix"></div>
	    			</form>
	    		</div>
	    	</div> --}}
		    {{-- @if($wikiPages->count() == 0) --}}
	            {{-- <h3 style="font-size: 27px; margin-top: 0;">Set up your first page</h3>
	            <form action="" method="POST" role="form" style="margin-bottom: 10px;">
	                <div class="form-group @if($errors->has('organization_name')) has-error  @endif">
	                    <label for="organization_name" class="control-label">Page Name</label>
	                    <input type="text" class="form-control" name="organization_name" id="organization_name">
	                    @if($errors->has('organization_name'))
	                        <p class="text-danger">{{ $errors->first('organization_name')  }}</p>
	                    @endif
	                </div>
	                <div class="form-group">
		                <button class="btn btn-success" id="add-page-description">Add Description</button>
	                </div>
	                <div class="form-group hide" id="page-description-input">
					    <textarea id="mytextarea"></textarea>
	    			</div>
	                <input type="submit" class="btn btn-success hide pull-right" id="create-page-btn" value="Create Page">
	                <div class="clearfix"></div>
	            </form> --}}
		    {{-- @endif --}}
	    </div>
	</div>
@endsection