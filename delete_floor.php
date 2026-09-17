<?php

include "config/connectDB.php";

$floor_id = $_POST["floor_id"];

$sql = "DELETE FROM tb_floors
        WHERE floor_id = $floor_id";

mysqli_query($conn, $sql);

header("Location: frm_add_floor1.php");

exit;

?>