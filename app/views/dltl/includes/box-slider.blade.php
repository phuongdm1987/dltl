<div id="slider-image" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#slider-image" data-slide-to="0" class="active"></li>
        <li data-target="#slider-image" data-slide-to="1"></li>
        <li data-target="#slider-image" data-slide-to="2"></li>
        <li data-target="#slider-image" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <a href="#"><img src="/assets/img/01.jpg" alt="01"></a>
            {{-- <div class="carousel-caption">
                <h3>ok 01</h3>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div> --}}
        </div>
        <div class="item">
            <a href="#"><img src="/assets/img/02.jpg" alt="02"></a>
        </div>
        <div class="item">
            <a href="#"><img src="/assets/img/03.jpg" alt="03"></a>
        </div>
        <div class="item">
            <a href="#"><img src="/assets/img/04.jpg" alt="04"></a>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#slider-image" role="button" data-slide="prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#slider-image" role="button" data-slide="next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
    </a>
</div>