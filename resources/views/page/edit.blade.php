@extends('layouts.master')

@section('content')
    <div class="aside-content create-wiki-aside">
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="page-header">
                    <img src="/img/icons/basic_sheet_pencil.svg" width="28" height="28" class="icon"> Update Page
                </div>
                <form action="{{ route('pages.update', [$team->slug, $wiki->category->slug, $wiki->slug, $page->slug ]) }}" method="POST" role="form">
                    {{ method_field('patch') }}
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <h4>Basic information</h4>
                            <p class="text-muted">Beatae doloribus sapiente earum iusto hic labore porro facilis.</p>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="control-label" for="name">Name</label>
                                        <input type="text" name="name" value="{{ $page->name }}" class="form-control" id="name" required>
                                        @if($errors->has('name'))
                                            <p class="help-block has-error">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                                    <div class="form-group {{ $errors->has('page_parent') ? 'has-error' : '' }}">
                                        <label for="page-parent" class="control-label">Page Parent</label>
                                        <select name="page_parent" id="page-parent" class="form-control">
                                            <option value="">Select a option</option>
                                            <?php $currentPage = $page->parent_id; ?>
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" {{ $currentPage === $page->id ? 'selected' : '' }}>{{ $page->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('page_parent'))
                                            <p class="help-block has-error">{{ $errors->first('page_parent') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label" for="outline">Outline</label>
                                        <input type="text" name="outline" id="outline" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="wiki-description">Description</label>
                        <textarea name="description" class="form-control" data-height="380" id="wiki-description">{{ $page->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection