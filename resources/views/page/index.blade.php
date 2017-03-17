@extends('layouts.master')

@section('content')
    @include('wiki.partials.menu')
    <div class="aside-content">
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div style="border: 1px solid #eee; border-radius: 3px; margin-bottom: 20px; box-shadow: 0 1px 1px rgba(0,0,0,.05);">
                    <div class="wiki-nav">
                        <nav>
                            <ul class="list-unstyled list-inline pull-left">
                                <li>
                                    <a href="#"><i class="fa fa-tasks fa-lg icon"></i> Add to Read list</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled list-inline pull-right">
                                <li>
                                    <a href="{{ route('pages.edit', [$team->slug, $space->slug, $wiki->slug, $page->slug]) }}"><i class="fa fa-pencil fa-lg icon"></i> Edit</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg icon"></i> Settings</a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="margin-top: 8px;">
                                        <li><a href="#"><i class="fa fa-info-circle fa-fw"></i> Page Overview</a></li>
                                        <li><a href="#"><i class="fa fa-history fa-fw"></i> Page History</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Export to PDF</a></li>
                                        <li><a href="#"><i class="fa fa-file-word-o fa-fw"></i> Export to Word</a></li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="{{ route('pages.destroy', [$team->slug, $space->slug, $wiki->slug, $page->slug]) }}" data-method="delete" data-confirm="Are you sure?"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </nav>
                    </div>
                    <div class="markdown-body" style="padding: 0px 25px;">
                        {!! $page->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('page.partials.comment')
            </div>
        </div>
    </div>
@endsection