<?php
require('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // รับค่า itemId จาก query string
    $itemId = $_GET['itemId'];

    // สร้างคำสั่ง SQL เพื่ออัปเดตสถานะเป็น 'Received'
    $sql = "UPDATE LostItems SET Status = 'Received' WHERE ID = $itemId";

    if ($conn->query($sql) === TRUE) {
        // หลังจากที่ทำการอัปเดตสถานะให้รีไดเรกท์หน้า index.php
        header("Location: index.php");
    } else {
        // กรณีเกิดข้อผิดพลาดในการอัปเดตสถานะ
        echo "Error updating status: " . $conn->error;
    }

    $conn->close();
} else {
    // กรณีไม่ได้รับ request แบบ GET
    echo "Invalid request method";
}
?>
