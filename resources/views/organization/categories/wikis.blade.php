@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="mb20 pull-left">
                        <h2 class="mt0">{{ $category->name }} wikis</h2>
                        <p class="text-muted marginless">Below is the list of wikis that are in {{ $category->name }} category. Lorem ipsum dolor sit amet, consectetur adipisicing elit!</p>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" href="#create-category-modal">Create wiki</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row category-item-con" id="ms-container">
                @if($category->wikis->count() > 0) 
                    <?php Emojione\Emojione::$imagePathPNG = '/images/png/'; ?>
                    @foreach($category->wikis as $wiki)
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ms-item">
                            <a href="{{ route('wikis.show', [$organization->slug, $category->slug, $wiki->slug]) }}" class="category-item" data-category-id="{{ $wiki->id }}">
                                <div class="panel panel-default category-item-inner" style="margin-bottom: 32px;">
                                    <div class="panel-body">
                                        <div class="category-body m10">
                                            <h3 class="mt0" id="category-name">{{ $wiki->name }} <span class="text-muted" style="font-size: 12px; font-weight: 500; -webkit-text-stroke: 0px; float: right; position: relative; top: 3px;"><i class="fa fa-clock-o"></i> Updated {{ $wiki->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span></h3>
                                            @if(!empty($wiki->outline))
                                                <p class="text-muted marginless emoji-text" id="category-outline" data-emoji-content="{{ $wiki->outline }}">{!! Emojione\Emojione::toImage($wiki->outline) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p class="text-center" style="position: absolute; top: 50%; left: 50%; margin-left: -120px; margin-top: 50px;">No wikis yet. You can <a href="#">create one here</a>.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
