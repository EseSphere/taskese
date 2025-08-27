<?php
include_once('header-panel.php');
include_once('sub-header.php');
include_once('./back_ends/add_task_backend.php'); // Ensure you have a database connection
$un986id = $_SESSION['un986id'] ?? 'staff'; // Default to 'staff' if not set
$comp_uniqueId = $_SESSION['comp_uniqueId'] ?? 'staff'; // Default to 'staff' if not set
$sql = "SELECT * FROM users WHERE comp_uniqueId = '$comp_uniqueId' ORDER BY username ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4 text-left">
        <div class="row text-decoration-none">
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <h5 class="mb-4 text-light">Add Task</h5>
                    <form method="post" action="./add-task" enctype="multipart/form-data" autocomplete="off" novalidate>
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label text-light">Task Title</label>
                            <input type="text" name="task_title" id="taskTitle" class="form-control" placeholder="Enter task title" required>
                        </div>

                        <div class="mb-3">
                            <label for="staff" class="form-label text-light">Assign to Staff</label>
                            <select name="un986id[]" id="staff" class="form-control" multiple required>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . htmlspecialchars($row["un986id"]) . '" data-username="' . htmlspecialchars($row["username"]) . '">' . htmlspecialchars($row["username"]) . '</option>';
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                            <small class="text-light">Hold Ctrl (Windows) or Command (Mac) to select multiple</small>
                        </div>

                        <div id="usernameInputs"></div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label text-light">Start</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label text-light">End</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                        </div>

                        <input name="comp_uniqueId" value="<?= htmlspecialchars($comp_uniqueId) ?>" hidden>

                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </form>

                    <script>
                        document.querySelector('form').addEventListener('submit', function(e) {
                            const staffSelect = document.getElementById('staff');
                            const usernameInputsContainer = document.getElementById('usernameInputs');
                            usernameInputsContainer.innerHTML = ''; // clear previous

                            // For each selected option, create a hidden input for username[]
                            Array.from(staffSelect.selectedOptions).forEach(opt => {
                                const username = opt.getAttribute('data-username');
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'username[]';
                                input.value = username;
                                usernameInputsContainer.appendChild(input);
                            });
                        });
                    </script>

                </div>
            </div>
            <div class="col-sm-8 col-xl-8">
                <div class="bg-secondary rounded h-100 p-4">
                    <h5 class="mb-4 text-light">Add Task</h5>
                    <p class="text-light">
                        The <strong>Add Task</strong> feature allows both administrators and authorized users to assign tasks to specific staff members with full control over timing and visibility. Whether assigning an individual duty or a collaborative task, this tool streamlines the process of selecting one or multiple staff members who will be responsible for carrying out the assignment.
                        <br><br>
                        One of the standout options is <strong>task visibility</strong>. This enables the task creator to define a specific period during which the task will appear to the selected staff. By scheduling visibility, tasks can be released only when they are relevant, reducing clutter and improving focus across the team.
                        <br><br>
                        Tasks also come with a clearly defined <strong>due date and time</strong>, which informs the staff when the task must be completed. This promotes time management, prioritization, and accountability, ensuring that all tasks are handled efficiently and delivered on schedule.
                        <br><br>
                        Additionally, you can allocate tasks to <strong>multiple staff members</strong> if needed. This is ideal for collaborative efforts or tasks requiring support from more than one individual. Everyone involved will see the same task and be able to contribute accordingly, improving teamwork and workflow coordination.
                        <br><br>
                        In summary, the Add Task feature provides a user-friendly interface for assigning tasks, setting visibility windows, and enforcing deadlines. It supports better planning, improves communication between team members, and contributes to a more organized and efficient working environment.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Format datetime-local value: YYYY-MM-DDTHH:MM
    function formatDateTime(date) {
        const pad = (n) => n.toString().padStart(2, '0');
        const yyyy = date.getFullYear();
        const mm = pad(date.getMonth() + 1);
        const dd = pad(date.getDate());
        const hh = pad(date.getHours());
        const min = pad(date.getMinutes());
        return `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    }

    window.addEventListener('DOMContentLoaded', () => {
        const now = new Date();
        const tomorrow = new Date(now);
        tomorrow.setDate(now.getDate() + 1);

        document.getElementById('start_date').value = formatDateTime(now);
        document.getElementById('end_date').value = formatDateTime(tomorrow);
    });
</script>
<?php include_once('footer-panel.php'); ?>