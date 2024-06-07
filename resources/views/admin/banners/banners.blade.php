@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Banners</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Banners</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Banners</h3>
                                <a style="max-width: 150px; float: right; display:inline-block"
                                   href="{{ url('admin/add-edit-banner') }}" class="btn btn-block btn-primary">Add
                                    Banner</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="banners" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Light Mode Image</th>
                                            <th>Dark Mode Image</th>
                                            <th>Type</th>
                                            <th>Link</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $banner)
                                        {{-- {@dd($banner)} --}}
                                            <tr>
                                                <td>
                                                    @if (!empty($banner['banner_image']))
                                                        <img src="{{ asset('front/images/banners/' . $banner['banner_image']) }}" style="width: 200px;">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($banner['banner_image_dark']))
                                                        <img src="{{ asset('front/images/banners/' . $banner['banner_image_dark']) }}" style="width: 200px;">
                                                    @endif
                                                </td>
                                                <td>{{ $banner['type'] }}</td>
                                                <td>{{ $banner['link'] }}</td>
                                                <td>{{ $banner['title'] }}</td>
                                                <td>
                                                    @if ($banner['status'] == 1)
                                                        <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}"
                                                           banner_id="{{ $banner['id'] }}" style="color:#3f6ed3"
                                                           href="javascript:void(0)">
                                                            <i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}"
                                                           banner_id="{{ $banner['id'] }}" style="color: grey"
                                                           href="javascript:void(0)">
                                                            <i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-banner/' . $banner['id']) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="confirmDelete" name="Banner" title="Delete Banner"
                                                       href="javascript:void(0)" record="banner"
                                                       recordid="{{ $banner['id'] }}"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
<script>
    // Script to update banner status
    $(document).ready(function(){
        $(".updateBannerStatus").click(function(){
            var status = $(this).children("i").attr("status");
            var banner_id = $(this).attr("banner_id");
            $.ajax({
                type: 'post',
                url: '/admin/update-banner-status',
                data: {status:status, banner_id:banner_id},
                success: function(resp){
                    if(resp['status'] == 0){
                        $("#banner-"+banner_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                    }else if(resp['status'] == 1){
                        $("#banner-"+banner_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                    }
                }, error: function(){
                    alert("Error");
                }
            });
        });

        // Script to confirm deletion of banner
        $(".confirmDelete").click(function(){
            var record = $(this).attr("record");
            var recordid = $(this).attr("recordid");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/delete-"+record+"/"+recordid;
                }
            });
        });
    });
</script>
@endsection
