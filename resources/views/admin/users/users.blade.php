@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

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


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users</h3>
                                <a href="{{ url('admin/add-edit-user') }}" class="btn btn-primary float-right">Add New User</a>
                            </div>
                            <div class="card-body">
                                <table id="users" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Registered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ date('F j, Y', strtotime($user->created_at)) }}</td>
                                                {{-- <td>
                                                    <a href="{{ url('admin/add-edit-user/'.$user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDelete" record="user" recordid="{{ $user->id }}">Delete</a>
                                                   
                                                </td> --}}

                                                <td>
                                                    <a href="{{ url('admin/add-edit-user/'.$user->id) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="confirmDelete" title="Delete Category"
                                                        href="javascript:void(0)" record="user"
                                                        recordid="{{ $user->id }}"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function(){
        $(".updateUserStatus").click(function(){
            var status = $(this).children("i").attr("status");
            var user_id = $(this).attr("user_id");
            $.ajax({
                type: 'post',
                url: '/admin/update-user-status',
                data: {status:status, user_id:user_id},
                success: function(resp){
                    if(resp['status'] == 0){
                        $("#user-"+user_id).html("<i class='fas fa-toggle-off' status='Inactive'></i>");
                    }else if(resp['status'] == 1){
                        $("#user-"+user_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                    }
                }, error: function(){
                    alert("Error");
                }
            });
        });

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
