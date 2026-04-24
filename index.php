<?php
session_start();
include "config.php";

// tài khoản admin
$username = "admin";
$password = "123456";

// xử lý login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["username"] === $username && $_POST["password"] === $password) {
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
    <title>Phần mềm kiến trúc AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #f8fafc;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .box {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        h3 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 16px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-tool {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            margin-bottom: 24px;
        }

        .btn-tool:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.5);
        }

        hr {
            border: none;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 0 0 24px 0;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #6366f1;
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        input::placeholder {
            color: #64748b;
        }

        .btn-login {
            padding: 14px;
            background: #334155;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #475569;
        }

        .error {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 16px;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .admin-open {
            position: absolute;
            top: 18px;
            right: 18px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #94a3b8;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
            backdrop-filter: blur(8px);
        }

        .admin-open:hover {
            color: #fff;
            background: rgba(15, 23, 42, 0.95);
            border-color: rgba(99, 102, 241, 0.4);
        }

        .footer {
            margin-top: 18px;
            color: #94a3b8;
            font-size: 0.85rem;
            text-align: center;
            opacity: 0.8;
        }

        @media (max-width: 520px) {
            body {
                align-items: flex-start;
                padding: 20px 0 40px;
                min-height: auto;
            }
            .box {
                width: min(100%, 100%);
                padding: 28px 20px;
                border-radius: 16px;
                margin: 0 16px;
            }
            h2 {
                font-size: 20px;
                margin-bottom: 18px;
            }
            .btn-tool {
                font-size: 15px;
                padding: 12px;
            }
            .admin-open {
                top: 12px;
                right: 12px;
                padding: 10px 12px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

<div class="box">
    <h2>💡 TOOL KIẾN TRÚC</h2>

    <a href="<?php echo $REAL_LINK; ?>" style="text-decoration: none;">
        <div class="btn-tool">👉 Mở tool kiến trúc</div>
    </a>
</div>

</body>
</html>