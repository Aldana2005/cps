<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .full-height {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .card {
            max-width: 500px;
            width: 100%;
            margin: 0 15px;
        }
        .input-group-prepend .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container full-height">
    <div class="card shadow-lg p-6">
        <div class="card-header text-center bg-transparent border-0">
            <img src="img/logo.png" class="img-fluid mb-1" alt="Logo" style="max-width: 130px;">
        </div>

        <div class="card-body">
            <h3 class="text-center mb-4">INICIAR SESIÓN</h3>

            <!-- Mostrar mensaje de error general -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf <!-- Blade directive para el token CSRF -->

                <div class="form-group mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese su correo electrónico">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña">

                        <div class="input-group-append">
                            <span class="input-group-text" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>
                        <a class="btn btn-link p-0" href="/password/reset">
                            Olvidé mi contraseña
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger btn-block">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>

        <div class="card-footer text-center bg-transparent">
            <h6>Alcaldía Municipal de Tesalia</h6>
            <small><strong>"#SIPODEMOS" 2024-2027</strong></small>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#togglePassword').on('click', function () {
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
</body>
</html>
