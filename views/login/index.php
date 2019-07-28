<?php include '../layout/config.php';?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ECN - Login</title>
<!-- icon -->
<link rel="icon" href="../../img/ecn_logo_icon.ico">
  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.css" rel="stylesheet">
  <link href="../../css/custom.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container container-fullwidth">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
              <div class="text-center my-5 text-white">
                 <!-- <h2> ECN Management System </h2> -->
            </div>
            </div>
              <div class="col-lg-6">
                <div class="p-5">
                <div class="text-center">
                                <img src="../../img/kubota-logo.png" alt="kubota logo" class="img-fluid px-3 px-sm-4 mt-3 mb-4">
                </div>
                <hr>
                  <div class="text-center my-3">
                    <h1 class="h3  text-gray-900 mb-2 ">เข้าสู่ระบบ</h1>
                    <p class="small">ยินดีต้อนรับเข้าสู่ระบบ ECN Management</p>

                  </div>
                  <form method="post" action="chklogin.php" class="user">
                    <div class="form-group">
                      <input type="text" autofocus="autofocus" name="user_name" class="form-control form-control-user"  placeholder="Username" style="font-size:1rem;" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="user_password" class="form-control form-control-user " placeholder="Password" style="font-size:1rem;" required>
                      <div class="mt-3">
                      <p class="small">กรุณาระบุชื่อผู้ใช้งานและรหัสผ่านเพื่อเข้าสู่ระบบ</p>
                      </div>
                    </div>
                    <div class="mt-3"></div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                    <button type='submit' class="btn btn-primary btn-user btn-block">
                      Login
                    </button>

                  </form>
                  <hr>
                  <div class="text-center">
                    <p class="small"> Copyright &copy; ECN Management <?= date('Y')?> | v.<?=$app['version']?> | Last update <?=$app['updated']?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>
</body>

</html>
