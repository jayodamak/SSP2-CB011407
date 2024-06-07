@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Password</li>
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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email" readonly="" style="background-color: 
                                            #c0c0c0;>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="admin_email">Email address</label>
                                        <input type="form-control" class="form-control" id="admin_email" value="{{
                                        Auth::guard('admin')->user()->email }}" readonly="" style="background-color: 
                                        #666;">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="current_pwd">Current Password</label>
                                        <input type="password" class="form-control" name="current_pwd" id="current_pwd"
                                            placeholder="Current Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_pwd">New Password</label>
                                        <input type="password" class="form-control" name="new_pwd" id="new_pwd"
                                            placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_pwd">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->


                    </div>
                    
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection
