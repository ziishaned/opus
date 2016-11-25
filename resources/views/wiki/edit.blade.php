@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.wiki-nav')    
        </div>
    </div>
	<div class="row" style="margin-top: 10px;">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    	<form action="{{ route('wikis.update', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 10px;">
             	{!! method_field('patch') !!}
                <div class="form-group @if($errors->has('wiki_name')) has-error  @endif">
                    <label for="organization_name" class="control-label">Wiki Name</label>
                    <input type="text" class="form-control" name="wiki_name" id="wiki_name" value="{{ $wiki->name }}">
                    @if($errors->has('wiki_name'))
                        <p class="text-danger">{{ $errors->first('wiki_name')  }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="outline">Outline</label>
                    <input type="text" id="outline" name="outline" class="form-control" value="{{ $wiki->outline }}">
                </div>
            	<div class="form-group">
            		<label for="textarea" class="control-label">Description</label>
        			<textarea name="wiki_description" id="page-description" class="form-control">{{ htmlentities($wiki->description) }}</textarea>
            	</div>
            	<ul class="list-unstyled list-inline pull-right">
            		<li>
		                <input type="submit" class="btn btn-primary" value="Save">
            		</li>
            		<li>
		                <a href="{{ route('wikis.show', $wiki->slug) }}" class="btn btn-default">Close</a>
            		</li>
            	</ul>
                <div class="clearfix"></div>
            </form>
	    </div>
	</div>
@endsection