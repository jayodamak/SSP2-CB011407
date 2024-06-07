@extends('front.layout.layout')
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="pb-lg-20 pb-16">
            <div class="bg-body-secondary py-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-body" href="#">Home</a></li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Register</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="text-center pt-13 mb-12 mb-lg-15">
                    <div class="text-center">
                        <h2 class="fs-36px mb-11 mb-lg-14">Register</h2>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 mx-auto">
                    <form id="registerForm" method="POST" action="/user/register">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="visually-hidden">Name*</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                            <span id="register-name"></span>
                        </div>
                        <div class="mb-6">
                            <label for="mobile" class="visually-hidden">Mobile*</label>
                            <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control">
                            <span id="register-mobile"></span>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="visually-hidden">E-mail*</label>
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                            <span id="register-email"></span>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="visually-hidden">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="form-control">
                            <span id="register-password"></span>
                        </div>
                        <div class="mb-7">
                            <label for="password_confirmation" class="visually-hidden">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                placeholder="Confirm Password" class="form-control">
                            <span id="register-confirm_password"></span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        {{-- <div class="border-bottom mt-10"></div> --}}

                        {{-- <button type="submit">Sign Up</button> --}}

                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection


{{-- <form id="registerForm" method="POST" action="/user/register">
    @csrf
    <input type="text" name="name" id="name" placeholder="Name">
    <span id="register-name"></span>

    <input type="text" name="mobile" id="mobile" placeholder="Mobile">
    <span id="register-mobile"></span>

    <input type="email" name="email" id="email" placeholder="Email">
    <span id="register-email"></span>

    <input type="password" name="password" id="password" placeholder="Password">
    <span id="register-password"></span>

    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
    <span id="register-confirm_password"></span>

    <button type="submit">Sign Up</button>
</form> --}}
