<?php 
    require_once '../config/config.php';
    require_once APPROOT.'/database/db.php';
    require_once APPROOT.'/advisor/includes/header.php';
?>
<body>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php require_once APPROOT.'/advisor/includes/navigation.php'; ?>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <?php require_once APPROOT.'/advisor/includes/top-header.php'; ?>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div id="viewStudents" class="tabcontent">
                        <div class="card shadow border-0 mb-7">
                            <div class="card-header">
                                <h5 class="mb-0">Filter to view specific students</h5>
                            </div>
                            <div class="card-body row">
                                <div class="mb-3 col-lg-4">
                                    <label for="yearFilter" class="form-label">Academic Session</label>
                                    <select class="form-control" id="yearFilter">
                                        <option value="" disabled selected>Select session</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="classFilter" class="form-label">Select Class</label>
                                    <select class="form-control" id="classFilter" onchange="fetchStudents()">
                                        <option value="">Select Level</option>
                                        <option value="year1">Year 1</option>
                                        <option value="year2">Year 2</option>
                                        <option value="year3">Year 3</option>
                                        <option value="year4">Year 4</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="studentSearch" class="form-label">Search by name</label>
                                    <input type="text" class="form-control" id="studentSearch" placeholder="Search for students by name" onkeyup="filterStudentTable()">
                                </div>
                            </div>
                            <div class="table-responsive" id="studentTableContainer">
                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Meeting</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                                <a class="text-heading font-semibold" href="#">
                                                    Robert Fox
                                                </a>
                                            </td>
                                            <td>
                                                Sept 14, 2024
                                            </td>
                                            <td>
                                                <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-1.png" class="avatar avatar-xs rounded-circle me-2">
                                                <a class="text-heading font-semibold" href="#">
                                                    First Year
                                                </a>
                                            </td>
                                            <td>
                                                Male
                                            </td>
                                            <td>
                                                <span class="badge badge-lg badge-dot">
                                                    <i class="bg-success"></i>Scheduled
                                                </span>
                                            </td>
                                        </tr>                                    
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer border-0 py-5">
                                <span class="text-muted text-sm" id="resultCount"></span>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php require_once APPROOT.'/advisor/includes/script.php'; ?>
    <script src="<?php echo URLROOT ?>/assets/js/student.js"></script>
</body>
</html>
