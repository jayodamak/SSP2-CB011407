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
                                <form name="bannerForm" id="bannerForm"
                                    @if (empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}"
                                    @else action="{{ url('admin/add-edit-banner/' . $banner['id']) }}" @endif
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="banner_image">Banner Image (Light Mode)<span
                                                style="color: rgb(196, 19, 19)">*</span></label>
                                        <input type="file" class="form-control" id="banner_image" name="banner_image">
                                        @if (!empty($banner['banner_image']))
                                            <input type="hidden" name="current_banner_image"
                                                value="{{ $banner['banner_image'] }}">
                                            <div>
                                                <a target="_blank"
                                                    href="{{ asset('front/images/banners/' . $banner['banner_image']) }}">
                                                    <img style="width:500px; margin:10px"
                                                        src="{{ asset('front/images/banners/' . $banner['banner_image']) }}">
                                                </a>
                                                <a class="confirmDelete" title="Delete Banner Image"
                                                    href="javascript:void(0)" record="banner-image"
                                                    recordid="{{ $banner['id'] }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="banner_image_dark">Banner Image (Dark Mode)<span
                                                style="color: rgb(196, 19, 19)">*</span></label>
                                        <input type="file" class="form-control" id="banner_image_dark" name="banner_image_dark">
                                        @if (!empty($banner['banner_image_dark']))
                                            <input type="hidden" name="current_banner_image_dark"
                                                value="{{ $banner['banner_image_dark'] }}">
                                            <div>
                                                <a target="_blank"
                                                    href="{{ asset('front/images/banners/' . $banner['banner_image_dark']) }}">
                                                    <img style="width:500px; margin:10px"
                                                        src="{{ asset('front/images/banners/' . $banner['banner_image_dark']) }}">
                                                </a>
                                                <a class="confirmDelete" title="Delete Dark Banner Image"
                                                    href="javascript:void(0)" record="banner_image_dark"
                                                    recordid="{{ $banner['id'] }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="type">Banner Type<span
                                            style="color: rgb(196, 19, 19)">*</span></label>
                                        <select name="type" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Slider" @if (!empty($banner['type']) && $banner['type'] == 'Slider') selected @endif>
                                                Slider</option>
                                            <option value="Fix 1" @if (!empty($banner['type']) && $banner['type'] == 'Fix 1') selected @endif>
                                                Fix 1</option>
                                            <option value="Fix 2" @if (!empty($banner['type']) && $banner['type'] == 'Fix 2') selected @endif>
                                                Fix 2</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="heading">Banner Heading</label>
                                        <input type="text" class="form-control" id="heading" name="heading"
                                            placeholder="Enter Banner Heading"
                                            value="{{ old('heading', $banner['heading'] ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Banner Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Banner Title"
                                            value="{{ old('title', $banner['title'] ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Banner Description</label>
                                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter Banner Description">{{ old('description', $banner['description'] ?? '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Button Title</label>
                                        <input type="text" class="form-control" id="button" name="button"
                                            placeholder="Enter Button Title"
                                            value="{{ old('button', $banner['button'] ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Banner Link</label>
                                        <input type="text" class="form-control" id="link" name="link"
                                            placeholder="Enter Banner Link"
                                            @if (!empty($banner['link'])) value="{{ $banner['link'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="alt">Banner Alt</label>
                                        <input type="text" class="form-control" id="alt" name="alt"
                                            placeholder="Enter Banner Alt"
                                            @if (!empty($banner['alt'])) value="{{ $banner['alt'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="sort">Sort</label>
                                        <input type="number" class="form-control" id="sort" name="sort"
                                            placeholder="Enter Sort Order"
                                            @if (!empty($banner['sort'])) value="{{ $banner['sort'] }}" @endif>
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
