<?
// 建立員工資料頁

?>

<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            width: 65%;
            padding: 50px 0;
        }

        .title {
            padding: 0 0 30px 0;
            text-align: center;
        }

        .info-box {
            display: flex;
            justify-content: space-around;
            border: 1px solid black;
            margin-bottom: 30px;
            padding: 15px 0 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">編輯員工資料</h1>
        <form action="./doInsert.php" method="POST">
            <div class="info info-box">
                <div class="mb-3 text-center">
                    <label for="em_id" class="form-label">員工 ID</label>
                    <!-- 這邊會放一個奔跑的圈圈 -->
                    <div name="em_id" id="em_id" class="form-text"></div>
                </div>

                <div class="mb-3 text-center">
                    <label for="em_hire_date" class="form-label">註冊日期</label>
                    <!-- 這裡要放今天日期 -->
                    <div id="em_hire_date" class="form-text"></div>
                </div>
            </div>
            <div class="mb-3" hidden>
                <label for="emIdHidden" class="form-label">員工 ID</label>
                <input name="em_id" type="text" class="form-control" id="emIdHidden" value="">
            </div>
            <div class="mb-3">
                <label for="em_full_name" class="form-label">姓名</label>
                <input name="em_full_name" type="text" class="form-control" id="em_full_name" value="">
                <span class="form-text text-danger" idn="nameErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="em_email" class="form-label">Email</label>
                <input name="em_email" type="text" class="form-control" id="em_email"></input>
                <span class="form-text text-danger" idn="emailErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="em_password" class="form-label">密碼</label>
                <input name="em_password" class="form-control" id="em_password" type="password"></input>
                <span class="form-text text-danger" idn="passwordErrorText"></span>
            </div>
            <div class="mb-3">
                <label for="em_password2" class="form-label">確認密碼</label>
                <input class="form-control" id="em_password2" type="password"></input>
                <span class="form-text text-danger" idn="passwordErrorText2"></span>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>權限角色</span>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck1"  value="2" >
                    <label class="btn btn-outline-danger" for="exampleCheck1">所有者</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck2" value="3">
                    <label class="btn btn-outline-danger" for="exampleCheck2">管理員</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck3" value="4">
                    <label class="btn btn-outline-danger" for="exampleCheck3">編輯者</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck4" value="5">
                    <label class="btn btn-outline-danger" for="exampleCheck4">工讀生</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>是否還在職</span>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck5" value="1" name="is_valid">
                    <label class="btn btn-outline-danger" for="exampleCheck5">在職中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck6" value="0" name="is_valid">
                    <label class="btn btn-outline-danger" for="exampleCheck6">已離職</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="creatConfirmButton">送出</button>
        </form>
    </div>


    <script>
        // 欄位判斷
        const form = document.querySelector("form");
        const emFullName = document.querySelector("#em_full_name");
        const nameErrorText = document.querySelector("[idn=nameErrorText]");
        const emEmail = document.querySelector("#em_email");
        const emailErrorText = document.querySelector("[idn=emailErrorText]");
        const emPassword = document.querySelector("#em_password");
        const passwordErrorText = document.querySelector("[idn=passwordErrorText]")
        const emPassword2 = document.querySelector("#em_password2");
        const passwordErrorText2 = document.querySelector("[idn=passwordErrorText2]")

        

        // 動態的欄位判斷
        emFullName.addEventListener("input", e => {
            nameErrorText.textContent = "";
            let isChinese = /^[\u4e00-\u9fa5]+$/;
            if (!isChinese.test(emFullName.value) || emFullName.value == "") {
                e.preventDefault();
                nameErrorText.textContent = "請輸入中文姓名";
            }
        })
        emEmail.addEventListener("input", e=>{
            emailErrorText.textContent = "";
            let emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            if(!emailRule.test(emEmail.value) || emEmail.value == ""){
                e.preventDefault();
                emailErrorText.textContent = "請輸入正確的Email格式";
            }
        })
        emPassword.addEventListener("change", e=>{
            passwordErrorText.textContent = "";
            if(emPassword2.value != ""){
                if(emPassword.value != emPassword2.value){
                    e.preventDefault();
                    passwordErrorText.textContent = "兩次輸入的密碼不相同，請重新輸入";
                    passwordErrorText2.textContent = "兩次輸入的密碼不相同，請重新輸入";
                }else{
                    passwordErrorText2.textContent = "";
                }
            }
        })
        emPassword2.addEventListener("change", e=>{
            passwordErrorText2.textContent = "";
            if(emPassword.value != ""){
                if(emPassword.value != emPassword2.value){
                    e.preventDefault();
                    passwordErrorText2.textContent = "兩次輸入的密碼不相同，請重新輸入";
                    passwordErrorText.textContent = "兩次輸入的密碼不相同，請重新輸入";
                }else{
                    passwordErrorText.textContent = "";
                }
            }
        })

        

        // 提交表單後的欄位判斷
        form.addEventListener("submit", e => {
            let isChinese = /^[\u4e00-\u9fa5]+$/;
            let emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;

            nameErrorText.textContent = "";
            emailErrorText.textContent = "";
            passwordErrorText.textContent = "";
            passwordErrorText2.textContent = "";


            if (!isChinese.test(emFullName.value) || emFullName.value == "") {
                e.preventDefault();
                nameErrorText.textContent = "請輸入中文姓名";
            }
            if(!emailRule.test(emEmail.value) || emEmail.value == ""){
                e.preventDefault();
                emailErrorText.textContent = "請輸入正確的Email格式";
            }
            if(emPassword2.value != ""){
                if(emPassword.value != emPassword2.value){
                    e.preventDefault();
                    passwordErrorText.textContent = "兩次輸入的密碼不相同，請重新輸入";
                    passwordErrorText2.textContent = "兩次輸入的密碼不相同，請重新輸入";
                }else{
                    passwordErrorText2.textContent = "";
                }
            }
            if(emPassword.value != ""){
                if(emPassword.value != emPassword2.value){
                    e.preventDefault();
                    passwordErrorText2.textContent = "兩次輸入的密碼不相同，請重新輸入";
                    passwordErrorText.textContent = "兩次輸入的密碼不相同，請重新輸入";
                }else{
                    passwordErrorText.textContent = "";
                }
            }
            // comfirm更新要新增的提示
            if (confirm("確認要更改這筆員工資料?") == false) {
                e.preventDefault();
            }
        })
    </script>
</body>

</html>