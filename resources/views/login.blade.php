@extends('layouts.app')

@section('content')

<div class="login-page">

    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo mt-2">
                <a href="login.html">
                    <img src="{{ asset('logos/top-logo.png') }}" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    {{-- <li><a href="register.html">Register</a></li> --}}
                </ul>
            </div>
        </div>
    </div>

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('theme/vendors/images/login-page-img.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-success">Se Connecter</h2>
                        </div>
                        <form>
                            {{-- <div class="select-role">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="{{ asset('theme/vendors/images/briefcase.svg') }}" class="svg" alt=""></div>
										<span>I'm</span>
										Manager
									</label>
                                    <label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="{{ asset('theme/vendors/images/person.svg') }}" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label>
                                </div>
                            </div> --}}
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder=" Adresse Email">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Se Rappeler</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password"><a href="forgot-password.html">Mot de Passe Oublié?</a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
                                        <a class="btn btn-success btn-lg btn-block" href="index.html">Connexion</a>
                                    </div>
                                    {{-- <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="register.html">Register To Create Account</a>
                                    </div> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
