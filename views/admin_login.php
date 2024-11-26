<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود ادمین</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <h1>ورود ادمین</h1>
    <form action="../controllers/AdminLoginController.php" method="post">
        <label for="email">ایمیل:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">رمز عبور:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" class="btn">ورود</button>
    </form>
    <?php if(isset($_GET['error'])){ ?>
       
        <script>
        toastr.error('ایمیل یا رمز عبور اشتباه است یا دسترسی ادمین ندارید ','کاربر عزیز')
         </script>

    <?php }

    ?>
</body>
</html>
