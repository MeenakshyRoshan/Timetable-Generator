<?php
include 'db.php';

// Fetch all necessary data
$classes = $conn->query("SELECT * FROM classes");
$subjects = $conn->query("SELECT * FROM subjects");
$teachers = $conn->query("SELECT * FROM teachers");
$time_slots = $conn->query("SELECT * FROM time_slots");
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// Clear previous timetable
$conn->query("DELETE FROM timetable");

// Generate timetable
foreach ($classes as $class) {
    foreach ($days as $day) {
        foreach ($time_slots as $slot) {
            $subject = $subjects->fetch_assoc();
            $teacher = $teachers->fetch_assoc();

            if ($teacher) {
                $conn->query("INSERT INTO timetable (class_id, teacher_id, subject_id, time_slot_id, day)
                    VALUES ('{$class['id']}', '{$teacher['id']}', '{$subject['id']}', '{$slot['id']}', '$day')");
            }
        }
    }
}

echo "Timetable generated successfully!";
?>
