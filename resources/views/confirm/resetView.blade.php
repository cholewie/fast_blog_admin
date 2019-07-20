<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>重置密码</title>
</head>
<body>

<p>
    请点击下面的链接完成重置：
    <a href="{{ route('admin.reset_view', $reset->token) }}">
        {{ route('admin.reset_view', $reset->token) }}
    </a>
</p>

<p>
    如果这不是您本人的操作，请忽略此邮件。
</p>
</body>
</html>