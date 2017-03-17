@extends('layouts.master')

@section('content')
    @include('wiki.partials.menu')
    <div class="aside-content">
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="wiki-nav">
                    <nav>
                        <ul class="list-unstyled list-inline pull-left">
                            <li>
                                <a href="#"><img src="/img/icons/basic_todo_txt.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Add to Read list</a>
                            </li>
                        </ul>
                        <ul class="list-unstyled list-inline pull-right">
                            <li>
                                <a href="{{ route('pages.edit', [$team->slug, $space->slug, $wiki->slug, $page->slug]) }}"><img src="/img/icons/software_pencil.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Edit</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/icons/basic_gear.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Settings</a>
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
                <div class="markdown-body">
                    {!! $page->description !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                @include('page.partials.comment')
            </div>
        </div>
    </div>
@endsection