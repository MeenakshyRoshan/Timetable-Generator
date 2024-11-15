<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Class Timetable</h2>

        <div class="mb-3">
            <label for="classSelect" class="form-label">Select Class</label>
            <select id="classSelect" class="form-select">
                <option value="">Select a class</option>
            </select>
        </div>

        <div id="timetableContainer" class="mt-4"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load classes dynamically
            $.getJSON('fetch_classes.php', function(classes) {
                classes.forEach(function(cls) {
                    $('#classSelect').append(`<option value="${cls.id}">${cls.class_name}</option>`);
                });
            });

            // Load timetable on class change
            $('#classSelect').change(function() {
                const classId = $(this).val();
                if (classId) {
                    $.getJSON(`fetch_timetable.php?class_id=${classId}`, function(data) {
                        let timetable = '<table class="table table-bordered">';
                        timetable += '<tr><th>Day</th><th>Time</th><th>Subject</th><th>Teacher</th></tr>';
                        data.forEach(row => {
                            timetable += `<tr>
                                <td>${row.day}</td>
                                <td>${row.start_time} - ${row.end_time}</td>
                                <td>${row.subject_name}</td>
                                <td>${row.teacher_name}</td>
                            </tr>`;
                        });
                        timetable += '</table>';
                        $('#timetableContainer').html(timetable);
                    });
                } else {
                    $('#timetableContainer').html('');
                }
            });
        });
    </script>
</body>
</html>
