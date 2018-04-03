<div class="box" id="hotel">
    <div class="row">
        <div class="header col-sm-12">
            <h3>Khách sạn</h3>
            <div class="clearfix border-header">
                <hr class="hight-line">
                <hr class="">
            </div>
        </div>
    </div>

    @foreach($hotelHot as $key => $hotel)
        <?php $key += 1; ?>
        <div class="item col-sm-6 {{ $key % 2 == 0 ? 'last' : 'first' }}">
            <div class="inside clearfix">
                <div class="img pull-left">
                    <a href="{{ $hotel->getUrl() }}"><img src="{{ $hotel->getPicture() }}" alt="{{ $hotel->pos_title }}" /></a>
                </div>
                <div class="content pull-left">
                    <h3 class="tour-name"><a href="{{ $hotel->getUrl() }}">{{ $hotel->pos_title }}</a></h3>
                    {{ $hotel->pos_teaser }}
                </div>
            </div>
        </div>
    @endforeach
</div>