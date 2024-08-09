<?php 
    require_once '../config/config.php';
    require_once APPROOT.'/database/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo PAGETITLE; ?></title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php require_once APPROOT.'/advisor/includes/navigation.php'; ?>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Good morning, Dr. James Doe</h1>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">All appointments</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Appointments</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Appointment Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $appointments = [
                                                ['id' => 1, 'student_name' => 'Alice Smith', 'appointment_time' => '2024-08-05 10:00', 'status' => 'Scheduled'],
                                                ['id' => 2, 'student_name' => 'Bob Johnson', 'appointment_time' => '2024-08-05 11:00', 'status' => 'Scheduled'],
                                                ['id' => 3, 'student_name' => 'Charlie Davis', 'appointment_time' => '2024-08-05 12:00', 'status' => 'Cancelled'],
                                            ];
                                            
                                            foreach($appointments as $appointment):
                                            ?>
                                                <tr>
                                                    <td>
                                                        <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                                        <a class="text-heading font-semibold" href="#">
                                                            <?php echo htmlspecialchars($appointment['student_name']); ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                                                    <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                                                    <td>
                                                        <form method="post" action="appointment_action.php">
                                                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                                            <?php if ($appointment['status'] == 'Scheduled'): ?>
                                                                <button type="submit" name="action" value="start" class="btn btn-primary btn-sm">Start</button>
                                                                <button type="submit" name="action" value="cancel" class="btn btn-danger btn-sm">Cancel</button>
                                                            <?php elseif ($appointment['status'] == 'Cancelled'): ?>
                                                                <button type="button" class="btn btn-secondary btn-sm" disabled>Cancelled</button>
                                                            <?php else: ?>
                                                                <button type="button" class="btn btn-secondary btn-sm" disabled>Started</button>
                                                            <?php endif; ?>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php require_once APPROOT.'/advisor/includes/script.php'; ?>
</body>
</html>