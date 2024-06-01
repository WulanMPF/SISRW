<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            height: 92vh;
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
        .register {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .register h4 {
            font-weight: bold;
            color: #323232;
            margin-bottom: 10px;
        }

        .register h3 {
            font-weight: bold;
            color: #BB955C;
            margin-bottom: 30px;
        }

        .register img {
            width: 100px;
            margin-bottom: 20px;
        }

        .register input {
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #ced4da;
            width: 100%;
            margin-bottom: 15px;
        }

        .register button {
            background-color: #BB955C;
            color: white;
            border-radius: 10px;
            padding: 10px;
            border: none;
            width: 100%;
            margin-top: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* warna background sesuaikan dengan halaman Anda */
            padding: 20px 0;
            color:#a8a8a8;
        }
    </style>
</head>
<body>
    <div class="register">
        <div class="text-center">
            <img src="{{ asset('adminlte/dist/img/sisrw/logo3.png') }}" height="100" alt="SISRW Logo"> <!-- Ensure this path is correct -->
            <h4>SISTEM INFORMASI RW 05</h4>
            <h3>Create Account</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input id="nik" type="text" name="nik" placeholder="Masukkan NIK" required class="form-control shadow-sm px-4" value="{{ old('nik') }}">
                    @if ($errors->has('nik'))
                        <span class="text-danger">{{ $errors->first('nik') }}</span>
                    @endif
                </div>
                {{-- <div class="form-group">
                    <input id="name" type="text" name="name" placeholder="Nama Lengkap" required class="form-control shadow-sm px-4" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div> --}}
                <div class="form-group">
                    <input id="email" type="email" name="email" placeholder="Email" required class="form-control shadow-sm px-4" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" name="password" placeholder="Password" required class="form-control shadow-sm px-4">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="form-control shadow-sm px-4">
                </div>
                <button type="submit" class="btn btn-block shadow-sm">Register</button>
                <a href="{{ route('login') }}" class="link-secondary text-decoration-none mt-3">Already have an account? Login</a>
            </form>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" style="font-family: Poppins;">
                    <strong>Copyright &copy; Jurusan Teknologi Informasi Politeknik Negeri Malang</strong>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
