<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('inc/head.php') ?>
</head>

<body class="sb-nav-fixed">
    <?php include('inc/header.php') ?>
    <div id="layoutSidenav">
        <?php include('inc/menu.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <?php $currentDate = date('Y-m-d'); ?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Danh sách nhân viên</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <?php if (isset($_GET['msg'])) {
                                if ($_GET['msg'] == 1) { ?>
                                    <div class="alert alert-success">
                                        <strong>Thành công</strong>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-danger">
                                        <strong>Đã tồn tại dữ liệu!</strong>
                                    </div>
                                <?php }  ?>
                            <?php }  ?>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalAdd">
                                Thêm mới
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Phòng ban</th>
                                        <th>Chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT *
                                    FROM nhanvien 
                                    ORDER BY id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDes = "exampleModalDes" . $arUser["id"];
                                        $idModelDel = "exampleModalDel" . $arUser["id"];
                                        $idModelEdit = "exampleModalEdit" . $arUser["id"];
                                    ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            <td><img style="width: 130px !important;height: 170px !important;" src="./image/<?php echo $arUser['anh'] ?>"></td>
                                            <td><?php echo $arUser["ten"] ?></td>
                                            <td><?php echo $arUser["email"] ?> </td>
                                            <td><?php echo $arUser["dien_thoai"] ?></td>
                                            <td><?php echo $arUser["phong_ban"] ?> </td>
                                            <td><?php echo $arUser["chuc_vu"] ?></td>
                                            <td style="width : 130px !important">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#<?php echo $idModelDes ?>">
                                                    Chi tiết
                                                </button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $idModelEdit ?>">
                                                    Sửa
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $idModelDel ?>">
                                                    Xóa
                                                </button>
                                                <!--Dele-->
                                                <div class="modal fade" id="<?php echo $idModelDel ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa ?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Nhân viên : <?php echo $arUser["ten"] ?>
                                                                <form action="xuly.php" method="post">
                                                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                    <div class="modal-footer" style="margin-top: 20px">
                                                                        <button style="width:100px" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                            Đóng
                                                                        </button>
                                                                        <button style="width:100px" type="submit" class="btn btn-danger" name="deletenv"> Xóa</button>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Dele-->
                                            </td>

                                        </tr>
                                        <!-- Modal Update-->
                                        <div class="modal fade" id="<?php echo $idModelEdit ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="xuly.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Họ tên:</label>
                                                                        <input type="text" class="form-control" id="category-film" name="hoten" value="<?php echo $arUser["ten"] ?>" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Email:</label>
                                                                        <input type="email" class="form-control" id="category-film" name="email" value="<?php echo $arUser["email"] ?>" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Số điện thoại:</label>
                                                                        <input type="text" pattern="\d{10,11}" title="Số điện thoại không hợp lệ" value="<?php echo $arUser["dien_thoai"] ?>" class="form-control" id="category-film" name="sdt" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Số căn cước công dân:</label>
                                                                        <input type="text" pattern="[0-9]{12}" title="CCCD phải có 12 chữ số" value="<?php echo $arUser["so_cccd"] ?>" class="form-control" id="category-film" name="cccd" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Giới tính:</label>
                                                                        <select class="form-select" aria-label="Default select example" name="gioitinh" required>
                                                                            <option value="<?php echo $arUser["gioi_tinh"] ?>" selected><?php echo $arUser["gioi_tinh"] ?></option>
                                                                            <option value="Nam">Nam</option>
                                                                            <option value="Nữ">Nữ</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Ngày sinh:</label>
                                                                        <input type="date" max="<?php echo $currentDate; ?>" class="form-control" value="<?php echo $arUser["ngay_sinh"] ?>" id="category-film" name="ngaysinh" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Tình trạng hôn nhân:</label>
                                                                        <select class="form-select" aria-label="Default select example" name="tthn" required>
                                                                            <?php if ($arUser["tinh_trang_hon_nhan"] == "Độc thân") { ?>
                                                                                <option value="Độc thân" selected>Độc thân</option>
                                                                                <option value="Đã kết hôn">Đã kết hôn</option>
                                                                                <option value="Ly hôn">Ly hôn</option>
                                                                            <?php } else if ($arUser["tinh_trang_hon_nhan"] == "Đã kết hôn") { ?>
                                                                                <option value="Độc thân">Độc thân</option>
                                                                                <option value="Đã kết hôn" selected>Đã kết hôn</option>
                                                                                <option value="Ly hôn">Ly hôn</option>
                                                                            <?php } else { ?>
                                                                                <option value="Độc thân">Độc thân</option>
                                                                                <option value="Đã kết hôn">Đã kết hôn</option>
                                                                                <option value="Ly hôn" selected>Ly hôn</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Ngày vào làm:</label>
                                                                        <input type="date" class="form-control" id="category-film" value="<?php echo $arUser["ngay_vao_lam"] ?>" name="ngayvaolam" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Trình độ học vấn:</label>
                                                                        <select class="form-select" aria-label="Default select example" name="tdhv" required>
                                                                            <?php if ($arUser["trinh_do_hoc_van"] == "Đại học") { ?>
                                                                                <option value="Đại học" selected>Đại học</option>
                                                                                <option value="Cao Đẳng">Cao Đẳng</option>
                                                                                <option value="Trung học phổ thông">Trung học phổ thông</option>
                                                                                <option value="Trung học cơ sở">Trung học cơ sở</option>
                                                                            <?php } else if ($arUser["trinh_do_hoc_van"] == "Cao Đẳng") { ?>
                                                                                <option value="Đại học">Đại học</option>
                                                                                <option value="Cao Đẳng" selected>Cao Đẳng</option>
                                                                                <option value="Trung học phổ thông">Trung học phổ thông</option>
                                                                                <option value="Trung học cơ sở">Trung học cơ sở</option>
                                                                            <?php } else if ($arUser["trinh_do_hoc_van"] == "Trung học phổ thông") { ?>
                                                                                <option value="Đại học">Đại học</option>
                                                                                <option value="Cao Đẳng">Cao Đẳng</option>
                                                                                <option value="Trung học phổ thông" selected>Trung học phổ thông</option>
                                                                                <option value="Trung học cơ sở">Trung học cơ sở</option>
                                                                            <?php } else { ?>
                                                                                <option value="Đại học">Đại học</option>
                                                                                <option value="Cao Đẳng">Cao Đẳng</option>
                                                                                <option value="Trung học phổ thông">Trung học phổ thông</option>
                                                                                <option value="Trung học cơ sở" selected>Trung học cơ sở</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Phòng ban:</label>
                                                                        <select class="form-select" aria-label="Default select example" name="phongban" required>
                                                                            <?php
                                                                            $phongBans = array("Phòng Kế toán", "Phòng Hành chính", "Phòng Nhân sự", "Phòng Kinh doanh", "Phòng Marketing");
                                                                            foreach ($phongBans as $phongBan) {
                                                                                $selected = ($phongBan == $arUser["phong_ban"]) ? "selected" : "";
                                                                                echo "<option value='$phongBan' $selected>$phongBan</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Chức vụ:</label>
                                                                        <input type="text" class="form-control" id="category-film" value="<?php echo $arUser["chuc_vu"] ?>" name="chucvu" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Quê quán:</label>
                                                                        <input type="text" class="form-control" id="category-film" value="<?php echo $arUser["que_quan"] ?>" name="quequan" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="category-film" class="col-form-label">Chọn ảnh mới nếu muốn thay đổi ảnh :</label>
                                                                        <input type="hidden" name="size" value="1000000">
                                                                        <input type="file" placeholder="" class="form-control" name="image"/>
                                                                    </div>
                                                                    <div class="col-3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer mt-4">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary" name="editnv">Lưu</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Update-->
                                        <!-- Modal Des-->
                                        <div class="modal fade" id="<?php echo $idModelDes ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="xuly.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Họ tên:</label>
                                                                        <input type="text" readonly class="form-control" id="category-film" name="hoten" value="<?php echo $arUser["ten"] ?>" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Email:</label>
                                                                        <input type="email" readonly class="form-control" id="category-film" name="email" value="<?php echo $arUser["email"] ?>" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Số điện thoại:</label>
                                                                        <input type="text" readonly pattern="\d{10,11}" title="Số điện thoại không hợp lệ" value="<?php echo $arUser["dien_thoai"] ?>" class="form-control" id="category-film" name="sdt" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Số căn cước công dân:</label>
                                                                        <input type="text" readonly pattern="[0-9]{12}" title="CCCD phải có 12 chữ số" value="<?php echo $arUser["so_cccd"] ?>" class="form-control" id="category-film" name="cccd" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Giới tính:</label>
                                                                        <input type="text" readonly value="<?php echo $arUser["gioi_tinh"] ?>" class="form-control" id="category-film" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Ngày sinh:</label>
                                                                        <input type="date" readonly class="form-control" value="<?php echo $arUser["ngay_sinh"] ?>" id="category-film" name="ngaysinh" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Tình trạng hôn nhân:</label>
                                                                        <input type="text" readonly value="<?php echo $arUser["tinh_trang_hon_nhan"] ?>" class="form-control" id="category-film" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Ngày vào làm:</label>
                                                                        <input type="date" readonly class="form-control" id="category-film" value="<?php echo $arUser["ngay_vao_lam"] ?>" name="ngayvaolam" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Trình độ học vấn:</label>
                                                                        <input type="text" readonly value="<?php echo $arUser["trinh_do_hoc_van"] ?>" class="form-control" id="category-film" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Phòng ban:</label>
                                                                        <input type="text" readonly class="form-control" id="category-film" value="<?php echo $arUser["phong_ban"] ?>" name="phongban" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Chức vụ:</label>
                                                                        <input type="text" readonly class="form-control" id="category-film" value="<?php echo $arUser["chuc_vu"] ?>" name="chucvu" required>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="category-film" class="col-form-label">Quê quán:</label>
                                                                        <input type="text" readonly class="form-control" id="category-film" value="<?php echo $arUser["que_quan"] ?>" name="quequan" required>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer mt-4">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Des-->
                                    <?php $stt++;
                                    } ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="xuly.php" method="POST" enctype="multipart/form-data">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Họ tên:</label>
                                                                    <input type="text" class="form-control" id="category-film" name="hoten" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Email:</label>
                                                                    <input type="email" class="form-control" id="category-film" name="email" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Số điện thoại:</label>
                                                                    <input type="text" pattern="\d{10,11}" title="Số điện thoại không hợp lệ" class="form-control" id="category-film" name="sdt" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Số căn cước công dân:</label>
                                                                    <input type="text" pattern="[0-9]{12}" title="CCCD phải có 12 chữ số" class="form-control" id="category-film" name="cccd" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Giới tính:</label>
                                                                    <select class="form-select" aria-label="Default select example" name="gioitinh" required>
                                                                        <option value="" selected>Chọn giới tính</option>
                                                                        <option value="Nam">Nam</option>
                                                                        <option value="Nữ">Nữ</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Ngày sinh:</label>
                                                                    <input type="date" max="<?php echo $currentDate; ?>" class="form-control" id="category-film" name="ngaysinh" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Tình trạng hôn nhân:</label>
                                                                    <select class="form-select" aria-label="Default select example" name="tthn" required>
                                                                        <option value="" selected>Chọn tình trạng</option>
                                                                        <option value="Độc thân">Độc thân</option>
                                                                        <option value="Đã kết hôn">Đã kết hôn</option>
                                                                        <option value="Ly hôn">Ly hôn</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Ngày vào làm:</label>
                                                                    <input type="date" class="form-control" id="category-film" name="ngayvaolam" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Trình độ học vấn:</label>
                                                                    <select class="form-select" aria-label="Default select example" name="tdhv" required>
                                                                        <option value="" selected>Chọn trình độ</option>
                                                                        <option value="Đại học">Đại học</option>
                                                                        <option value="Cao Đẳng">Cao Đẳng</option>
                                                                        <option value="Trung học phổ thông">Trung học phổ thông</option>
                                                                        <option value="Trung học cơ sở">Trung học cơ sở</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Phòng ban:</label>
                                                                    <select class="form-select" aria-label="Default select example" name="phongban" required>
                                                                        <option value="" selected>Chọn phòng ban</option>
                                                                        <option value="Phòng Kế toán">Phòng Kế toán</option>
                                                                        <option value="Phòng Hành chính">Phòng Hành chính</option>
                                                                        <option value="Phòng Nhân sự">Phòng Nhân sự</option>
                                                                        <option value="Phòng Kinh doanh">Phòng Kinh doanh</option>
                                                                        <option value="Phòng Marketing">Phòng Marketing</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Chức vụ:</label>
                                                                    <input type="text" class="form-control" id="category-film" name="chucvu" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label for="category-film" class="col-form-label">Quê quán:</label>
                                                                    <input type="text" class="form-control" id="category-film" name="quequan" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="category-film" class="col-form-label">Ảnh:</label>
                                                                    <input type="hidden" name="size" value="1000000">
                                                                    <input type="file" class="form-control" name="image" required />
                                                                </div>
                                                                <div class="col-3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer mt-4">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary" name="addnv">Lưu</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Add-->


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>