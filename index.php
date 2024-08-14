<?
// 登入頁面
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>登入頁面</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <h1>後台登入</h1>
        <form action="./doLogin.php" method="POST">
            <div class="mb-3">
                <label for="em_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="em_email" name="em_email" aria-describedby="emailHelp">
                <span class="form-text text-danger" idn="emailErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="em_password" class="form-label">密碼</label>
                <input type="password" class="form-control" id="em_password" name="em_password">
                <span class="form-text text-danger" idn="passwordErrorText"></span>
            </div>
            <button type="submit" class="btn btn-primary">登入</button>
        </form>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        const emEmail = document.querySelector("#em_email");
        const emailErrorText = document.querySelector("[idn=emailErrorText]");
        const emPassword = document.querySelector("#em_password");
        const passwordErrorText = document.querySelector("[idn=passwordErrorText]")

        form.addEventListener("submit", e => {
            emailErrorText.textContent = "";
            passwordErrorText.textContent = "";
            if (emEmail.value == "") {
                e.preventDefault();
                emailErrorText.textContent = "請輸入Email";
            }
            if (emPassword.value == "") {
                e.preventDefault();
                passwordErrorText.textContent = "請輸入密碼";
            }
        })
    </script>
</body>

</html>