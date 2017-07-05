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
                                    @if(empty($isUserWatchWiki))
                                        <a href="{{ route('wikis.watch', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" style="padding: 5px 6px;"><i class="fa fa-eye icon"></i> Watch</a>
                                    @else
                                    	<a href="{{ route('wikis.unwatch', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" style="padding: 5px 6px;"><i class="fa fa-eye icon"></i> Watching</a>
                                    @endif 
                                </li>
                                {{-- <li>
									<a href="#" style="padding: 5px 6px;"><i class="fa fa-tasks icon"></i> Make Shortcut</a>
								</li> --}}
                                <li>
                                    @if(empty($isWikiInReadList)) 
                                        <a href="{{ route('wikis.readlater.create', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" style="padding: 5px 6px;"><i class="fa fa-check-square-o icon"></i> Read Later</a>
                                    @else
                                        <a href="{{ route('wikis.readlater.destroy', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" data-method="delete" style="padding: 5px 6px;"><i class="fa fa-check-square-o icon"></i> Added in Read Later</a>
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-unstyled list-inline pull-right">
                                <li>
                                    <a href="{{ route('wikis.word', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" style="padding: 5px 6px;"><i class="fa fa-file-word-o icon"></i> Export to Word</a>
                                </li>
                                <li>
                                    <a href="{{ route('wikis.pdf', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" style="padding: 5px 6px;"><i class="fa fa-file-pdf-o icon"></i> Export to PDF</a>
                                </li>
                                <li>
                                    <a href="{{ route('wikis.edit', [$team->slug, $space->slug, $wiki->slug, ]) }}" style="padding: 5px 6px;"><i class="fa fa-pencil icon"></i> Edit</a>
                                </li>
                                <li>
                                    <a href="{{ route('wikis.destroy', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" data-method="delete" data-confirm="Are you sure?" style="padding: 5px 6px;"><i class="fa fa-trash-o icon"></i> Delete</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </nav>
                    </div>
                    <div class="markdown-body" style="padding: 0px 25px;">
                        @if($wiki->description)
                            {!! $wiki->description !!}
                        @else 
                            <span style="font-size: 22px; font-weight: 700; line-height: 0px;">...</span>
                        @endif
                    </div>
                </div>     
            </div>
        </div>
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div style="border: 1px solid #eee; border-radius: 3px; margin-bottom: 20px; box-shadow: 0 1px 1px rgba(0,0,0,.05); padding: 12px 15px;">
                    <div class="media">
                        <div class="pull-left" style="padding-right: 12px;">
                            <p class="media-object"><i class="fa fa-tag fa-fw"></i> Tags:</p>
                        </div>
                        <div class="media-body" style="line-height: 26px;">
                            @if($wikiTags->count() > 0)
                                <ul class="list-unstyled list-inline page-tags pull-left">                                
                                    @foreach($wikiTags as $tag)
                                        <li>
                                            <a href="{{ route('tags.wikis', [$team->slug, $tag->slug ]) }}">{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <h1 class="nothing-found" style="margin: 0px; line-height: 20px;"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('wiki.partials.comment')
            </div>
        </div>
	</div>
@endsection