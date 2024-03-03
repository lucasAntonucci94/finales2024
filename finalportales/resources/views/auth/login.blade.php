@extends('layouts.main')

@section('title','Iniciar Sesión')

@section('main')

<section>
    <div class=" container-fluid  containerMain bg-login p-2 container-padding">
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
            <div class="col-5 text-white  p-5 rounded border border-light bg-dark2">
                    <h1 class="text-center">Iniciar Sesión</h1>
                    <p class="text-center py-1">Ingrese sus credenciales para acceder al sitio.</p>
                    <form action="{{route('auth.login')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label font-weight-bold">Email</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="ingrese su email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label font-weight-bold">Contraseña</label>
                        <div class="input-group">
                            <input id="password" name="password" type="password" class="form-control" placeholder="ingrese su contraseña">
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="show-password-btn">
                                <i class="fa fa-solid fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info w-100 font-weight-bold">INGRESAR</button>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const showPasswordBtn = document.getElementById("show-password-btn");
    const eyeIcon = document.getElementById("eye-icon");

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

    showPasswordBtn.addEventListener("click", togglePasswordVisibility);

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

    passwordInput.addEventListener("input", () => {
        const value = passwordInput.value;

        if (value.length < 6) {
            passwordInput.classList.add("is-invalid");
        } else {
            passwordInput.classList.remove("is-invalid");
            passwordInput.classList.add("is-valid");
        }   
    });

</script>
@endsection
