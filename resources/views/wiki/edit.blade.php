@extends('layouts.master')

@section('content')
    <div class="aside-content create-wiki-aside" style="margin-top: 0; padding-bottom: 0;">
        <form action="{{ route('wikis.update', [$team->slug, $wiki->category->slug, $wiki->slug ]) }}" method="POST" role="form" class="create-wiki-form">
            {{ method_field('patch') }}
            <textarea name="description" class="form-control" data-height="555" id="wiki-description">{{ $wiki->description }}</textarea>
            <div style="margin-top: 15px;">
                <button type="submit" class="btn btn-success pull-right" style="margin-right: 17px;">Update</button>
                <button type="submit" class="btn btn-link pull-right" style="margin-right: 10px;">Close</button>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
@endsection