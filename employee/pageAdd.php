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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Noto+Sans+TC:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/customBS.css" />
    <link rel="stylesheet" href="../css/pageDashboard3.css" />
    <style>

        .info-box {
            display: flex;
            justify-content: space-around;
            border: 1px solid black;
            margin-bottom: 30px;
            padding: 15px 0 5px 0;
        }
    </style>
</head>

<body class="bg-three d-flex">
  
  <nav class="d-flex sticky-top h100vh rounded-end-4">
    <!-- 綠色欄位 -->
    <div class="w280px h-100 bg-one position-relative rounded-end-5">
      <div
      class="green-area-icon h-100 w80px d-flex flex-column align-items-center"
      >
      <!-- 在自己的<div>上加2個class: bg-white shadow -->
       <!-- 將<i>上的原本的class: text-white 改成 text-one -->
      <!-- 會員 -->
        <div
          class="menu-btn mt-4 w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn1 "
        >
          <a href="../member/index.php"
            ><i class="fa-solid fa-user-group text-white fs-4"></i></a>
        </div>
        <!-- 商品 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn2"
        >
          <a href="../product/index.php"><i class="fa-solid fa-store text-white fs-4"></i></a>
        </div>
        <!-- 課程 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn3"
        >
          <a href="../lesson/index.php"
            ><i class="fa-regular fa-calendar text-white fs-4"></i
          ></a>
        </div>
        <!-- 部落格 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn4"
        >
          <a href="../blog/blogs.php"><i class="fa-brands fa-blogger text-white fs-4"></i></a>
        </div>
        <!-- 潛點地圖 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn5"
        >
          <a href="../DSite/dsList.php"><i class="fa-regular fa-map text-white fs-4"></i></a>
        </div>
        <!-- 媒體庫 -->
        <div
          class="menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-3 btn6"
        >
          <a href="../media/mediaLibrary.php"><i class="fa-regular fa-image text-white fs-4"></i></a>
        </div>
        <!-- 員工 -->
        <div
          class="bg-white shadow menu-btn w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-2 mt-auto btn7"
        >
          <a href="../employee/index.php"
            ><i class="fa-solid fa-address-card text-one fs-5"></i></a>
        </div>
        <div
          class="w50px h50px d-flex justify-content-center align-items-center rounded-4 mb-4"
        >
          <a href="#"
            ><i class="fa-solid fa-right-from-bracket text-white fs-5"></i
          ></a>
        </div>
      </div>
    </div>
    <!-- 白色欄位 -->
    <div class="w200px h-100 d-flex flex-column justify-content-center bg-white card rounded-4 position-absolute white-area">
      <!-- logo區 -->
      <div class="logobox container my-5 d-flex justify-content-center">
        <img
          src="../84901e5e1a173e3324e4ba59bf3b9b9f.png"
          alt=""
          class="logo"
        />
      </div>
      <!-- 新增按鈕，在a上放自己新增一筆的連結 -->
      <div class="addBtnBox container text-center mb-5 mt-4">
        <a href="./pageAdd.php">
          <button class="btn btn-one"><i class="fa-solid fa-square-plus"></i><span class="px-3">create new</span>
          </button>
        </a>
      </div>
      <!-- 目錄區(手風琴) -->
      <div>
        <div cla>
          <div class="accordion-title">
            <!-- 放上icon跟分類名稱 -->
            <button class="accordion-button text-one ms-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="menu-icon"><i class="fa-solid fa-address-card text-one fs-5"></i></span><span class="menu-title">員工管理</span></button>
          </div>
          <div>
            <div class="accordion-body mt-3">
              <!-- 放上子項目名稱&連結 -->
              <li class="list-a"><a href="#######" class="ms-1">員工列表</a></li>
            </div>
          </div>
        </div>
      </div>
      <!-- 其他功能 -->
      <div class="container mb-3 mt-auto ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-share-nodes"></i>
          <span class="ps-2">share</span>
        </div>
      </div>
      <div class="container mb-3 ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-clock"></i>
          <span class="ps-2">recent</span>
        </div>
      </div>
      <div class="container mb-3 ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-star"></i>
          <span class="ps-2">favorite</span>
        </div>
      </div>
      <div class="container mb-5 ms-4">
        <div class="ps-3 text-four">
          <i class="fa-solid fa-trash-can"></i>
          <span class="ps-2">delete</span>
        </div>
      </div>
    </div>
  </nav>

    <div class="container">
        <h1 class="my-5 text-one">新增員工資料</h1>
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
                    <label class="btn btn-outline-two text-one" for="exampleCheck1">所有者</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck2" value="3">
                    <label class="btn btn-outline-two text-one" for="exampleCheck2">管理員</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck3" value="4">
                    <label class="btn btn-outline-two text-one" for="exampleCheck3">編輯者</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="role_id" class="btn-check" id="exampleCheck4" value="5">
                    <label class="btn btn-outline-two text-one" for="exampleCheck4">工讀生</label>
                </div>
            </div>
            <div class="mb-3 form-check">
                <!-- 單選 -->
                <span>是否還在職</span>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck5" value="1" name="is_valid">
                    <label class="btn btn-outline-two text-one" for="exampleCheck5">在職中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="btn-check" id="exampleCheck6" value="0" name="is_valid">
                    <label class="btn btn-outline-two text-one" for="exampleCheck6">已離職</label>
                </div>
            </div>
            <button type="submit" class="btn btn-one" id="creatConfirmButton">送出</button>
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