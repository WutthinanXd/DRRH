<?php
include "config/connectDB.php";

$result = mysqli_query($conn, "SELECT * FROM tb_floors ORDER BY floor_id");
$floors = [];
while ($row = mysqli_fetch_assoc($result)) {
    $floors[] = $row;
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
    <title>เพิ่มข้อมูลชั้น</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
</head>
<body>
<h1>เพิ่มข้อมูลชั้น</h1>
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFloorModal"><i
                class="fa fa-plus"></i> เพิ่มข้อมูลชั้น</button>
                <a href="index.php" class="btn btn-outline-secondary">ข้อมูลห้อง</a>
                <div class="modal fade" id="addFloorModal" tabindex="-1" aria-labelledby="addFloorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="save_floor.php" method="post">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="addFloorModalLabel">เพิ่มชั้น</h2><button
                            type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label for="add-floor-name"
                                class="form-label">ชื่อชั้น</label><input id="add-floor-name" type="text"
                                name="floor_name" class="form-control" required></div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                            class="btn btn-primary">บันทึก</button></div>
                </form>
            </div>
        </div>
    </div>
</form>
<br><br>
<table class="table table-bordered">
    <tr>
        <th>รหัส</th>
        <th>ชื่อชั้น</th>
        <th>จัดการ</th>
    </tr>

    <?php foreach ($floors as $row) { ?>
        <tr>
           <td><?= e($row["floor_id"]) ?></td>
            <td><?= e($row["floor_name"]) ?></td>
            <td>
               <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                data-bs-target="#floorModal<?= e($row["floor_id"]) ?>">แก้ไข</button>
                |
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                data-bs-target="#deleteFloorModal<?= e($row["floor_id"]) ?>">ลบ</button>
            </td>
        </tr>
    <?php } ?>
</table>
<?php foreach ($floors as $row) { ?>
        <div class="modal fade" id="floorModal<?= e($row["floor_id"]) ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="update_floor.php" method="post">
                        <input type="hidden" name="floor_id" value="<?= e($row["floor_id"]) ?>">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5">แก้ไขข้อมูลชั้น</h2><button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="ปิด"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3"><label class="form-label">ชื่อชั้น</label><input type="text"
                                    name="floor_name" class="form-control" value="<?= e($row["floor_name"]) ?>"
                                    required></div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                                class="btn btn-primary">บันทึก</button></div>
                    </form>
                </div>
            </div>
        </div>
<div class="modal fade" id="deleteFloorModal<?= e($row["floor_id"]) ?>" tabindex="-1" aria-hidden="true"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="delete_floor.php" method="post">
                        <input type="hidden" name="floor_id" value="<?= e($row["floor_id"]) ?>">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5">ยืนยันการลบ</h2><button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="ปิด"></button>
                        </div>
                        <div class="modal-body">ต้องการลบชั้น “<?= e($row["floor_name"]) ?>” ใช่หรือไม่?</div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">ยกเลิก</button><button type="submit"
                                class="btn btn-danger">ลบ</button></div>
                    </form>
                </div>
            </div>
        </div> 
        
    <?php } ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</html>