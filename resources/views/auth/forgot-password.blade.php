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
            <h3>Reset Password</h3>
            <form action="{{ route('forgot-password-act') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <!-- /.col -->
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}');
        </script>
    @endif
</body>
</html>
