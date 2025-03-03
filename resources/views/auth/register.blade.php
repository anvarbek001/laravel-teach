<!-- @format -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Snippet - GoSNippets</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/login.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body oncontextmenu="return false" class="snippet-body">
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
                <div class="panel border bg-white">
                    <div class="panel-heading">
                        <h3 class="pt-3 font-weight-bold">Ro'yxatdan o'tish</h3>
                    </div>
                    <div class="panel-body p-3">
                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf
                            <div class="form-group py-2">
                                <div class="input-field">
                                    <span class="far fa-user p-2"></span>
                                    <input name="name" type="text" placeholder="Ismingizni kiriting" required />
                                </div>
                            </div>
                            <div class="form-group py-2">
                                <div class="input-field">
                                    <span class="far fa-user p-2"></span>
                                    <input name="email" type="email" placeholder="Email ni kiriting" required />
                                </div>
                            </div>
                            <div class="form-group py-1 pb-2">
                                <div class="input-field mb-3">
                                    <span class="fas fa-lock px-2"></span>
                                    <input name="password" type="password" placeholder="Parolni kiriting" required />
                                    <button class="btn bg-white text-muted">
                                        <span class="far fa-eye-slash"></span>
                                    </button>
                                </div>
                                <div class="input-field">
                                    <span class="fas fa-lock px-2"></span>
                                    <input name="password_confirmation" type="password" placeholder="Parolni tasdiqlang"
                                        required />
                                    <button class="btn bg-white text-muted">
                                        <span class="far fa-eye-slash"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-inline">
                                <input type="checkbox" name="remember" id="remember" />
                                <label for="remember" class="text-muted">Eslab qolish</label>
                                <a href="#" id="forgot" class="font-weight-bold">Parolni unutdingizmi?</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Jo'natish</button>
                            <div class="text-center pt-4 text-muted">
                                Ro'yxatdan o'tganmisiz? <a href="{{ route('login') }}">Kirish</a>
                            </div>
                        </form>
                    </div>
                    <div class="mx-3 my-2 py-2 bordert">
                        <div class="text-center py-3">
                            <a href="https://wwww.facebook.com" target="_blank" class="px-2">
                                <img src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg"
                                    alt="" />
                            </a>
                            <a href="https://www.google.com" target="_blank" class="px-2">
                                <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png"
                                    alt="" />
                            </a>
                            <a href="https://www.github.com" target="_blank" class="px-2">
                                <img src="https://www.freepnglogos.com/uploads/512x512-logo-png/512x512-logo-github-icon-35.png"
                                    alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"></script>
</body>

</html>
