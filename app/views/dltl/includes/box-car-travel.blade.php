<div class="box" id="car-travel">
    <div class="row">
        <div class="header col-sm-12">
            <h3>Cho thuê xe du lịch</h3>
            <div class="clearfix border-header">
                <hr class="hight-line">
                <hr class="">
            </div>
        </div>
    </div>

    @foreach($carHot as $key => $car)
    <?php $key +=1 ?>
        <div class="item col-sm-6 {{ $key % 2 == 0 ? 'last' : '' }}">
            <div class="inside clearfix">
                <div class="img pull-left">
                    <a href="{{ $car->getUrl() }}"><img src="{{ $car->getPicture() }}" alt="{{ $car->pos_title }}" /></a>
                </div>
                <div class="content pull-left">
                    <h3 class="tour-name"><a href="{{ $car->getUrl() }}">{{ $car->pos_title }}</a></h3>
                    {{ $car->pos_teaser }}
                </div>
            </div>
        </div>
    @endforeach
</div>