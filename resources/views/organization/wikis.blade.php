@extends('layouts.app')

@section('content')
    <div style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <div class="subnav">
                <ul class="list-unstyled list-inline">
                    <li class="active">
                        <a href="{{ route('organizations.wikis', [$organization->slug, ]) }}">All wikis</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.wikis.user-contributions', [$organization->slug, ]) }}">My contributions</a>
                    </li>
                    <li>
                        <a href="#">Read list</a>
                    </li>
                    <li>
                        <a href="#" title="Jis py zyada comment or viaitor hon">Trending</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <div class="row wikis-categories-con" id="ms-container">
            @foreach($categories as $category)
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body{{ ($category->wikis->count() == 0) ? ' has-no-wikis' : '' }}">
                            <h2 class="category-name"><i class="fa fa-sitemap fa-lg fa-fw"></i> {{ $category->name }}</h2>
                            <div class="list-group">
                                @if($category->wikis->count() > 0) 
                                    @foreach($category->wikis as $wiki)
                                        <a href="#" class="list-group-item">
                                            <h3 class="list-group-item-heading">{{ $wiki->name }}</h3>
                                            <p class="list-group-item-text">{!! $wiki->outline !!}</p>
                                        </a>
                                    @endforeach
                                @else 
                                    <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                                        No pages yet. You can <a href="#">create one here</a>.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
