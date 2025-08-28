<?php include_once('db_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title><?= $appName ?> | <?= $subtitle ?></title>
    <meta name="title" content="">
    <meta name="description" content="<?= $description ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="h<?= $appUrl ?>">
    <meta property="og:title" content="<?= $subtitle ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:image" content="<?= $appIcon ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $appUrl ?>">
    <meta property="twitter:title" content="<?= $subtitle ?>">
    <meta property="twitter:description" content="<?= $description ?>">
    <meta property="twitter:image" content="<?= $appIcon ?>">
    <meta name="author" content="Ese Sphere">
    <link href="<?= $appIcon ?>" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <div style="background-color: #192a56;" class="sidebar pe-4 pb-3">
            <nav class="navbar navbar-dark">
                <a href="./index" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-white"><i class="fa fa-user-edit me-2"></i><?= $appName ?></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?= $_SESSION['username'] ?> </h6>
                        <span>Admin</span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="./dashboard" class="nav-item nav-link active">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>

                    <!-- Task Management -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-tasks me-2"></i>Task Management
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./add-task" class="dropdown-item">Add New Task</a>
                            <a href="./subtasks" class="dropdown-item">Subtasks & Checklists</a>
                            <a href="./recurring-tasks" class="dropdown-item">Recurring Tasks</a>
                            <a href="./delegation" class="dropdown-item">Task Assignment</a>
                            <a href="./daily-summary" class="dropdown-item">Task Summary</a>
                        </div>
                    </div>

                    <!-- Productivity Tools -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-lightbulb me-2"></i>Productivity Tools
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./task-chat" class="dropdown-item">Task Comments & Chat</a>
                            <a href="./voice-notes" class="dropdown-item">Voice Notes</a>
                            <a href="./team-boards" class="dropdown-item">Team Boards</a>
                            <a href="./mentions" class="dropdown-item">Mentions & Reactions</a>
                        </div>
                    </div>

                    <!-- Document Management -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-folder me-2"></i>Documents
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./version-history" class="dropdown-item">Version History</a>
                            <a href="./recent-files" class="dropdown-item">Recent Files</a>
                            <a href="./document-preview" class="dropdown-item">Document Preview</a>
                            <a href="./cloud-integration" class="dropdown-item">Cloud Integration</a>
                        </div>
                    </div>

                    <!-- Insights & Reporting -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-chart-line me-2"></i>Insights
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./analytics" class="dropdown-item">Analytics Dashboard</a>
                            <a href="./completion-rate" class="dropdown-item">Task Completion Rate</a>
                            <a href="./timesheets" class="dropdown-item">Timesheet Logging</a>
                            <a href="./workload" class="dropdown-item">Workload Balancer</a>
                        </div>
                    </div>

                    <!-- Automation & Engagement -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-rocket me-2"></i>Workflow
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./gamification" class="dropdown-item">Gamification</a>
                            <a href="./suggestions" class="dropdown-item">Smart Suggestions</a>
                            <a href="./push-notifications" class="dropdown-item">Push Notifications</a>
                            <a href="./recap" class="dropdown-item">End-of-Day Recap</a>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "' AND verified = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['verified'] == 1) {
                    ?>
                            <!-- Admin Settings -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fa fa-cog me-2"></i>Admin & Settings
                                </a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="./access-control" class="dropdown-item">Access Control</a>
                                    <a href="./audit" class="dropdown-item">Audit Logs</a>
                                    <a href="./availability" class="dropdown-item">Staff Availability</a>
                                    <a href="./templates" class="dropdown-item">Task Templates</a>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <nav class="navbar navbar-expand navbar-dark bg-white sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-white border-1" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="./logout" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4"></div>