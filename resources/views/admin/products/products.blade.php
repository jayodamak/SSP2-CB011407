@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                <h3 class="card-title">Products</h3>
                                <a style="max-width: 150px; float: right; display:inline-block"
                                    href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-primary">Add New
                                    Product</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Color</th>
                                            {{-- <th>Product Price</th> --}}
                                            {{-- <th>Product Quantity</th> --}}
                                            <th>Category</th>
                                            {{-- <th>Parent Category</th> --}}
                                            <th>Featured</th>
                                            {{-- <th>Created On</th> --}}
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                {{-- <td>{{ $product['id'] }}</td> --}}
                                                
                                                <td>
                                                    @if (!empty($product['product_image']))
                                                        <img src="{{ asset('front/images/products/' . $product['product_image']) }}" style="width: 200px;">
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>{{ $product['product_code'] }}</td>
                                                <td>{{ $product['family_color'] }}</td>
                                                {{-- <td>{{ $product['product_price'] }}</td> --}}
                                                {{-- <td>{{ $product['product_weight'] }}</td> --}}
                                                <td>{{ $product['category']['category_name'] }}</td>
                                                {{-- <td>
                                                    @if (isset($product['category']['parentcategory']['category_name']))
                                                        {{ $product['category']['parentcategory']['category_name'] }}
                                                    @endif
                                                </td> --}}
                                                <td>{{ $product['is_featured'] }}</td>
                                                {{-- <td>{{ date('F j, Y, g:i a', strtotime($product['created_at'])) }}</td> --}}
                                                <td>
                                                    @if ($product['status'] == 1)
                                                        <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                            product_id="{{ $product['id'] }}" style="color:#3f6ed3"
                                                            href="javascript:void(0)">
                                                            <i class="fas fa-toggle-on" status="Active"></i></a>
                                                    @else
                                                        <a class="updateProductStatus" id="product-{{ $product['id'] }}"
                                                            product_id="{{ $product['id'] }}" style="color: grey"
                                                            href="javascript:void(0)">
                                                            <i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-product/' . $product['id']) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="confirmDelete" title="Delete product"
                                                        href="javascript:void(0)" record="product"
                                                        recordid="{{ $product['id'] }}"><i class="fas fa-trash"></i></a>
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
