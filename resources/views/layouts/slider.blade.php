<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner" style="width: 100%;">
        <div class="carousel-item active">
            <img src="{{asset('/storage/slider/slider-1.webp')}}"/>
        </div>
        <div class="carousel-item">
            <img src="{{asset('/storage/slider/slider-2.jpg')}}"/>
        </div>
        <div class="carousel-item">
            <img src="{{asset('/storage/slider/slider-7.jpg')}}"/>
        </div>

        <div class="carousel-item">
            <img src="{{asset('/storage/slider/slider-3.webp')}}"/>
        </div>
        <div class="carousel-item">
            <img src="{{asset('/storage/slider/slider-5.webp')}}"/>
        </div>
        <div class="carousel-item">
            <img src="{{asset('/storage/slider/slider-4.webp')}}"/>

        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>

</div>
<script>
   $('.carousel-item').click(function () {
        window.location= '/deals';
    })
</script>
<br>

