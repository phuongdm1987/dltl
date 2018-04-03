### Waa project

Sau khi clone project về máy cá nhân, xóa file `composer.lock`, sau đó mở terminal (linux, mac) hoặc cmd (windows) chạy lệnh `composer install`. Nếu không có composer thì cài đặt tại đây [Composer](https://getcomposer.org/download/).

Nếu lệnh `composer install` không báo lỗi thì tiếp tục chạy lệnh `php artisan dump-autoload` trong terminal hoặc cmd (yêu cầu phải cài php trên terminal hoặc cmd, kiểm tra bằng cách gõ lệnh `php -v`).

Nếu lệnh `composer install` báo lỗi thì mở file `app/config/app.php`, comment dòng 117, 118 và 185 rồi chạy lại lệnh `composer install`.

Tạo VirtualHost trong apache giả sử:

   >Listen 8000

   ><VirtualHost *:8000>

   >   DocumentRoot "/Applications/MAMP/htdocs/waa/public"

   >   ServerName localhost

   ></VirtualHost>

Trong phpmyadmin, import file sql `db_core.sql`

Sửa thông tin database trong file `app/config/database.php` cho phù hợp cấu hình trên localhost

Truy cập trang quản trị qua đường dẫn [http://localhost:8000/admin](http://localhost:8000/admin) với tài khoản `admin@developervn.com | 123456`