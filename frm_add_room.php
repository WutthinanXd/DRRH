<?php
include "config/connectDB.php";
$sqlroomtype = "SELECT * FROM tb_room_types ORDER BY room_type_id DESC";
$result = mysqli_query($conn, $sqlroomtype);
$sqlflo = "SELECT * FROM tb_floors ORDER BY floor_id";
$resultflo = mysqli_query($conn, $sqlflo);
?>
<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <title>เพิ่มข้อมูลห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 

</head>

<body>

    <h1>เพิ่มข้อมูลห้อง</h1>

    <form action="save_room_data.php" method="post" class="form-control">

        หมายเลขห้อง
        <br>

        <input type="text" name="room_number" required class="form-control">

        <br><br>

        ชื่อห้อง
        <br>

        <input type="text" name="room_name" required>

        <br><br>

        รายละเอียดห้อง
        <br>

        <textarea name="room_description" rows="4" cols="40"></textarea>

        <br><br>

        ชั้น
        <br>

        <select name="floor_id">
            <?php while ($row = mysqli_fetch_assoc($resultflo)) { ?>
                <option value="<?= $row['floor_id'] ?>">
                    <?= $row['floor_name'] ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        จำนวนที่นั่ง
        <br>

        <input type="number" name="room_seats">

        <br><br>

        ประเภทห้อง
        <br>

        <select name="room_type_id">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?= $row['room_type_id'] ?>">
                    <?= $row['room_type_name'] ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        สถานะ
        <br>

        <select name="room_status">

            <option value="1">
                พร้อมใช้งาน
            </option>

            <option value="0">
                ไม่พร้อมใช้งาน
            </option>

        </select>

        <br><br>

        <button type="submit" class="btn btn-primary">
            บันทึก
        </button>

        <a href="index.php" class="btn btn-secondary">
            ยกเลิก
        </a>

    </form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</html>