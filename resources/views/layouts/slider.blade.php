<style>
    img{
        max-height: 300px;
    }
</style>

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
            <img src="http://laz-img-cdn.alicdn.com/images/ims-web/TB1FAuTeRr0gK0jSZFnXXbRRXXa.jpg"/>
        </div>
        <div class="carousel-item">
            <img src="https://laz-img-cdn.alicdn.com/images/ims-web/TB17mpIe8r0gK0jSZFnXXbRRXXa.jpg_1200x1200.jpg"/>
        </div>
        <div class="carousel-item">
            <img src="http://laz-img-cdn.alicdn.com/images/ims-web/TB1_QkfeRr0gK0jSZFnXXbRRXXa.jpg"/>
        </div>

        <div class="carousel-item">
            <img src="http://laz-img-cdn.alicdn.com/images/ims-web/TB1BnVIe8r0gK0jSZFnXXbRRXXa.jpg"/>
        </div>
        <div class="carousel-item">
            <img src="http://laz-img-cdn.alicdn.com/images/ims-web/TB1J85TeRr0gK0jSZFnXXbRRXXa.png"/>
        </div>
        <div class="carousel-item">
            <img src="http://laz-img-cdn.alicdn.com/images/ims-web/TB1F8qUeRr0gK0jSZFnXXbRRXXa.jpg"/>

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

