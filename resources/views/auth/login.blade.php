@extends('layout')
@section('head')
    <title>Login</title>
@endsection
@section('main_content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Admin Login</p>

                                    <!-- Validation Errors -->
                                    <x-errors />

                                    <form class="mx-1 mx-md-4" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <!-- Email -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="email" class="block mt-1 w-full form-control" type="email"
                                                    name="email" :value="old('email')" required autofocus />
                                                <label class="form-label" for="form3Example3c">Email</label>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="password" class="form-control block mt-1 w-full" type="password"
                                                    name="password" required autocomplete="current-password" />
                                                <label class="form-label" for="form3Example4c">Пароль</label>
                                            </div>
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" id="remember_me" name="remember"
                                                type="checkbox" />
                                            <label for="remember_me" class="form-check-label">Запомнить меня</label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <div class="flex items-center justify-end mt-4">
                                                <button class="ml-3 btn btn-primary btn-lg">Войти</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
