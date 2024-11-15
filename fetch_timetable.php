<?php
include 'db.php';

$class_id = $_GET['class_id'];
$result = $conn->query("SELECT t.day, ts.start_time, ts.end_time, s.subject_name, te.teacher_name 
    FROM timetable t 
    JOIN time_slots ts ON t.time_slot_id = ts.id
    JOIN subjects s ON t.subject_id = s.id
    JOIN teachers te ON t.teacher_id = te.id
    WHERE t.class_id = '$class_id'
    ORDER BY FIELD(t.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time");

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
