<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
    exit;
}

// Kiểm tra xem file config có tồn tại không trước khi gọi
if (file_exists("config.php")) {
    include "config.php";
} else {
    $REAL_LINK = ""; // Giá trị mặc định nếu chưa có file
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_link = trim($_POST["link"] ?? '');
    if ($new_link !== '') {
        // Sử dụng var_export để đảm bảo không bị lỗi cú pháp PHP dù link chứa ký tự đặc biệt nào
        $safe_link = var_export($new_link, true);
        file_put_contents("config.php", "<?php\n\$REAL_LINK = $safe_link;\n");
        $msg = "Đã cập nhật link thành công!";
        
        // Cập nhật lại biến để hiển thị ngay lập tức
        $REAL_LINK = $new_link;
    } else {
        $msg = "Link không được để trống.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0b1120, #121827);
            color: #f8fafc;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: min(620px, calc(100% - 32px));
            padding: 34px;
            border-radius: 24px;
            background: rgba(15, 23, 42, 0.96);
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
        }
        h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 2rem;
        }
        p {
            color: #cbd5e1;
            margin-bottom: 24px;
        }
        .message {
            margin-bottom: 20px;
            padding: 16px;
            border-radius: 16px;
            background: rgba(34, 197, 94, 0.14);
            color: #bbf7d0;
            border: 1px solid rgba(34, 197, 94, 0.25);
        }
        .field {
            margin-bottom: 18px;
        }
        .field label {
            display: block;
            margin-bottom: 10px;
            color: #94a3b8;
        }
        .field input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 14px;
            background: #0f172a;
            color: #e2e8f0;
            font-size: 1rem;
        }
        .field input:focus {
            outline: none;
            border-color: #60a5fa;
        }
        .actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        .actions button,
        .actions a {
            flex: 1;
            min-width: 140px;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        .actions button {
            border: none;
            background: linear-gradient(135deg, #2563eb, #818cf8);
            color: white;
            cursor: pointer;
        }
        .actions a {
            background: rgba(148, 163, 184, 0.15);
            color: #e2e8f0;
        }
        .actions button:hover,
        .actions a:hover { transform: translateY(-1px); }
        .current-link {
            margin-bottom: 24px;
            padding: 18px;
            border-radius: 18px;
            background: rgba(148, 163, 184, 0.1);
            color: #e2e8f0;
            word-break: break-all;
        }

        @media (max-width: 520px) {
            body {
                align-items: flex-start;
                padding: 20px 0 40px;
            }
            .container {
                width: calc(100% - 32px);
                padding: 26px 18px;
                margin: 0 16px;
            }
            h1 {
                font-size: 1.8rem;
            }
            p {
                font-size: 0.95rem;
            }
            .actions {
                flex-direction: column;
            }
            .actions button,
            .actions a {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trang Admin</h1>
        <p>Quản lý link chuyển hướng cho người dùng.</p>

        <?php if (!empty($msg)): ?>
            <div class="message"><?php echo $msg; ?></div>
        <?php endif; ?>

        <div class="current-link">
            <strong>Link hiện tại:</strong><br>
            <?php echo htmlspecialchars($REAL_LINK ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <form method="POST">
            <div class="field">
                <label for="link">Link mới</label>
                <input id="link" name="link" type="url" value="<?php echo htmlspecialchars($REAL_LINK ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="https://example.com" required>
            </div>
            <div class="actions">
                <button type="submit">Lưu link</button>
                <a href="logout.php">Đăng xuất</a>
            </div>
        </form>
    </div>
</body>
</html>