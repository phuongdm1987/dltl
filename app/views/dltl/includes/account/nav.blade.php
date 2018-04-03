<div class="box menu support">
    <div class="header">
        <h3>Danh mục quản lý</h3>
        <div class="clearfix border-header">
            <hr class="hight-line">
            <hr class="">
        </div>
    </div>
    <div class="wapper-content">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="{{ Request::segment(3) == 'create' ? 'active' : '' }}">
                <a href="{{ route('account.tour.edit') }}">Tạo mới tour</a>
            </li>
            <li role="presentation" class="{{ Request::url() == route('account.tour.index') ? 'active' : '' }}">
                <a href="{{ route('account.tour.index') }}">Danh sách tour</a>
            </li>
            <li role="presentation" class="{{ Request::url() == route('account.booking.index') ? 'active' : '' }}">
                <a href="{{ route('account.booking.index') }}">Danh sách bookings khách</a>
            </li>
            <li role="presentation" class="{{ Request::url() == route('account.booking.me') ? 'active' : '' }}">
                <a href="{{ route('account.booking.me') }}">Danh sách bookings</a>
            </li>
            <li role="presentation" class="{{ Request::segment(2) == 'profile' ? 'active' : '' }}"><a href="{{ route('profile.index') }}">Thông tin cá nhân</a></li>
        </ul>
    </div>
</div>