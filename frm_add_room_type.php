<?php
include "config/connectDB.php";

$result = mysqli_query($conn, "SELECT * FROM tb_room_types ORDER BY room_type_id");
$roomTypes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $roomTypes[] = $row;
}
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการข้อมูลประเภทห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <main class="container py-3">
        <div class="container-fluid mt-2">
        <div class="bg-primary text-white p-2 rounded shadow-sm mb-3">
                        <h2>
                            <i class="fa-solid fa-door-open me-2  "></i>จัดการข้อมูลประเภทห้อง
                        
                    </div>
                    
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal"><i
                class="fa fa-plus"></i> เพิ่มข้อมูลประเภทห้อง</button>
        <a href="index.php" class="btn btn-outline-secondary">ข้อมูลห้อง</a>
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อประเภทห้อง</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roomTypes as $row) { ?>
                        <tr>
                            <td><?= e($row["room_type_id"]) ?></td>
                            <td><?= e($row["room_type_name"]) ?></td>
                            <td><?= $row["room_type_status"] == 1 ? "พร้อมใช้งาน" : "ไม่พร้อมใช้งาน" ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editRoomTypeModal<?= e($row["room_type_id"]) ?>">แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteRoomTypeModal<?= e($row["room_type_id"]) ?>">ลบ</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="save_room_type.php" method="post">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="addRoomTypeModalLabel">เพิ่มประเภทห้อง</h2><button
                            type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label for="add-room-type-name"
                                class="form-label">ชื่อประเภทห้อง</label><input id="add-room-type-name" type="text"
                                name="room_type_name" class="form-control" required></div>
                        <label for="add-room-type-status" class="form-label">สถานะ</label>
                        <select id="add-room-type-status" name="room_type_status" class="form-select">
                            <option value="1">พร้อมใช้งาน</option>
                            <option value="0">ไม่พร้อมใช้งาน</option>
                        </select>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                            class="btn btn-primary">บันทึก</button></div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($roomTypes as $row) { ?>
        <div class="modal fade" id="editRoomTypeModal<?= e($row["room_type_id"]) ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="update_room_type.php" method="post">
                        <input type="hidden" name="room_type_id" value="<?= e($row["room_type_id"]) ?>">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5">แก้ไขข้อมูลประเภทห้อง</h2><button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="ปิด"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3"><label class="form-label">ชื่อประเภทห้อง</label><input type="text"
                                    name="room_type_name" class="form-control" value="<?= e($row["room_type_name"]) ?>"
                                    required></div>
                            <label class="form-label">สถานะ</label>
                            <select name="room_type_status" class="form-select">
                                <option value="1" <?= $row["room_type_status"] == 1 ? "selected" : "" ?>>พร้อมใช้งาน</option>
                                <option value="0" <?= $row["room_type_status"] == 0 ? "selected" : "" ?>>ไม่พร้อมใช้งาน
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                                class="btn btn-primary">บันทึก</button></div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="deleteRoomTypeModal<?= e($row["room_type_id"]) ?>" tabindex="-1" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="delete_room_type.php" method="post">
                        <input type="hidden" name="room_type_id" value="<?= e($row["room_type_id"]) ?>">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5">ยืนยันการลบ</h2><button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="ปิด"></button>
                        </div>
                        <div class="modal-body">ต้องการลบประเภทห้อง “<?= e($row["room_type_name"]) ?>” ใช่หรือไม่?</div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                                class="btn btn-danger">ลบ</button></div>
                    </form>
                </div>
            </div>
        </div> 
        
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>

</html>