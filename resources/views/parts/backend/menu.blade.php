<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item {{request()->is(trim(route('admin.'.$name.'.index', [], false), '/*')) || request()->is(trim(route('admin.'.$name.'.index', [], false))) ? 'active': false}}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{$name}}"
       aria-expanded="true" aria-controls="collapse{{$name}}">
        <i class="fas fa-fw fa-cog"></i>
        <span>{{$title}}</span>
    </a>
    <div id="collapse{{$name}}"
         class="collapse {{request()->is(trim(route('admin.'.$name.'.index', [], false), '/*')) || request()->is(trim(route('admin.'.$name.'.index', [], false))) ? 'show': false}}"
         aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{strtoupper($name)}}:</h6>
            <a class="collapse-item" href="{{route('admin.'.$name.'.index')}}">Danh Sách</a>
            <a class="collapse-item" href="{{route('admin.'.$name.'.create')}}">Thêm Mới</a>
        </div>
    </div>
</li>
