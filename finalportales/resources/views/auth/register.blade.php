@extends('layouts.main')

@section('title','Register')

@section('main')
<section>
    <div class="container-fluid  containerMain bg-register p-2 container-padding">
        @if(Session::has('message.success'))
        <div class="alert alert-success alert-dismissible fade show text-center">

            <strong>{!!Session::get('message.success')!!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('message.error'))
        <div class="alert alert-danger alert-dismissible fade show text-center">

            <strong>{!!Session::get('message.error')!!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        <div class="row thisRow">
            <div class="col-5 text-white  p-5 rounded border border-light bg-dark2 mb-5">
                <h1 class="text-center">Registrarse</h1>
                <p class="text-center py-1">Ingrese los datos de su usuario.</p>
                <form class="row mx-auto" action="{{route('auth.register')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <label for="email"  class="form-label w-100 my-3 font-weight-bold">Email</label>
                                <input type="text" placeholder="ingrese su email" name="email" id="email" class="form-control w-100 @error('email') is-invalid @enderror"
                                @error('email') aria-describedby="error-email" @enderror
                                value="{{old('email')}}"
                                >
                                @error('email')
                                    <div id="error-email" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="name"  class="form-label w-100 my-3 font-weight-bold">Nombre</label>
                                <input type="text" name="name" placeholder="ingrese su nombre" id="name" class="form-control w-100 @error('name') is-invalid @enderror"
                                @error('name') aria-describedby="error-name" @enderror
                                value="{{old('name')}}"
                                >
                                @error('name')
                                    <div id="error-name" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div>
                            <!-- <div class="col-12">
                                <label for="surname"  class="form-label w-100 my-3 font-weight-bold">Apellido</label>
                                <input type="text" name="surname" placeholder="ingrese su apellido" id="surname" class="form-control w-100 @error('surname') is-invalid @enderror"
                                @error('surname') aria-describedby="error-surname" @enderror
                                value="{{old('surname')}}"
                                >
                                @error('surname')
                                    <div id="error-surname" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div> -->
                            <div class="col-12 d-none">
                                <label for="id_role"  class="form-label w-100 my-3">id_role</label>
                                <input type="text" name="id_role" id="id_role" class="form-control w-100 "
                                value="2"
                                >
                            </div>
                            <div class="col-12 ">
                                <label for="password" class="form-label my-3 font-weight-bold">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" placeholder="ingrese una contraseña" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    value="{{old('password')}}" >
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="show-password-btn">
                                            <i class="fa fa-solid fa-eye" id="eye-icon"></i>
                                        </button>
                                    </div>
                                @error('password')
                                    <div id="error-password" class="text-danger text-small"><p>{{ $message }}</p></div>
                                @enderror
                            </div>
                            <div class="col-12 ">
                                <label for="passwordVerify" class="form-label my-3 font-weight-bold">Verificar Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" placeholder="verifique la contraseña" name="passwordVerify" id="passwordVerify" class="form-control @error('passwordVerify') is-invalid @enderror"
                                    value="{{old('passwordVerify')}}" >
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="show-passwordVerify-btn">
                                            <i class="fa fa-solid fa-eye" id="eye-icon-verify"></i>
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-3 d-flex">
                        <button class="btn btn-info w-100 mx-3" type="submit"> <strong>ACEPTAR</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    const emailInput = document.getElementById("email");
    const nameInput = document.getElementById("name");
    const passwordInput = document.getElementById("password");
    const showPasswordBtn = document.getElementById("show-password-btn");
    const passwordVerifyInput = document.getElementById("passwordVerify");
    const showPasswordVerifyBtn = document.getElementById("show-passwordVerify-btn");
    const eyeIcon = document.getElementById("eye-icon");
    const eyeIconVerify = document.getElementById("eye-icon-verify");

    const togglePasswordVisibility = () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    };
    const togglePasswordVerifyVisibility = () => {
        if (passwordVerifyInput.type === "password") {
            passwordVerifyInput.type = "text";
            eyeIconVerify.classList.remove("fa-eye");
            eyeIconVerify.classList.add("fa-eye-slash");
        } else {
            passwordVerifyInput.type = "password";
            eyeIconVerify.classList.remove("fa-eye-slash");
            eyeIconVerify.classList.add("fa-eye");
        }
    };
    showPasswordBtn.addEventListener("click", togglePasswordVisibility);
    showPasswordVerifyBtn.addEventListener("click", togglePasswordVerifyVisibility);

    passwordInput.addEventListener("input", () => {
        const value = passwordInput.value;

        if (value.length < 6) {
            passwordInput.classList.add("is-invalid");
        } else {
            passwordInput.classList.remove("is-invalid");
            passwordInput.classList.add("is-valid");
        }   
    });
    passwordVerifyInput.addEventListener("input", () => {
        const password = passwordInput.value;
        const passwordVerify = passwordVerifyInput.value;

        if (passwordVerify !== password) {
            passwordVerifyInput.classList.add("is-invalid");
        } else {
            passwordVerifyInput.classList.remove("is-invalid");
            passwordVerifyInput.classList.add("is-valid");
        }   
    });
    emailInput.addEventListener("input", () => {
        const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const value = emailInput.value;

        if (!emailRegex.test(value)) {
            emailInput.classList.add("is-invalid");
        } else {
            emailInput.classList.remove("is-invalid");
            emailInput.classList.add("is-valid");
        }   
    });
    nameInput.addEventListener("input", () => {
        const value = nameInput.value;

        if (value.length < 4) {
            nameInput.classList.add("is-invalid");
        } else {
            nameInput.classList.remove("is-invalid");
            nameInput.classList.add("is-valid");
        }   
    });
</script>
@endsection
