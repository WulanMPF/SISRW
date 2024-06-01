<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('images/bglogin.jpg') no-repeat center center fixed; /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            position: relative;
            z-index: 1;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(10px); /* Adjust the blur level as needed */
            z-index: -1;
        }

        .container-fluid {
            max-width: 1100px;
        }

        .login,
        .image {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .login h4 {
            font-weight: bold;
            color: #323232;
            margin-bottom: 30px;
        }
        .login h2 {
            font-weight: bold;
            color: #BB955C;
            margin-bottom: 30px;
        }

        .login img {
            width: 100px;
            margin-bottom: 20px;
        }

        .login input {
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #ced4da;
        }

        .login button {
            background-color: #BB955C;
            color: white;
            border-radius: 10px;
            padding: 10px;
            border: none;
            width: 100%;
            margin-top: 20px;
        }

        .bg-image {
            background-image: url('images/forlogin.png'); /* Ensure this path is correct */
            background-position: center;
            background-repeat: no-repeat;
            background-size: 80%;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* warna background sesuaikan dengan halaman Anda */
            padding: 20px 0;
            color:#a8a8a8;
        }

        .form-links {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- The content half -->
            <div class="col-md-6 d-flex login">
                <div class="text-center">
                    <img src="{{ asset('adminlte/dist/img/sisrw/logo3.png') }}" height="100" alt="SISRW Logo"> <!-- Ensure this path is correct -->
                    <h4>SISTEM INFORMASI RW 05</h4>
                    <h2>Login</h2>
                    <form action="{{ route('login-proses') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input id="inputNIK" name="nik" type="text" placeholder="Masukkan NIK" required class="form-control shadow-sm px-4">
                        </div>
                        <div class="form-group mb-3">
                            <input id="inputPassword" name="password" type="password" placeholder="Masukkan Password" required class="form-control shadow-sm px-4">
                        </div>
                        <div class="form-links">
                            <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
                            <a href="{{ route('register') }}" class="text-center">Register Account</a>
                        </div>
                        <button type="submit" class="btn btn-block shadow-sm">Login</button>
                    </form>
                </div>
            </div>
            <!-- The image half -->
            <div class="col-md-6 bg-image d-none d-md-block"></div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <strong>Copyright &copy; Jurusan Teknologi Informasi Politeknik Negeri Malang</strong>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
