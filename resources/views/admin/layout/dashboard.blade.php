@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-large"></i></span>
                            <a style="color: #000000;" href="{{ url('admin/categories') }}">
                                <div class="info-box-content">
                                    <span class="info-box-text">Categories</span>
                                    <span class="info-box-number">{{ $categoriesCount }}</span>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tshirt"></i></span>
                            <a style="color: #000000;" href="{{ url('admin/products') }}">
                                <div class="info-box-content">
                                    <span class="info-box-text">Products</span>
                                    <span class="info-box-number">{{ $productsCount }}</span>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.info-box -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-bag"></i></span>
                            <a style="color: #000000;" href="{{ url('admin/orders') }}">
                                <div class="info-box-content">
                                    <span class="info-box-text">Orders</span>
                                    <span class="info-box-number">{{ $ordersCount }}</span>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.info-box -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <a style="color: #000000;" href="{{ url('admin/users') }}">
                                <div class="info-box-content">
                                    <span class="info-box-text">Users</span>
                                    <span class="info-box-number">{{ $usersCount }}</span>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
