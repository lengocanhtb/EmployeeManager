<?php
include('inc/connect.php');
if (isset($_SESSION['taikhoanadmin'])) {
  header("Location: index.php");
}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Đăng nhập</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <?php 
    if (isset($_GET['fail'])) {
        echo "
                    <script>
                        function Redirect() {
                        window.location = 'dangnhap.php';
                        }
                        alert('Sai tài khoản hoặc mật khẩu !') 
                        Redirect()
                    </script>
                    ";
    }
    ?>
    <body class="bg-primary" style="
        background-image: url(https://png.pngtree.com/thumb_back/fw800/background/20201026/pngtree-futuristic-shape-abstract-background-chemistry-technology-concept-for-website-image_438818.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">HỆ THỐNG QUẢN LÝ</h3></div>
                                    <div class="card-body">
                                        <form action="xuly.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="" name="tendangnhap" />
                                                <label for="inputEmail">Tên đăng nhập</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="" name="matkhau" />
                                                <label for="inputPassword">Mật khẩu</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="login">Đăng nhập</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
