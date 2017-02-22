@extends('layouts.master')

@section('content')
    <div class="aside-content create-wiki-aside">
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="page-header">
                    <img src="/img/icons/basic_notebook_pen.svg" width="28" height="28" class="icon"> Update Wiki
                </div>
                <form action="{{ route('wikis.update', [$team->slug, $wiki->category->slug, $wiki->slug ]) }}" method="POST" role="form" class="create-wiki-form">
                    {{ method_field('patch') }}
                    <div class="form-group">
                        <label class="control-label" for="wiki-description">Description</label>
                        <textarea name="description" class="form-control" data-height="380" id="wiki-description">{{ $wiki->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection