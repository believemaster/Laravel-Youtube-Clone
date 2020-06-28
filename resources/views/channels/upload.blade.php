@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <channel-uploads :channel="{{ $channel }}" inline-template>
            <div class="col-md-8">
                <div class="card p-3 d-flex align-items-center" v-if="!selected">
                    <img onclick="document.getElementById('video-files').click()" src="https://cdn1.iconfinder.com/data/icons/video-actions-files-1/24/camera_record_cam_movie_film_upload-512.png" width="100px" height="100px" alt="Upload Video" title="Click To Upload Video" style="cursor: pointer">

                    <input id="video-files" type="file" multiple ref="videos" style="display: none" @change="upload">
                    <p class="text-center">Upload Video</p>
                </div>
                <div class="card p-3" v-else>
                    <div class="my-4" v-for="video in videos">
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="{ width: `${progress[video.name]}%` }" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center align-items-center" style="height: 180px; color:white; font-size: 18px; background: #808080">
                                    Loading Thumbnail ...
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h4 class="text-center">
                                    @{{ video.name }}
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </channel-uploads>
    </div>
</div>
@endsection
