<?php 
include "config/connectDB.php";
$id = $_GET["id"];

$sql = "SELECT * FROM tb_floors
        WHERE floor_id = $id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลชั้น</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
</head>

<body>

<h1>แก้ไขข้อมูลข้อมูลชั้น</h1>

<form action="update_floor.php" method="post">

    <input type="hidden" name="floor_id" value="<?= $row["floor_id"] ?>">

    ชื่อชั้น
    <br>
    <input type="text" name="floor_name" value="<?= $row["floor_name"] ?>" required>

    <br><br>



    <br><br>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> บันทึกการแก้ไข
    </button>
    <a href="frm_add_floor.php" class="btn btn-secondary">
        <i class="fas fa-times"></i> ยกเลิก
    </a>

</form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</html>