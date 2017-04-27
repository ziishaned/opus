@extends('layouts.master')

@section('content')
    <div class="aside-content create-wiki-aside" style="margin-top: 0; padding-bottom: 0;">
        <form action="{{ route('wikis.update', [$team->slug, $wiki->space->slug, $wiki->slug ]) }}" method="POST" role="form" class="create-wiki-form">
            {{ method_field('patch') }}
            <textarea name="description" class="form-control" data-height="555" id="wiki-description">{{ $wiki->description }}</textarea>
            <div class="row no-container" style="margin-top: 15px;">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="form-group form-inline edit-wiki-tags" style="position: relative; top: -5.1px;">
                        <label class="control-label" for="tags" style="margin-right: 15px;">Tags: </label>
                        <select class="form-control" name="tags[]" id="tags" multiple="multiple" style="width: 90%;">
                            @foreach($wikiTags as $tag)
                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-success pull-right" style="margin-right: 17px;">Update</button>
                    <a href="{{ route('wikis.show', [$team->slug, $space->slug, $wiki->slug]) }}" class="btn btn-link pull-right">Cancel</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
@endsection