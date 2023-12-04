# Project End Laravel lesson online.unicode module 20

## về branch:
### master: branch gốc: chưa tích hợp CKEditor do chưa render ảnh khi thêm vào content trong textarea cùng với thiếu 1 icon để lấy ảnh trên laravel file manager serve
### fix-ckeditor-5: branch lỗi chưa fix điều kiện trên, khi nào fix xong thì merge vào master

## Khi Clone Project về thì phải tải về [file này](https://www.mediafire.com/file/go1sfwpnepgfmy6/public_backend.zip/file) rồi ném vào public/

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

