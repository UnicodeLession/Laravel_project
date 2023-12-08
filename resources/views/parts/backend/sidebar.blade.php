<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{asset('front-end/image/laravel-icon.png')}}" alt="" srcset="" style="height: 32px; width: 32px ">
        </div>
        <div class="sidebar-brand-text mx-3">{{env('APP_NAME')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tổng Quan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @include('parts.backend.menu', [
        'name' => 'categories',
        'title' => 'Danh Mục'
    ])

    @include('parts.backend.menu', [
        'name' => 'courses',
        'title' => 'Bài Học'
    ])

    <hr class="sidebar-divider d-none d-md-block">

    @include('parts.backend.menu', [
    'name' => 'teachers',
    'title' => 'Giảng Viên'
    ])
    @include('parts.backend.menu', [
        'name' => 'users',
        'title' => 'Người Dùng'
    ])
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <hr class="sidebar-divider d-none d-md-block">
</ul>

