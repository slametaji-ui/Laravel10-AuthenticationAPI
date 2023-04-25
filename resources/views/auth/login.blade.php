<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
</head>

<body>

    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <label>Login</label>
                        <hr>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                        </div>

                        <button class="btn btn-login btn-block btn-success">LOG IN</button>

                    </div>
                </div>
                <div class="text-center" style="margin-top: 15px">
                    Belum punya akun? <a href="register">Silahkan Registrasi</a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $(".btn-login").click(function() {

                var dataLogin = new Object();

                dataLogin.email = $("#email").val();
                dataLogin.password = $("#password").val();

                if (dataLogin.email.length == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Email Wajib Diisi !'
                    });

                } else if (dataLogin.password.length == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Password Wajib Diisi !'
                    });
                } else {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/login',
                        type: 'POST',
                        dataType: 'json',
                        headers: {"Authorization": "Bearer"},
                        data: dataLogin,
                        success: function(status) {
                            if (status['status'] == true) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Login Berhasil!',
                                    text: 'Selamat Datang'
                                });
                                $("#email").val('');
                                $("#password").val('');
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Login Gagal!',
                                    text: status['message']
                                });
                            }
                        },
                        error: function(status) {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps!',
                                text: 'server error!'
                            });
                        }
                    })
                }
            });
        });
    </script>

</body>

</html>
