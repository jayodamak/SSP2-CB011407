@extends('admin.layout.layout')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form name="productForm" id="productForm"
                                    @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}"
                                    @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                                    method="post" enctype="multipart/form-data">@csrf
                                    <div class="card-body">


                                        <div class="form-group">
                                            <label for="product_name">Product Name<span
                                                    style="color: rgb(196, 19, 19)">*</span></label>
                                            <input type="text" class="form-control" id="product_name" name="product_name"
                                                placeholder="Enter Product Name"
                                                @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}"
                                                @else value="{{ old('product_name') }}" @endif>
                                        </div>

                                        <div class="form-group">
                                            <label for="url">Product URL<span
                                                    style="color: rgb(196, 19, 19)">*</span></label>
                                            <input type="text" class="form-control" id="url" name="url"
                                                placeholder="Enter product URL"
                                                @if (!empty($product['url'])) value="{{ $product['url'] }}"
                                                @else value="{{ old('url') }}" @endif>
                                        </div>

                                        <div class="form-group">
                                            <label for="product_code">Product Code<span
                                                    style="color: rgb(196, 19, 19)">*</span></label>
                                            <input type="text" class="form-control" id="product_code" name="product_code"
                                                placeholder="Enter Product Code"
                                                @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}"
                                                @else value="{{ old('product_code') }}" @endif>
                                        </div>

                                        <div class="form-group">
                                            <label for="product_price">Product Price (Rs)<span
                                                    style="color: rgb(196, 19, 19)">*</span></label>
                                            <input type="text" class="form-control" id="product_price"
                                                name="product_price" placeholder="Enter Product Price"
                                                @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}"
                                                @else value="{{ old('product_price') }}" @endif>
                                        </div>

                                        <div class="form-group">
                                            <label for="product_discount">Product Discount (%)</label>
                                            <input type="text" class="form-control" id="product_discount"
                                                name="product_discount" placeholder="Enter Product Discount"
                                                @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}"
                                                @else value="{{ old('product_discount') }}" @endif>
                                        </div>

                                        <div class="form-group">
                                            <label for="category_name">Select Category<span
                                                    style="color: rgb(196, 19, 19)">*</span></label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($getCategories as $cat)
                                                    <option value="{{ $cat['id'] }}"
                                                        @if (!empty($product['category_id']) && $product['category_id'] == $cat['id']) selected @endif>
                                                        {{ $cat['category_name'] }}</option>
                                                    @if (!empty($cat['subcategories']))
                                                        @foreach ($cat['subcategories'] as $subcat)
                                                            <option value="{{ $subcat['id'] }}"
                                                                @if (!empty($product['category_id']) && $product['category_id'] == $subcat['id']) selected @endif>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subcat['category_name'] }}
                                                            </option>
                                                            @if (!empty($subcat['subcategories']))
                                                                @foreach ($subcat['subcategories'] as $subsubcat)
                                                                    <option value="{{ $subsubcat['id'] }}"
                                                                        @if (!empty($product['category_id']) && $product['category_id'] == $subsubcat['id']) selected @endif>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subsubcat['category_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="product_color">Product Color</label>
                                            <input type="text" class="form-control" id="product_color"
                                                name="product_color" placeholder="Enter Product Color"
                                                @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}"
                                                @else value="{{ old('product_color') }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="family_color">Family Color</label>
                                            <select name="family_color" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Black" @if (!empty($product['family_color']) && $product['family_color'] == 'Black') selected @endif>
                                                    Black</option>
                                                <option value="White" @if (!empty($product['family_color']) && $product['family_color'] == 'White') selected @endif>
                                                    White</option>
                                                <option value="Red" @if (!empty($product['family_color']) && $product['family_color'] == 'Red') selected @endif>
                                                    Red</option>
                                                <option value="Green" @if (!empty($product['family_color']) && $product['family_color'] == 'Green') selected @endif>
                                                    Green</option>
                                                <option value="Yellow" @if (!empty($product['family_color']) && $product['family_color'] == 'Yellow') selected @endif>
                                                    Yellow</option>
                                                <option value="Blue" @if (!empty($product['family_color']) && $product['family_color'] == 'Blue') selected @endif>
                                                    Blue</option>
                                                <option value="Pink" @if (!empty($product['family_color']) && $product['family_color'] == 'Pink') selected @endif>
                                                    Pink</option>
                                                <option value="Orange" @if (!empty($product['family_color']) && $product['family_color'] == 'Orange') selected @endif>
                                                    Orange</option>
                                                <option value="Grey" @if (!empty($product['family_color']) && $product['family_color'] == 'Grey') selected @endif>
                                                    Grey</option>
                                                <option value="Cyan" @if (!empty($product['family_color']) && $product['family_color'] == 'Cyan') selected @endif>
                                                    Cyan</option>
                                                <option value="Purple" @if (!empty($product['family_color']) && $product['family_color'] == 'Purple') selected @endif>
                                                    Purple</option>
                                                <option value="Brown" @if (!empty($product['family_color']) && $product['family_color'] == 'Brown') selected @endif>
                                                    Brown</option>
                                                <option value="Silver" @if (!empty($product['family_color']) && $product['family_color'] == 'Silver') selected @endif>
                                                    Silver</option>
                                                <option value="Gold" @if (!empty($product['family_color']) && $product['family_color'] == 'Gold') selected @endif>
                                                    Gold</option>
                                            </select>
                                        </div>


                                        {{-- <div class="form-group">
                                            <label for="product_weight">Product Quantity</label>
                                            <input type="text" class="form-control" id="product_weight"
                                                name="product_weight" placeholder="Enter Product Quantity"
                                                @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}"
                                                @else value="{{ old('product_weight') }}" @endif>
                                        </div> --}}

                                        <div class="form-group">
                                            <label>Added Attributes</label>
                                            <table style="background-color:rgb(213, 227, 236); width: 50%;"
                                                cellpdding="5">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>SKU</th>
                                                    <th>Size</th>
                                                    <th>Size (UK)</th>
                                                    <th>Price (RS)</th>
                                                    <th>Stock</th>
                                                    <th>Actions</th>
                                                </tr>
                                                @foreach ($product['attributes'] as $attribute)
                                                    <input type="hidden" name="attributeId[]"
                                                        value="{{ $attribute['id'] }}">
                                                    <tr>
                                                        <td>{{ $attribute['id'] }}</td>
                                                        <td>{{ $attribute['sku'] }}</td>
                                                        <td>{{ $attribute['size'] }}</td>
                                                        <td>{{ $attribute['uk_size'] }}</td>
                                                        <td>
                                                            <input style="width: 100px;" type="number" name="price[]"
                                                                value="{{ $attribute['price'] }}">
                                                        </td>
                                                        <td>
                                                            <input style="width: 100px;" type="number" name="stock[]"
                                                                value="{{ $attribute['stock'] }}">
                                                        </td>
                                                        <td>
                                                        @if ($attribute['status'] == 1)
                                                            <a class="updateAttributeStatus"
                                                                id="attribute-{{ $attribute['id'] }}"
                                                                attribute_id="{{ $attribute['id'] }}" style="color:#3f6ed3"
                                                                href="javascript:void(0)">
                                                                <i class="fas fa-toggle-on" status="Active"></i></a>
                                                        @else
                                                            <a class="updateAttributeStatus"
                                                                id="attribute-{{ $attribute['id'] }}"
                                                                attribute_id="{{ $attribute['id'] }}" style="color: grey"
                                                                href="javascript:void(0)">
                                                                <i class="fas fa-toggle-off" status="Inactive"></i></a>
                                                        @endif
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a class="confirmDelete" title="Delete Attribute"
                                                            href="javascript:void(0)" record="attribute"
                                                            recordid="{{ $attribute['id'] }}"><i
                                                                class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="form-group">
                                            <label>Add Attributes</label>
                                            <div class="field_wrapper">
                                                <div>
                                                    <input type="text" name="sku[]" id="sku"
                                                        placeholder="SKU" style="width: 120px;" />
                                                    <input type="text" name="size[]" id="size"
                                                        placeholder="Size" style="width: 120px;" />
                                                    <input type="text" name="uk_size[]" id="uk_size"
                                                        placeholder="Size(UK)" style="width: 120px;" />
                                                    <input type="text" name="price[]" id="price"
                                                        placeholder="Price" style="width: 120px;" />
                                                    <input type="text" name="stock[]" id="stock"
                                                        placeholder="Stock" style="width: 120px;" />
                                                    <a href="javascript:void(0);" class="add_button"
                                                        title="Add field">Add</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="product_image">Product Image<span
                                                    style="color: rgb(196, 19, 19)">*</span></label>
                                            <input type="file" class="form-control" id="product_image"
                                                name="product_image">
                                            @if (!empty($product['product_image']))
                                                <input type="hidden" name="current_product_image"
                                                    value="{{ $product['product_image'] }}">
                                                <div>
                                                    <a target="_blank"
                                                        href="{{ asset('front/images/products/' . $product['product_image']) }}">
                                                        <img style="width:100px; margin:10px"
                                                            src="{{ asset('front/images/products/' . $product['product_image']) }}">
                                                    </a>
                                                    <a class="confirmDelete" title="Delete Product Image"
                                                        href="javascript:void(0)" record="product-image"
                                                        recordid="{{ $product['id'] }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="product_fabric">Fabric</label>
                                            <select name="product_fabric" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($productFilters['fabricArray'] as $fabric)
                                                <option value="{{$fabric}}">{{$fabric}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="occassion">Occassion</label>
                                            <select name="occassion" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($productFilters['occasionArray'] as $occassion)
                                                <option value="{{$occassion}}">{{$occassion}}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="description">Product Description</label>
                                            <textarea class="form-control" rows="3" id="description" name="description"
                                                placeholder="Enter Product Description">
                                                @if (!empty($product['description']))
                                                {{ $product['description'] }}@else{{ old('description') }}
                                                @endif
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Search Keywords</label>
                                            <textarea class="form-control" rows="3" id="search_keywords" name="search_keywords"
                                                placeholder="Enter Product Search Keywords">
                                                @if (!empty($product['search_keywords']))
                                                {{ $product['search_keywords'] }}@else{{ old('search_keywords') }}
                                                @endif
                                                </textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                                placeholder="Enter Meta Title"
                                                @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}"
                                                @else value="{{ old('meta_title') }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description"
                                                name="meta_description" placeholder="Enter Meta Description"
                                                @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}"
                                                @else value="{{ old('meta_description') }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input type="text" class="form-control" id="meta_keywords"
                                                name="meta_keywords" placeholder="Enter Meta Keywords"
                                                @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}"
                                                @else value="{{ old('meta_keywords') }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="is_featured">Featured Item</label>
                                            <input type="checkbox" name="is_featured" value="Yes"
                                                @if (!empty($product->is_featured) && $product->is_featured == 'Yes') checked @endif>
                                        </div>
                                        
                                        


                                    </div>
                                    <!-- /.card-body -->

                                    <div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                </div>
                <!-- /.card -->



            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
