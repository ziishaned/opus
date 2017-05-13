@extends('layouts.master')

@section('content')
    <div class="aside-content create-wiki-aside">
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="page-header">
                    <i class="fa fa-file-text-o fa-fw fa-lg icon"></i> Update Page
                </div>
                <form action="{{ route('pages.update', [$team->slug, $wiki->space->slug, $wiki->slug, $page->slug ]) }}" method="POST" role="form">
                    {{ method_field('patch') }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="control-label" for="name">Name</label>
                                <input type="text" name="name" value="{{ $page->name }}" class="form-control" id="name" required>
                                @if($errors->has('name'))
                                    <p class="help-block has-error">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="outline">Outline</label>
                                <input type="text" name="outline" id="outline" value="{{ $page->outline }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group {{ $errors->has('page_parent') ? 'has-error' : '' }}">
                                <label for="page-parent" class="control-label">Page Parent</label>
                                <select name="page_parent" id="page-parent" class="form-control">
                                    <option value="">Select a option</option>
                                    <?php $currentPage = $page->parent_id; ?>
                                    @foreach($pages as $item)
                                        <option value="{{ $item->id }}" {{ $currentPage === $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('page_parent'))
                                    <p class="help-block has-error">{{ $errors->first('page_parent') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="tags">Tags</label>
                                <select class="form-control" name="tags[]" id="tags" multiple="multiple">
                                    @foreach($pageTags as $tag)
                                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="wiki-description">Description</label>
                        <textarea name="description" class="form-control" data-height="380" id="wiki-description">{{ $page->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <a href="{{ route('pages.show', [$team->slug, $space->slug, $wiki->slug, $page->slug]) }}" class="btn btn-link pull-right">Cancel</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection