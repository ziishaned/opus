@extends('layouts.app')

@section('content')
	<div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <h3 style="margin: 0; margin-bottom: 10px;">Edit Page</h3>
        </div>
    </div>
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    	<form action="{{ route('pages.update', [$page->wiki->slug, $page->slug]) }}" method="POST" role="form" style="margin-bottom: 10px;">
             	{!! method_field('patch') !!}
             	{!! csrf_field() !!}
                <div class="form-group @if($errors->has('page_name')) has-error  @endif">
                    <label for="page-name" class="control-label">Page Name</label>
                    <input type="text" class="form-control" name="page_name" id="page-name" value="{{ $page->name }}">
                    @if($errors->has('page_name'))
                        <p class="text-danger">{{ $errors->first('page_name')  }}</p>
                    @endif
                </div>
            	<div class="form-group">
            		<label for="page-description" class="control-label">Description</label>
        			<textarea name="page_description" id="page-description" class="form-control">{{ $page->description }}</textarea>
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
	    </div>
	</div>
@endsection