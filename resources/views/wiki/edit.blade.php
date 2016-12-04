@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.wiki-nav')    
        </div>
    </div>
    <h3 style="margin-top: 10px;">Edit wiki</h3>
	<div class="row" style="margin-top: 10px;">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form action="{{ route('wikis.update', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 10px;">
             	{!! method_field('patch') !!}
                <div class="form-group @if($errors->has('wiki_name')) has-error  @endif">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label">Wiki name</span>
                        <input type="text" class="form-control input" name="wiki_name" id="wiki_name" value="{{ $wiki->name }}">
                    </div>
                    @if ($errors->has('wiki_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('wiki_name') }}</strong>
                        </span>
                    @endif
                </div>  
                <div class="form-group">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="vertical-align: top; width: 92px; padding-top: 5px;">Outline</span>
                        <textarea name="outline" id="outline" class="form-control input" rows="3"></textarea>
                    </div>
                </div>
            	<div class="form-group">
            		<label for="wiki-description" class="control-label">Description</label>
        			<textarea name="wiki_description" id="wiki-description" class="form-control">{{ htmlentities($wiki->description) }}</textarea>
            	</div>
            	<ul class="list-unstyled list-inline">
            		<li>
		                <input type="submit" class="btn btn-primary" value="Save">
            		</li>
            		<li>
                        <a href="{{ route('wikis.show', $wiki->slug) }}" class="btn btn-default" onclick="if(window.confirm('Leave edit mode? \n All unsaved changes will be lost.')) {   } else { return false; }">Cancel</a>
            		</li>
            	</ul>
                <div class="clearfix"></div>
            </form>
	    </div>
	</div>
@endsection