<?php
    include "config/connectDB.php";
    $sql = "SELECT
    tb_roomdata.room_id,
    tb_roomdata.room_number,
    tb_roomdata.room_name,
    tb_roomdata.room_description,
    tb_roomdata.floor_id,
    tb_floors.floor_name,
    tb_roomdata.room_seats,
    tb_roomdata.room_type_id,
    tb_room_types.room_type_name,
    tb_room_types.room_type_status,
    tb_roomdata.room_status 
FROM
    tb_roomdata
    LEFT JOIN tb_room_types ON tb_roomdata.room_type_id = tb_room_types.room_type_id
    LEFT JOIN tb_floors ON tb_roomdata.floor_id = tb_floors.floor_id";
    $result = mysqli_query($conn, $sql);
$sqlroomtype = "SELECT * FROM tb_room_types ORDER BY room_type_id DESC";
$resultroomtype = mysqli_query($conn, $sqlroomtype);
$sqlflo = "SELECT * FROM tb_floors ORDER BY floor_id";
$resultflo = mysqli_query($conn, $sqlflo);

?>



<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการข้อมูลห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 

</head>

<body>
    <div class="container my-4">
        
        <div class="card shadow-sm border-0 mb-4 bg-light">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    
                    <div>
                        <h2 class="h3 fw-bold text-primary mb-1">
                            <i class="fa-solid fa-door-open me-2"></i>จัดการข้อมูลห้อง
                        
                    </div>

                    
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addRoomDataModal">
                            <i class="fa-solid fa-plus me-1"></i> เพิ่มข้อมูลห้อง
                        </button>
                        <a href="frm_add_room_type.php" class="btn btn-outline-primary">
                            <i class="fa-solid fa-layer-group me-1"></i> จัดการประเภทห้อง
                        </a>
                        <a href="frm_add_floor.php" class="btn btn-outline-primary">
                            <i class="fa-solid fa-building me-1"></i> จัดการชั้น
                        </a>
                        <a href="users.php" class="btn btn-outline-primary">
                            <i class="bi bi-person-circle me-1"></i> แก้ไขข้อมูลผู้ใช้
                        </a>
                    </div>
                </div>
            </div>
        </div>

       
    <table class="table table-bordered">
    <tr>
        <th>รหัส</th>
        <th>หมายเลขห้อง</th>
        <th>ชื่อห้อง</th>
        <th>รายละเอียด</th>
        <th>ชั้น</th>
        <th>จำนวนที่นั่ง</th>
        <th>ประเภทห้อง</th>
        <th>สถานะ</th>
        <th>จัดการ</th>
    </tr>
     <?php $i=0; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <?php $i++; ?>
        <tr>
            <td class="text-center"><?= $i; ?></td>

            <td>
                <?= $row["room_number"] ?>
            </td>

            <td>
                <?= $row["room_name"] ?>
            </td>

            <td>
                <?= $row["room_description"] ?>
            </td>

            <td>
                <?= $row["floor_name"] ?>
            </td>

            <td>
                <?= $row["room_seats"] ?>
            </td>

            <td>

                <?= $row["room_type_name"]; ?>


            </td>

            <td>

                <?php

                if ($row["room_status"] == 1) {
                    echo "พร้อมใช้งาน";
                } else {
                    echo "ไม่พร้อมใช้งาน";
                }

                ?>

            </td>

            <td>

                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomModal<?= $row['room_id'] ?>">
                    <i class="fa fa-edit"></i> แก้ไข</button>

                |
                    <a
                    href="delete_room_data.php?id=<?= $row["room_id"] ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')"
                >
                    <i class="fa fa-trash"></i> ลบ
                   </a>                  
                       
                    <div class="modal fade" id="editRoomModal<?= $row["room_id"] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog text-start">
                            <div class="modal-content">
                                <form action="update_room_data.php" method="post">
                                    <input type="hidden" name="room_id" value="<?= $row["room_id"] ?>"> 
                                    <div class="modal-header">
                                    <h2 class="modal-title fs-5"><i class="fa fa-edit me-2"></i> แก้ไขข้อมูลห้อง</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="mb-3">
                                    <label class="form-label">หมายเลขห้อง</label>
                                    <input type="text" name="room_number" class="form-control" 
                                                   value="<?= ($row["room_number"]) ?>" required>
                                    </div>  
                                     <div class="mb-3">
                                     <label class="form-label">ชื่อห้อง</label>
                                    <input type="text" name="room_name" class="form-control" 
                                                   value="<?= ($row["room_name"]) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                            <label class="form-label">คำอธิบาย</label>
                                            <textarea name="room_description" class="form-control"><?=($row["room_description"]) ?></textarea>
                                    </div>    
                                    <div class="row">                                    
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">ชั้น</label>
                                            <select name="floor_id" class="form-select" required>
                                                <?php 
                                                $floors = mysqli_query($conn,"SELECT * FROM tb_floors ORDER BY floor_id ASC");
                                                while ($floor = mysqli_fetch_assoc($floors)) { ?>
                                                    <option value="<?= $floor["floor_id"] ?>" <?= ($floor["floor_id"] == $row["floor_id"]) ? 'selected' : '' ?>>
                                                        <?= ($floor["floor_name"]) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                                                             
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">จำนวนที่นั่ง</label>
                                            <input type="number" name="room_seats" class="form-control" 
                                                   value="<?= $row["room_seats"] ?>" required>
                                        </div>
                                    </div>

                                        <div class="mb-3">
                                        <label class="form-label">ประเภทห้อง</label>
                                        <select name="room_type_id" class="form-select" required>
                                         <?php 
                                        $roomtypes = mysqli_query($conn,"SELECT * FROM tb_room_types ORDER BY room_type_id DESC");
                                        while ($type = mysqli_fetch_assoc($roomtypes)) { ?>
                                        <option value="<?= $type["room_type_id"] ?>" <?= ($type["room_type_id"] == $row["room_type_id"]) ? 'selected' : '' ?>>
                                        <?= ($type["room_type_name"]) ?>
                                        </option>
                                        <?php } ?>
                                        </select>
                                        </div>
                                        <div class="mb-3">
                                        <label class="form-label">สถานะ</label>
                                        <select name="room_status" class="form-select">
                                        <option value="1" <?= ($row["room_status"] == 1) ? 'selected' : '' ?>>พร้อมใช้งาน</option>
                                        <option value="0" <?= ($row["room_status"] == 0) ? 'selected' : '' ?>>ไม่พร้อมใช้งาน</option>
                                        </select>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> บันทึกการแก้ไข</button>
                                    </div>
                             </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
</table>
<div class="modal fade" id="addRoomDataModal" tabindex="-1" aria-labelledby="addRoomDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="save_room_data.php" method="post">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="addRoomDataModalLabel">เพิ่มข้อมูลห้อง</h2><button
                            type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label for="add-room-name"
                                class="form-label">หมายเลขห้อง</label><input id="add-room-name" type="text"
                                name="room_number" class="form-control" required></div>
                        <div class="mb-3"><label for="add-room-name"
                                class="form-label">ชื่อห้อง</label><input id="add-room-name" type="text"
                                name="room_name" class="form-control" required></div>
                        <label for="add-room-description" class="form-label">คำอธิบาย</label>
                        <textarea id="add-room-description" name="room_description" class="form-control"></textarea>
                        <label for="add-floor-id" class="form-label">ชั้น</label>
                        <select id="add-floor-id" name="floor_id" class="form-select">
                            <?php while ($rowflo = mysqli_fetch_assoc($resultflo)) { ?>
                                <option value="<?= $rowflo["floor_id"] ?>"><?= $rowflo["floor_name"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="add-room-seats" class="form-label">จำนวนที่นั่ง</label>
                        <input id="add-room-seats" type="number" name="room_seats" class="form-control" required>
                        <label for="add-room-type-id" class="form-label">ประเภทห้อง</label>
                        <select id="add-room-type-id" name="room_type_id" class="form-select">
                            <?php while ($rowroomtype = mysqli_fetch_assoc($resultroomtype)) { ?>
                                <option value="<?= $rowroomtype["room_type_id"] ?>"><?= $rowroomtype["room_type_name"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="add-room-status" class="form-label">สถานะ</label>
                        <select id="add-room-status" name="room_status" class="form-select">
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</html> 