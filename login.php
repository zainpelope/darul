<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-bxHeOj4B66i2GVXB2nTqAZvqakOaIZ7M4HSvx9hsJ0x8Fz6A4IYgFJkDo5O+WggCkkXIHwK7H+ON7zOxyBCzw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        .password-container {
            position: relative;
        }

        .password-container input[type="password"] {
            padding-right: 2.5rem;
        }

        .password-container .eye-icon {
            position: absolute;
            top: 50%;
            right: 0.5rem;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Login</h5>
                    </div>
                    <div class="card-body">
                        <form action="proses_login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="mb-3 password-container">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role:</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="1">Tata Usaha</option>
                                    <option value="2">Kepala Sekolah</option>
                                    <option value="3">Guru</option> <!-- Tambahkan opsi ini -->
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w8fX8IIKjtzrdXnBzm0FKNbq8ZIeD3dyxOQzyb1X8n/rE5Q2h8I/AGmG1tFfGKw/" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-0mQ+ZB1IrzOn4NUOjqXxdNS65VZQf3V2Jb6L4V5BfHpt7Z4b6Nc2eybYeUU66R9kjyJ0+GgZ5Eijc6DPpO7Jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>