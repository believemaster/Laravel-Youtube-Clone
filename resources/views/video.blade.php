@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $video->title }}</div>

                <div class="card-body">
                    <video
                    id="my-video"
                    class="video-js vjs-theme-city"
                    controls
                    preload="auto"
                    width="640"
                    height="264"
                    poster="{{ $video->thumbnail }}"
                    data-setup="{}"
                  >
                    <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL" />
                  </video>
                </div>
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
@endsection

@section('scripts')
    <script>
        videojs('video');
    </script>
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
@endsection
