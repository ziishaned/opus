@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="text-center" style="margin-bottom: 30px;">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li>
                    <img src="{!! new LetterAvatar($organization->name, 'circle', 54) !!}" alt="">
                </li>
                <li>
                    <h1 style="margin-bottom: 0; position: relative; top: 7px;">{{ $organization->name }}</h1>
                </li>
            </ul>
        </div>
        <div class="row wikis-categories-con" id="ms-container">
            @foreach($categories as $category)
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ms-item">
                    <div class="panel panel-default">
                        <div class="panel-body{{ ($category->wikis->count() == 0) ? ' has-no-wikis' : '' }}" style="padding: 0;">
                            <h2 class="category-name text-center"><i class="fa fa-sitemap fa-lg fa-fw"></i> {{ $category->name }}</h2>
                            @if($category->wikis->count() > 0) 
                                <div class="list-group">
                                    @foreach($category->wikis as $wiki)
                                        <a href="#" class="list-group-item">
                                            <h3 style="margin-bottom: 0;">{{ $wiki->name }}</h3>
                                            <p class="list-group-item-text">{!! $wiki->outline !!}</p>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="text-center" style="padding: 15px;">
                                    <a href="#" class="btn btn-link">Show all</a>
                                </div>
                            @else 
                                <div style="margin-left: 35px; margin-bottom: 35px; margin-right: 35px;">
                                    No pages yet. You can <a href="#">create one here</a>.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
