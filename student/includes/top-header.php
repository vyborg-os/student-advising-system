<header class="bg-surface-primary border-bottom pt-6">
    <div class="container-fluid">
        <div class="mb-npx">
            <div class="row align-items-center">
                <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                    <!-- Title -->
                    <h1 class="h2 mb-0 ls-tight"><?php echo ucwords($current_page_name); ?></h1>
                </div>
            </div>
            <!-- Nav -->
            <ul class="nav nav-tabs mt-4 overflow-x border-0">
                <?php 
                    if($current_page_name === "students"){ ?> 
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link active" id="defaultOpen" onclick="openTab(event, 'viewStudents')">All Students</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" onclick="openTab(event, 'addStudent')">Add Student</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" onclick="openTab(event, 'addSubject')">Subjects</a>
                        </li>
                    <?php } else if($current_page_name === "results"){ ?>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link active" id="defaultOpen" onclick="openTab(event, 'addResult')">Upload Result</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" onclick="openTab(event, 'viewResult')">View Result</a>
                        </li>
                    <?php }
                ?>                
            </ul>
        </div>
    </div>
</header>