@if( !$results->isEmpty() )
    <section class="row recent_uploads">
        <div class="container">
            <div class="row title_row">
                <h3>Result</h3>
            </div>
            <div class="row media-grid content_video_posts">
                @foreach($results as $result)
                    <article class="col-sm-4 video_post postType3">
                        <div class="inner row m0">
                            <a href="single-video.html">
                                <div class="row screencast m0">
                                    @if($image = $result->image()->where('meta','Result_Image')->first())
                                        <img src="{{asset($image->url) }}" alt="" class="cast img-responsive"
                                             style="height:250px;width:100%;object-fit:cover">
                                    @endif
                                </div>
                            </a>
                            <div class="row m0 post_data">

                                <div class="row m0"><a href="single-video.html"
                                                       class="post_title">{{$result->title}}</a></div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section> <!--Result-->
@endif