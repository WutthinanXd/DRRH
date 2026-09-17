<?php
include "config/connectDB.php";
$id = $_GET["id"];

$sql = "SELECT * FROM tb_room_types 
        WHERE room_type_id = $id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลประเภทห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
</head>

<body>

<h1>แก้ไขข้อมูลประเภทห้อง</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRoomTypeModal">
        <i class="fa fa-plus"></i> แก้ไขข้อมูลประเภทห้อง
        </button>
 <div class="modal fade" id="editRoomTypeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="update_room_type.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มข้อมูลประเภทห้อง</h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">ชื่อประเภทห้อง</label>
                        <input type="text" name="room_type_name" class="form-control" required>
                    </div>
                        <div class="mb-3">
                            <label class="form-label">สถานะ</label>
                            <select name="room_type_status" class="form-select">
                                <option value="1">พร้อมใช้งาน</option>
                                <option value="0">ไม่พร้อมใช้งาน</option>
                            </select>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>

            </form>
        </div>
    </div>
</div>      
<form action="update_room_type.php" method="post">

    <input type="hidden" name="room_type_id" value="<?= $row["room_type_id"] ?>">

    ชื่อประเภทห้อง
    <br>
    <input type="text" name="room_type_name" value="<?= $row["room_type_name"] ?>" required>

    <br><br>

    สถานะ
    <br>
    <select name="room_type_status">
        <option value="1" <?= (isset($row["room_type_status"]) && $row["room_type_status"] == 1) ? "selected" : "" ?>>
            พร้อมใช้งาน
        </option>
        <option value="0" <?= (isset($row["room_type_status"]) && $row["room_type_status"] == 0) ? "selected" : "" ?>>
            ไม่พร้อมใช้งาน
        </option>
    </select>

    <br><br>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> บันทึกการแก้ไข
    </button>
    <a href="frm_add_room_type.php" class="btn btn-secondary">
        <i class="fas fa-times"></i> ยกเลิก
    </a>

</form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</html>