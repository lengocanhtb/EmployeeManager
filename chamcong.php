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
                    <h1 class="mt-4">Danh sách chấm công</h1>
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
                                        <th>Nhân viên</th>
                                        <th>Ngày</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT a.*,b.ten
                                    FROM chamcong as a,nhanvien as b
                                     WHERE a.nhanvien_id = b.id 
                                     ORDER BY a.ngay DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDel = "exampleModalDel" . $arUser["id"];
                                        $idModelEdit = "exampleModalEdit" . $arUser["id"];
                                    ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            <td><?php echo $arUser["ten"] ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($arUser["ngay"])) ?> </td>
                                            <td><?php echo $arUser["tinh_trang"] ?> </td>
                                            <td style="width : 140px !important">
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
                                                                Xóa chấm công của nhân viên <?php echo $arUser["ten"] ?> ngày <?php echo date("d-m-Y", strtotime($arUser["ngay"])) ?>
                                                                <form action="xuly.php" method="post">
                                                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                    <div class="modal-footer" style="margin-top: 20px">
                                                                        <button style="width:100px" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                            Đóng
                                                                        </button>
                                                                        <button style="width:100px" type="submit" class="btn btn-danger" name="deletecc"> Xóa</button>

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
                                            <div class="modal-dialog ">
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
                                                                    <div class="col-12">
                                                                        <label for="category-film" class="col-form-label">Nhân viên:</label>
                                                                        <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="nhanvien" required>
                                                                            <?php
                                                                            $lspud = mysqli_query($connect, "SELECT * FROM nhanvien");
                                                                            while ($arLspud = mysqli_fetch_array($lspud, MYSQLI_ASSOC)) {
                                                                                if ($arLspud['id'] == $arUser["nhanvien_id"]) {
                                                                            ?>
                                                                                    <option value="<?php echo $arLspud['id'] ?>" selected><?php echo $arLspud['ten'] ?></option>
                                                                                <?php } else { ?>
                                                                                    <option value="<?php echo $arLspud['id'] ?>"><?php echo $arLspud['ten'] ?></option>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label for="category-film" class="col-form-label">Ngày :</label>
                                                                        <input type="date" max="<?php echo $currentDate; ?>" value="<?php echo $arUser["ngay"] ?>" class="form-control" id="category-film" name="ngay" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label for="category-film" class="col-form-label">Tình trạng:</label>
                                                                        <select class="form-select" aria-label="Default select example" name="tinhtrang" required>
                                                                            <?php if ($arUser["tinh_trang"] == "Vắng mặt") { ?>
                                                                                <option value="Có mặt">Có mặt</option>
                                                                                <option value="Vắng mặt" selected>Vắng mặt</option>
                                                                            <?php } else { ?>
                                                                                <option value="Có mặt" selected>Có mặt</option>
                                                                                <option value="Vắng mặt">Vắng mặt</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary" name="editcc">Lưu</button>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                        </div>
                        <!-- Modal Update-->
                    <?php $stt++;
                                    } ?>
                    <!-- Modal Add-->
                    <div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="xuly.php" method="POST" enctype="multipart/form-data">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-12">
                                                    <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="nhanvien" required>
                                                        <option value="" selected>Chọn nhân viên</option>
                                                        <?php
                                                        $lsp = mysqli_query($connect, "SELECT * FROM nhanvien");
                                                        while ($arLsp = mysqli_fetch_array($lsp, MYSQLI_ASSOC)) {
                                                        ?>
                                                            <option value="<?php echo $arLsp['id'] ?>"><?php echo $arLsp['ten'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="category-film" class="col-form-label">Ngày :</label>
                                                    <input type="date" max="<?php echo $currentDate; ?>" class="form-control" id="category-film" name="ngay" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="category-film" class="col-form-label">Tình trạng:</label>
                                                    <select class="form-select" aria-label="Default select example" name="tinhtrang" required>
                                                        <option value="" selected>Chọn tình trạng</option>
                                                        <option value="Có mặt">Có mặt</option>
                                                        <option value="Vắng mặt">Vắng mặt</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary" name="addcc">Lưu </button>
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