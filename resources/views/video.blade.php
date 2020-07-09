@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $video->title }}</div>

                @if ($video->editable())
                <form class="" action="{{ route('videos.update', $video->id) }}" method="post">
                    @csrf
                    @method('PUT')
                @endif


                    <div class="card-body">
                        <video
                        id="video"
                        class="video-js vjs-theme-city"
                        controls
                        preload="auto"
                        width="690"
                        height="375"
                        poster="{{ $video->thumbnail }}"
                        data-setup="{}"
                      >
                        <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL" />
                      </video>

                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mt-3">
                                @if ($video->editable())
                                    <input type="text" class="form-control" value="{{ $video->title }}" name="title">
                                @else
                                    {{ $video->title }}
                                @endif
                            </h4>
                            {{ $video->views }} {{ str_plural('view',$video->views) }}
                        </div>

                        <votes :default_votes='{{ $video->votes }}' entity_owner="{{ $video->channel->user_id }}"></votes>
                      </div>

                        <hr>

                        <div>
                            @if ($video->editable())
                                <textarea name="description" id="" cols="3" rows="3" class="form-control">{{ $video->description }}</textarea>
                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-sm btn-outline-info">Update Details</button>
                                </div>
                            @else
                                {{ $video->description }}
                            @endif

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <div class="media">
                                <img class="rounded-circle" src="https://picsum.photos/id/42/200/200" width="50" height="50" class="mr-3" alt="...">
                                <div class="media-body ml-2">
                                    <h5 class="mt-0 mb-0">
                                        {{ $video->channel->name }}
                                    </h5>
                                    <span class="small">Published on {{ $video->created_at->toFormattedDateString() }}</span>
                                </div>
                            </div>

                            <subscribe-button :channel="{{ $video->channel }}" :initial-subscriptions="{{ $video->channel->subscriptions }}" />
                        </div>

                    </div>
                @if ($video->editable())
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet" />
    <!-- Video.js base CSS -->
    <link
    href="https://unpkg.com/video.js@7/dist/video-js.min.css"
    rel="stylesheet"
    />

    <!-- City -->
    <link
    href="https://unpkg.com/@videojs/themes@1/dist/city/index.css"
    rel="stylesheet"
    />
    <style>
        .vjs-default-skin {
            width: 100%;
        }
        .like, .dislike {
            width: 25px;
            height: 25px;
            cursor: pointer;
            fill: currentColor;
        }
        .dislike-active, .like-active {
            color: #ff3e3e;
        }
        .dislike {
            margin-left: 1rem;
        }
    </style>

    <style>
        .w-full {
            width: 100% !important;
        }
        .w-80 {
            width: 80% !important;
        }
    </style>

    <style>
        .vjs-theme-city {
            /* If Styling needed */
        }
    </style>
@endsection

@section('scripts')

<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
<script>
    window.CURRENT_VIDEO = '{{ $video->id }}';
</script>
<script src="{{ asset('js/player.js') }}"></script>
@endsection
