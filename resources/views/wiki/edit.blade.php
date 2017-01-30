@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Edit wiki</h3>
                <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
                <form action="{{ route('wikis.update', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}" method="POST" role="form" style="margin-bottom: 10px;">
                 	{!! method_field('patch') !!}
                	<div class="form-group">
                		<label for="wiki-description" class="control-label">Description</label>
            			<textarea name="wiki_description" id="wiki-description" class="form-control">{{ htmlentities($wiki->description) }}</textarea>
                	</div>
                    <div class="form-group">
                        <div class="pull-left">
                            <a href="{{ route('wikis.show', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}" class="btn btn-default" onclick="if(window.confirm('Leave edit mode? \n All unsaved changes will be lost.')) {   } else { return false; }">Cancel</a>
                        </div>
                        <div class="pull-right">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
    	    </div>
    	</div>
    </div>
@endsection