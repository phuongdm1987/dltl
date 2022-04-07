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

--------------------------
## Run composer
docker run --rm -v $(pwd):/app composer install
sudo chown -R $USER:$USER ~/dltl

## Mysql
docker compose exec mysql bash
mysql -u root -p dltl < /docker-entrypoint-initdb.d/db_core.sql

## Token mismatch
check line separator of .env.php, convert CRLF to LF
find . -type f -exec dos2unix {} \;

## Digitalocean
- update code need docker compose down/up to load new update
- set PHP_OPCACHE_VALIDATE_TIMESTAMPS='1' because use docker and need to load new code change
- add hosts for domain

## JS
### CkEditor
- build custom at https://ckeditor.com/ckeditor-5/online-builder/
- change files at public/assets/js/ckeditor