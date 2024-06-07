@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <strong>Success:</strong>{{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                                <a style="max-width: 150px; float: right; display:inline-block"
                                    href="{{ url('admin/add-edit-category') }}" class="btn btn-block btn-primary">Add New
                                    Category</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>Name</th>
                                            <th>Parent Category</th>
                                            <th>URL</th>
                                            <th>Created On</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                {{-- <td>{{ $category['id'] }}</td> --}}
                                                <td>{{ $category['category_name'] }}</td>
                                                <td>
                                                    @if ($category->parentcategory)
                                                        {{ $category->parentcategory->category_name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $category['url'] }}</td>
                                                <td>{{ date('F j, Y', strtotime($category['created_at'])) }}</td>
                                                <td>
                                                    @if ($category['status'] == 1)
                                                        <a class="updateCategoryStatus" id="category-{{ $category['id'] }}"
                                                            category_id="{{ $category['id'] }}" style="color:#3f6ed3"
                                                            href="javascript:void(0)">
                                                            <i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="updateCategoryStatus" id="category-{{ $category['id'] }}"
                                                            category_id="{{ $category['id'] }}" style="color: grey"
                                                            href="javascript:void(0)">
                                                            <i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-category/' . $category['id']) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="confirmDelete" title="Delete Category"
                                                        href="javascript:void(0)" record="category"
                                                        recordid="{{ $category['id'] }}"><i class="fas fa-trash"></i></a>
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
    @endsection
