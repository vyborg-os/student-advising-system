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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php require_once APPROOT.'/student/includes/navigation.php'; ?>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Appointments</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <a href="#" class="btn d-inline-flex btn-sm btn-primary mx-1" id="launchModalButton">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a>
                                </div>
                            </div>
                              <!-- Modal -->
                              <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Appointment</h5>
                                        <button type="button" class="close" id="closeModalButton" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Advisor:</label>
                                        <select class="form-control" id="advisor-name">
                                            <option selected disabled>-- Choose Advisor --</option>
                                            <option>Mr Charles</option>
                                            <option>Mr Caleb</option>
                                            <option>Mrs Jones</option>
                                            <option>Mr Lincoln</option>
                                            <option>Mrs Deborah</option>
                                            <option>Mr Winston</option>
                                            <option>Mr Wick</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="appointment-date" class="col-form-label">Date:</label>
                                        <input type="date" class="form-control" id="appointment-date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="appointment-time" class="col-form-label">Time:</label>
                                        <input type="time" class="form-control" id="appointment-time">
                                    </div>
                                    <div class="mb-3">
                                        <label for="appointment-note" class="col-form-label">Notes:</label>
                                        <textarea class="form-control" id="appointment-notes"></textarea>
                                    </div>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Create</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                             <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">Home/Appointments</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
             
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">All Appointments</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Student</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Advisor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th></th>
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
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-1.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Mrs Okpa
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-danger"></i>Cancelled
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Robert Fox
                                            </a>
                                        </td>
                                        <td>
                                            Dec 15, 2024
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-1.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Mr Anthony
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-warning"></i>Pending
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>
                                            <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Robert Fox
                                            </a>
                                        </td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-1.png" class="avatar avatar-xs rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="#">
                                                Mr Ologun
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="bg-success"></i>Done
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-neutral">View</a>
                                            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>                                     
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer border-0 py-5">
                            <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
        <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('#launchModalButton').click(function(){
        $('#msgModal').modal('show');
        });
    });
    $(document).ready(function(){
        $('#closeModalButton').click(function(){
        $('#msgModal').modal('hide');
        });
    });
</script>
    <?php require_once APPROOT.'/student/includes/script.php'; ?>
</body>
</html>