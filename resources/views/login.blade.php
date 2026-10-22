<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Perpus API</title>
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { 
            margin: 0; 
            background: linear-gradient(135deg, #f4f6f9 0%, #e2e8f0 100%); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        .login-card { 
            background: white; 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            width: 100%;
            max-width: 400px; 
            border: 1px solid #f1f2f6;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header .logo-icon {
            font-size: 32px;
            color: #6c5ce7;
            background: #f1f0ff;
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 15px auto;
        }
        h2 { 
            font-size: 20px; 
            font-weight: 700; 
            color: #2d3436; 
            margin: 0; 
        }
        p {
            font-size: 13px;
            color: #636e72;
            margin: 5px 0 0 0;
        }
        label { 
            font-size: 13px; 
            font-weight: 600; 
            color: #636e72; 
            display: block;
            margin-bottom: 8px; 
        }
        input { 
            width: 100%; 
            padding: 12px 15px; 
            margin-bottom: 20px; 
            box-sizing: border-box; 
            border: 1px solid #dfe6e9; 
            border-radius: 10px; 
            font-size: 14px;
            background: #fafbfc;
            outline: none;
            transition: 0.2s;
        }
        input:focus { border-color: #6c5ce7; background: #fff; }
        button { 
            width: 100%; 
            padding: 12px; 
            background: #6c5ce7; 
            color: white; 
            border: none; 
            border-radius: 10px; 
            cursor: pointer; 
            font-weight: 600; 
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.2);
            transition: 0.2s;
        }
        button:hover { background: #5b4cc4; }
        .error { 
            background: #ffeaa7;
            color: #d63031; 
            padding: 10px;
            border-radius: 8px;
            font-size: 13px; 
            margin-bottom: 20px; 
            text-align: center; 
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <h2>Perpus API Login</h2>
            <p>Silakan masuk menggunakan akun admin</p>
        </div>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label>Username</label>
            <input type="text" name="username" required placeholder="Masukkan username" autocomplete="off">
            
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password">
            
            <button type="submit">Masuk ke Dashboard</button>
        </form>
    </div>
</body>
</html>