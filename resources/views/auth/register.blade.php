<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Akun</title>
</head>

<body>

    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <label>REGISTER</label>
                        <hr>

                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" id="name"
                                placeholder="Masukkan Nama Lengkap">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password"
                                placeholder="Konfirmasi Password">
                        </div>

                        <button class="btn btn-register btn-block btn-success">REGISTER</button>

                    </div>
                </div>
                <div class="text-center" style="margin-top: 15px">
                    Sudah punya akun? <a href="login">Silahkan Login</a>
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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $(".btn-register").click(function() {

                var dataRegis = new Object();

                dataRegis.name = $("#name").val();
                dataRegis.email = $("#email").val();
                dataRegis.password = $("#password").val();
                dataRegis.confirm_password = $("#confirm_password").val();

                if (dataRegis.name.length == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Nama Lengkap Wajib Diisi !'
                    });
                } else if (dataRegis.email.length == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Username Wajib Diisi !'
                    });

                } else if (dataRegis.password.length == "") {
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Password Wajib Diisi !'
                    });
                } else {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/register',
                        type: 'POST',
                        dataType: 'json',
                        data: dataRegis,
                        success: function(status) {
                            if (status['status'] == true) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Register Berhasil!',
                                    text: 'silahkan login!'
                                });
                                $("#name").val('');
                                $("#email").val('');
                                $("#password").val('');
                                $("#confirm_password").val('');
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Register Gagal!',
                                    text: 'silahkan coba lagi!'
                                });
                            }
                            console.log(status);
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
