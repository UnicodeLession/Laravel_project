# Project End Laravel lesson online.unicode module 20

## về branch:
### master: branch gốc: chưa tích hợp CKEditor do chưa render ảnh khi thêm vào content trong textarea cùng với thiếu 1 icon để lấy ảnh trên laravel file manager serve
### fix-ckeditor-5: branch lỗi chưa fix điều kiện trên, khi nào fix xong thì merge vào master

## Khi Clone Project về thì phải tải về [file này](https://www.mediafire.com/file/go1sfwpnepgfmy6/public_backend.zip/file) rồi ném vào public/

## Tìm hiểu khóa ngoại cùng với Delete Cascade trong sql

## Phân tích cơ bản
### Dành cho người dùng:
- Hiển thị danh sách khóa học
- Hiển thị thông tin chi tiết khóa học
- Xem video bài giảng
- Download tài liệu bài giảng
- Học thử bài giảng
- Đăng ký/ Đăng nhập
- Trang tài khoản: 
  - Thông tin cá nhân
  - Khóa học của tôi,...
- Mua khóa học
- Giỏ hàng
- Hiển thị danh sách tin tức
- Hiển thị chi tiết tin tức

### Dành cho quản trị viên
- Quản lý danh mục
- Quản lý học viên
- Quản lý giảng viên
- Quản lý bài giảng
- Quản lý khóa học
- Quản lý danh mục tin tức
- Quản lý tin tức
- Quản lý file tài liệu
- Quản lý video

- Phân quyền khóa học cho học viên: kích hoạt khóa học cho học viên
- Phân quyền quản trị hệ thống: 
- Thống kê, Báo cáo,...

### API
- Xây dựng API hoàn chỉnh: xây dụng app cho ứng dụng -> cần API

## Phân tích Database: -> [Dbdiagram](https://dbdiagram.io/d/Module_20_Laravel-656563fe3be1495787db072a)

## Cài Đặt Laravel Module và Repository
```terminal
php artisan make:module Ten_module
```
## Các chức năng trong Trang Administrator
### User:
- Phân Trang
- Thêm, Sửa, Xóa

## Delete Cascade:
1. Xóa course -> xóa các liên kết bên trong bảng categories_courses ✅

2. Xóa category -> xóa các liên kết bên trong bảng categories_courses ✅
                   xóa các categories con của nó ❎
3. Xóa teacher -> xóa các courses của teacher đó ✅

___
4. Ràng buộc file + ảnh: với Course và Teacher
-> kiểm tra xem ảnh đó có bị sử dụng ở nơi khác không -> nếu có thì không được xóa
-> nếu xóa thì kiểm tra xem ảnh có được sử dụng ở nơi khác không -> có thì không được xóa
-> nếu sửa thì cũng phải kiểm tra xem ảnh có được sử dụng ở nơi khác không
    -> có sử dụng ở nơi khác: chỉ update ảnh mới lên
    -> không sử dụng ở nơi khác: update ảnh mới + xóa ảnh cũ
=> hướng giải quyết: tạo một module riêng: Media
   -> khi chọn ảnh thì render ra pop-up của moudule Media
   -> khi upload ảnh mới render ra pop-up của laravel-filemanager
   -> khi ấn vào chọn ảnh thì hiện ra 2 selections là: chọn ảnh trên server và upload ảnh
__ ĐÃ LÀM: __ Xóa ảnh thì xóa các ảnh trên server

## Tối ưu Repository design pattern
- Nếu muốn thay đổi từ mysql sang mongodb thì phải sửa lại hết repository bên trong các module
- -> chỉ cần thay đổi bên trong ModuleServiceProvider folder module
___Ví dụ___
- với UserRepository là sử dụng mysql và MongoUserRepository là sử dụng mongodb
- thì chỉ cần tên phương thức của 2 Repository giống nhau và đã được định nghĩa bên trong Interface
- khi đó chỉ cần vào ModuleServiceProvider: từ
```php
$this->app->singleton(
    UserRepositoryInterface::class,
    UserRepository::class
);
```
thành
```php
$this->app->singleton(
    UserRepositoryInterface::class,
    MongoUserRepository::class
);
```
khi đó ứng dụng vẫn chạy bình thường (nếu có lỗi render bản ghi thì có thể vào sửa ModuleServiceProvider singleton thành từng module một thay vì dùng foreach như vậy)


## Artisan Console:
### Tạo Mới Controller : do phần Module của Command đã tạo sẵn Controller Folder rồi nên mới kiểm tra xem có Controller Folder hay không và trả về lỗi
```terminal
php artisan module:make-controller ControllerName ModuleName 
```
### Tạo Mới Request : do phần Module của Command chưa tạo sẵn Request Folder nên phải tạo ra khi chạy câu lệnh
```terminal
php artisan module:make-request RequestName ModuleName 
```
### Tạo Mới Model: Tên Model và tên Module giống nhau ở project này
```terminal
php artisan module:make-model ModelName ModuleName 
```
### Tạo Mới Middleware
```terminal
php artisan module:make-middleware MiddlewareName ModuleName 
```
