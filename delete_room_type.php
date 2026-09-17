<?php

include "config/connectDB.php";

$room_type_id = $_POST["room_type_id"];

$sql = "DELETE FROM tb_room_types
        WHERE room_type_id = $room_type_id";

mysqli_query($conn, $sql);

header("Location: frm_add_room_type1.php");

exit;

?>