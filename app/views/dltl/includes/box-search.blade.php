<div id="box-search">
    <div class="container">
        <div class="bottom">
            <form class="form-inline" name="tour_search" action="{{ route('search') }}" method="get">
                <div class="form-group col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="location" name="q" placeholder="Nơi bạn muốn đến" value="{{ Input::get('q') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dltl"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
</div>