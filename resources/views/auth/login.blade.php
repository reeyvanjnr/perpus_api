<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpus API</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { margin: 0; background: #f4f6f9; color: #333; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        
        .card {
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 400px;
            border: 1px solid #f1f2f6;
        }
        .logo-area {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo-area i { font-size: 32px; color: #6c5ce7; margin-bottom: 10px; }
        .logo-area h2 { margin: 0; font-size: 22px; color: #2d3436; }
        .logo-area p { margin: 5px 0 0; font-size: 13px; color: #636e72; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #636e72; margin-bottom: 6px; }
        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }
        .form-group input:focus { border-color: #6c5ce7; }
        
        .btn-submit {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: 0.2s;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.2);
        }
        .btn-submit:hover { background: #5b4cc4; }

        .error-box {
            background: #ffeaa7;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
            color: #d63031;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="logo-area">
            <i class="fa-solid fa-book-open"></i>
            <h2>PerpusAPI</h2>
            <p>Silakan masuk untuk mengelola sistem</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username..." value="{{ old('username') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Masuk ke Dashboard</button>
        </form>
    </div>

</body>
</html>