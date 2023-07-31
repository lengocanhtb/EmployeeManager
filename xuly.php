<?php
include('inc/connect.php');
$idnd = $_SESSION['id'];
//Đăng nhập
if (isset($_POST['login'])) {
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau  = $_POST['matkhau'];
    $query = "SELECT * FROM taikhoan WHERE tendangnhap='$tendangnhap'";
    $result = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {
        header("Location: dangnhap.php?fail=1");
    } else {
        $row = mysqli_fetch_array($result);
        if ($matkhau != $row['matkhau']) {
            header("Location: dangnhap.php?fail=1");
        } else {
            header("Location: index.php?msg=1");
            $_SESSION['taikhoanadmin'] = $tendangnhap;
            $_SESSION['id'] = $row['id'];
            $_SESSION['tenhienthi'] = $row['tenhienthi'];
        }
    }
}
//Nhân viên
if (isset($_POST['addnv'])) {
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $cccd  = $_POST['cccd'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $quequan = $_POST['quequan'];
    $tthn = $_POST['tthn'];
    $ngayvaolam = $_POST['ngayvaolam'];
    $tdhv  = $_POST['tdhv'];
    $phongban  = $_POST['phongban'];
    $chucvu = $_POST['chucvu'];
    //Upload ảnh
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_parts = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");
    $image = $_FILES['image']['name'];
    $target = "./image/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    //Kiểm tra xem email và số cccd đã tồn tại hay chưa
    $check = "SELECT * FROM nhanvien WHERE so_cccd = '{$cccd}' OR email = '{$email}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: nhanvien.php?msg=2");
    } else {
        $query = "INSERT INTO nhanvien ( ten, email, dien_thoai, gioi_tinh, so_cccd, ngay_sinh, que_quan, tinh_trang_hon_nhan, ngay_vao_lam, phong_ban, chuc_vu, trinh_do_hoc_van, anh) 
        VALUES ( '{$hoten}', '{$email}', '{$sdt}', '{$gioitinh}', '{$cccd}', '{$ngaysinh}', '{$quequan}', '{$tthn}', '{$ngayvaolam}', '{$phongban}', '{$chucvu}', '{$tdhv}', '{$image}') ";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: nhanvien.php?msg=1");
        } else {
            header("Location: nhanvien.php?msg=2");
        }
    }
}
if (isset($_POST['editnv'])) {
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $cccd  = $_POST['cccd'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $quequan = $_POST['quequan'];
    $tthn = $_POST['tthn'];
    $ngayvaolam = $_POST['ngayvaolam'];
    $tdhv  = $_POST['tdhv'];
    $phongban  = $_POST['phongban'];
    $chucvu = $_POST['chucvu'];
    $id  = $_POST['id'];
    //Kiểm tra xem email và số cccd đã tồn tại hay chưa
    $check = "SELECT * FROM nhanvien WHERE `id`!='{$id}' AND (so_cccd = '{$cccd}' OR email = '{$email}')";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: nhanvien.php?msg=2");
    } else {
        //Upload ảnh
        $file_name = $_FILES['image']['name'];
        if (empty($file_name)) {
            $query = "UPDATE `nhanvien` 
    SET `ten`='{$hoten}',`email`='{$email}',`dien_thoai`='{$sdt}',`gioi_tinh`='{$gioitinh}',`ngay_sinh`='{$ngaysinh}', `que_quan`='{$quequan}', `so_cccd`='{$cccd}', `tinh_trang_hon_nhan`='{$tthn}'
    ,`ngay_vao_lam`='{$ngayvaolam}', `phong_ban`='{$phongban}', `chuc_vu`='{$chucvu}', `trinh_do_hoc_van`='{$tdhv}'
    WHERE `id`='{$id}'";
            $result = mysqli_query($connect, $query);
            if ($result) {
                header("Location: nhanvien.php?msg=1");
            } else {
                header("Location: nhanvien.php?msg=2");
            }
        } else {
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_parts = explode('.', $_FILES['image']['name']);
            $file_ext = strtolower(end($file_parts));
            $expensions = array("jpeg", "jpg", "png");
            $image = $_FILES['image']['name'];
            $target = "./image/" . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $query = "UPDATE `nhanvien` 
    SET `ten`='{$hoten}',`email`='{$email}',`dien_thoai`='{$sdt}',`gioi_tinh`='{$gioitinh}',`ngay_sinh`='{$ngaysinh}', `que_quan`='{$quequan}', `so_cccd`='{$cccd}', `tinh_trang_hon_nhan`='{$tthn}'
    ,`ngay_vao_lam`='{$ngayvaolam}', `phong_ban`='{$phongban}', `chuc_vu`='{$chucvu}', `trinh_do_hoc_van`='{$tdhv}', `anh`='{$image}'
    WHERE `id`='{$id}'";
            $result = mysqli_query($connect, $query);
            if ($result) {
                header("Location: nhanvien.php?msg=1");
            } else {
                header("Location: nhanvien.php?msg=2");
            }
        }
    }
}
if (isset($_POST['deletenv'])) {
    $id  = $_POST['id'];
    $query1 = "DELETE FROM chamcong WHERE `nhanvien_id`='{$id}'";
    $result1 = mysqli_query($connect, $query1);
    $query2 = "DELETE FROM tangca WHERE `nhanvien_id`='{$id}'";
    $result2 = mysqli_query($connect, $query2);
    $query3 = "DELETE FROM hopdong WHERE `nhanvien_id`='{$id}'";
    $result3 = mysqli_query($connect, $query3);
    $query = "DELETE FROM nhanvien WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    header("Location: nhanvien.php?msg=1");
}
//Hợp đồng
if (isset($_POST['addhd'])) {
    $nhanvien = $_POST['nhanvien'];
    $vtcv  = $_POST['vtcv'];
    $chucdanh  = $_POST['chucdanh'];
    $khd = $_POST['khd'];
    $luongdaingo = $_POST['luongdaingo'];
    $giolamviec = $_POST['giolamviec'];
    $ctl = $_POST['ctl'];
    //Kiểm tra xem nhân viên đã tồn tại trong hợp đồng hay chưa
    $check = "SELECT * FROM hopdong WHERE nhanvien_id = '{$nhanvien}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: hopdong.php?msg=2");
    } else {
        $query = "INSERT INTO hopdong ( nhanvien_id , vitri_congviec, chuc_danh, kieu_hopdong, luong_dai_ngo, cau_truc_luong, gio_lamviec) 
        VALUES ( '{$nhanvien}', '{$vtcv}', '{$chucdanh}', '{$khd}', '{$luongdaingo}', '{$ctl}', '{$giolamviec}') ";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: hopdong.php?msg=1");
        } else {
            header("Location: hopdong.php?msg=2");
        }
    }
}
if (isset($_POST['edithd'])) {
    $nhanvien = $_POST['nhanvien'];
    $vtcv  = $_POST['vtcv'];
    $chucdanh  = $_POST['chucdanh'];
    $khd = $_POST['khd'];
    $luongdaingo = $_POST['luongdaingo'];
    $giolamviec = $_POST['giolamviec'];
    $ctl = $_POST['ctl'];
    $id  = $_POST['id'];
    //Kiểm tra xem nhân viên đã tồn tại trong hợp đồng hay chưa
    $check = "SELECT * FROM hopdong WHERE `id`!='{$id}' AND nhanvien_id = '{$nhanvien}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: hopdong.php?msg=2");
    } else {
        $query = "UPDATE `hopdong` 
    SET `nhanvien_id`='{$nhanvien}',`vitri_congviec`='{$vtcv}',`chuc_danh`='{$chucdanh}',`kieu_hopdong`='{$khd}'
    ,`luong_dai_ngo`='{$luongdaingo}', `cau_truc_luong`='{$ctl}', `gio_lamviec`='{$giolamviec}'
    WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: hopdong.php?msg=1");
        } else {
            header("Location: hopdong.php?msg=2");
        }
    }
}
if (isset($_POST['deletehd'])) {
    $id  = $_POST['id'];
    $query = "DELETE FROM hopdong WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    header("Location: hopdong.php?msg=1");
}
//Chấm công
if (isset($_POST['addcc'])) {
    $nhanvien = $_POST['nhanvien'];
    $ngay  = $_POST['ngay'];
    $tinhtrang  = $_POST['tinhtrang'];
    //Kiểm tra xem nhân viên đã chấm công ngày đó hay chưa
    $check = "SELECT * FROM chamcong WHERE nhanvien_id = '{$nhanvien}' AND ngay = '{$ngay}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: chamcong.php?msg=2");
    } else {
        $query = "INSERT INTO chamcong ( nhanvien_id , ngay, tinh_trang) 
        VALUES ( '{$nhanvien}', '{$ngay}', '{$tinhtrang}') ";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: chamcong.php?msg=1");
        } else {
            header("Location: chamcong.php?msg=2");
        }
    }
}
if (isset($_POST['editcc'])) {
    $nhanvien = $_POST['nhanvien'];
    $ngay  = $_POST['ngay'];
    $tinhtrang  = $_POST['tinhtrang'];
    $id  = $_POST['id'];
    //Kiểm tra xem nhân viên đã chấm công ngày đó hay chưa
    $check = "SELECT * FROM chamcong WHERE `id`!='{$id}' AND nhanvien_id = '{$nhanvien}' AND ngay = '{$ngay}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: chamcong.php?msg=2");
    } else {
        $query = "UPDATE `chamcong` 
    SET `nhanvien_id`='{$nhanvien}',`ngay`='{$ngay}',`tinh_trang`='{$tinhtrang}'
    WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: chamcong.php?msg=1");
        } else {
            header("Location: chamcong.php?msg=2");
        }
    }
}
if (isset($_POST['deletecc'])) {
    $id  = $_POST['id'];
    $query = "DELETE FROM chamcong WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    header("Location: chamcong.php?msg=1");
}
//Tăng ca
if (isset($_POST['addtc'])) {
    $nhanvien = $_POST['nhanvien'];
    $ngay  = $_POST['ngay'];
    $sogio  = $_POST['sogio'];
    //Kiểm tra xem nhân viên đã tăng ca ngày đó hay chưa
    $check = "SELECT * FROM tangca WHERE nhanvien_id = '{$nhanvien}' AND ngay = '{$ngay}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: tangca.php?msg=2");
    } else {
        $query = "INSERT INTO tangca ( nhanvien_id , ngay, so_gio) 
    VALUES ( '{$nhanvien}', '{$ngay}', '{$sogio}') ";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: tangca.php?msg=1");
        } else {
            header("Location: tangca.php?msg=2");
        }
    }
}
if (isset($_POST['edittc'])) {
    $nhanvien = $_POST['nhanvien'];
    $ngay  = $_POST['ngay'];
    $sogio  = $_POST['sogio'];
    $id  = $_POST['id'];
    //Kiểm tra xem nhân viên đã tăng ca ngày đó hay chưa
    $check = "SELECT * FROM tangca WHERE `id`!='{$id}' AND nhanvien_id = '{$nhanvien}' AND ngay = '{$ngay}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if ($row > 0) {
        header("Location: tangca.php?msg=2");
    } else {
        $query = "UPDATE `tangca` 
    SET `nhanvien_id`='{$nhanvien}',`ngay`='{$ngay}',`so_gio`='{$sogio}'
    WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
            header("Location: tangca.php?msg=1");
        } else {
            header("Location: tangca.php?msg=2");
        }
    }
}
if (isset($_POST['deletetc'])) {
    $id  = $_POST['id'];
    $query = "DELETE FROM tangca WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    header("Location: tangca.php?msg=1");
}
