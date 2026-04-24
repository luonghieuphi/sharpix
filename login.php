<?php
session_start();

$username = "admin";
$password = "666888";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($_POST["username"] ?? '') === $username && ($_POST["password"] ?? '') === $password) {
        $_SESSION["login"] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Sai tài khoản!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #09121f, #101e35);
            color: #f8fafc;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            width: min(420px, calc(100% - 32px));
            padding: 32px;
            border-radius: 24px;
            background: rgba(11, 23, 40, 0.95);
            box-shadow: 0 18px 48px rgba(0, 0, 0, 0.45);
            text-align: center;
            border: 1px solid rgba(120, 144, 186, 0.18);
        }
        h1 {
            margin-top: 0;
            font-size: 2rem;
            letter-spacing: 0.02em;
            color: #8ab6f5;
        }
        p {
            color: #cbd5e1;
            margin-bottom: 24px;
        }
        .input-group {
            margin-bottom: 18px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
            font-size: 0.95rem;
        }
        .input-group input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid rgba(120, 144, 186, 0.2);
            background: #101a2d;
            color: #e2e8f0;
            font-size: 1rem;
        }
        .input-group input:focus {
            outline: none;
            border-color: #7ea8f5;
        }
        button {
            width: 100%;
            padding: 14px 16px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #2f6bb8, #4d8fe7);
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        button:hover { transform: translateY(-1px); }
        .error {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
            border: 1px solid rgba(248, 113, 113, 0.25);
        }

        @media (max-width: 520px) {
            body {
                align-items: flex-start;
                padding: 20px 0 40px;
            }
            .card {
                width: calc(100% - 32px);
                padding: 26px 18px;
                margin: 0 16px;
            }
            h1 {
                font-size: 1.75rem;
            }
            .input-group input,
            button {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Đăng nhập Admin</h1>
        <p>Nhập thông tin để quản lý link chuyển hướng.</p>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label for="username">Tài khoản</label>
                <input id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>