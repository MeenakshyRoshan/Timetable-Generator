<?php
function generateTimetable($class_id, $days, $time_slots, $subjects, $teachers) {
    $timetable = [];
    foreach ($days as $day) {
        foreach ($time_slots as $slot) {
            $subject = array_rand($subjects);
            $teacher = findAvailableTeacher($teachers, $subject, $slot);
            if ($teacher) {
                $timetable[] = [
                    'day' => $day,
                    'time_slot' => $slot,
                    'subject' => $subject,
                    'teacher' => $teacher
                ];
            }
        }
    }
    return $timetable;
}
?>