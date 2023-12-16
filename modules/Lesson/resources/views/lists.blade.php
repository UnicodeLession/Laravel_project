@extends('layouts.backend')
@push('css')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div>
            @if(session('msg'))
                <div class="alert alert-{{session('type')}} text-center">
                    {{session('msg')}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <a href="{{route('admin.lessons.create')}}" class="btn btn-primary">Thêm mới</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Video</th>
{{--                            khi nhấp vào video thì sẽ chuyển hướng đến detail của video đó--}}
                            <th>Học Thử</th>
                            <th>Lượt Xem</th>
                            <th>Vị Trí</th>
{{--                           Vị Trí Trong Khóa--}}
                            <th>Thời Lượng (giờ)</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Video</th>
                            {{--                            khi nhấp vào video thì sẽ chuyển hướng đến detail của video đó--}}
                            <th>Học Thử</th>
                            <th>Lượt Xem</th>
                            <th>Vị Trí</th>
                            {{--                           Vị Trí Trong Khóa--}}
                            <th>Thời Lượng (giờ)</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                        </tfoot>
                    </table>
                    @include('parts.backend.delete')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('scripts')
    <script>
        $('#dataTable').DataTable({
            ajax: "{{route('admin.lessons.data')}}",
            processing: true,
            serverSide: true,
            columns: [
                {"data": "image"},
                {"data": "name"},
                {"data": "exp"},
                {"data": "created_at"},
                {"data": "edit"},
                {"data": "delete"},
            ],
            order: [2, 'asc'],
            columnDefs : [
                // tắt tính năng sort
                { "orderable" : false, "targets": 4 },
                { "orderable" : false, "targets": 5 }
            ]
        });
    </script>
@endsection
