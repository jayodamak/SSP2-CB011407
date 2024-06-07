@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/add-edit-user/' . ($user->id ?? '')) }}" method="post" id="userForm" name="userForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="" disabled>Select Role</option>
                                            <option value="1" {{ (isset($user->role) && $user->role == '1') ? 'selected' : '' }}>Administrator</option>
                                            <option value="2" {{ (isset($user->role) && $user->role == '2') ? 'selected' : '' }}>Customer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ isset($user->id) ? 'Current Password' : 'Password' }}</label>
                                        <input type="password" class="form-control" id="password" name="password" {{ isset($user->id) ? 'disabled' : 'required' }} value="{{ $user->password ?? '' }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
