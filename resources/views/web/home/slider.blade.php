<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach($slides as $key => $slide)
            <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{ $key==0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>


    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach($slides as $key => $slide)

            @if($image = $slide->image()->where('meta','Slider_Image')->first())
            <div class="item {{ $key==0 ? 'active' : '' }}">
                <img src="{{asset($image->url) }}"
                     alt="Los Angeles" style="width:100%;">

            </div>
            @endif

        @endforeach


    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

