<?php
function month_range($date1,$date2) {
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}

function upm_project() {
    //grab all the partners associated with the logged in manager
    $args = [
        'role' => 'partner',
        'manager_id' => $current_user->ID
    ];

    $partners_query = new WP_User_Query($args);
    $partners = $partners_query->get_results();
    //-----------------------------------------------------------
    ?>
    <input type="hidden" name="project_id" id="project_id" value="<?php echo $_GET['id']; ?>">
    <div class="container">
        <div class="col-md-12">
            <small id="msg"></small>
        </div>
    </div>
    <div class="col-md-12 container-fluid">
        <div id="project-container"></div>
    </div>
    <div class="col-md-12"><hr></div>
    <div class="col-md-12">
        <h2><span class="glyphicon glyphicon-pushpin"></span>
            Noticeboard
            <button type="button" class="btn btn-success create-notice" data-toggle="modal" data-target="#create-notice">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Add new
            </button>
        </h2>
    </div>
    <div class="col-md-12 container-fluid">
        <div id="noticeboard-container"></div>
    </div>

    <!-- Create work package Modal -->
    <div class="modal fade" id="create-work-package" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-briefcase' aria-hidden='true'></span> Create Work Package</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createWPForm" method="POST">
                        <input type="hidden" name="manager_id" value="<?php echo $current_user->ID; ?>">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="status" value="in_progress">
                        <input type="hidden" name="project_start_date">
                        <input type="hidden" name="project_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="start_date">Start Date:</label>
                                <input type="date" name="start_date" class="form-control datepicker" data-error="Please enter start date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="end_date">End Date:</label>
                                <input type="date" name="end_date" class="form-control datepicker" data-error="Please enter end date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="coordinator_id">Partner:</label>
                            <select name="coordinator_id" class="form-control" required>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-work-package btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Work Package Modal -->
    <div class="modal fade" id="edit-work-package" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-briefcase' aria-hidden='true'></span> Edit Work Package</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editWPForm" method="POST">
                        <input type="hidden" name="id">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="project_start_date">
                        <input type="hidden" name="project_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="start_date">Start Date:</label>
                                <input type="date" name="start_date" class="form-control datepicker" data-error="Please enter start date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="end_date">End Date:</label>
                                <input type="date" name="end_date" class="form-control datepicker" data-error="Please enter end date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="coordinator_id">Partner:</label>
                            <select name="coordinator_id" class="form-control" required>
                                <option></option>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-work-package btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create task Modal -->
    <div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-tasks' aria-hidden='true'></span> Create Task</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createTaskForm" method="POST">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="wp_id">
                        <input type="hidden" name="status" value="in_progress">
                        <input type="hidden" name="wp_start_date">
                        <input type="hidden" name="wp_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="start_date">Start Date:</label>
                                <input type="date" name="start_date" class="form-control datepicker" data-error="Please enter start date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="end_date">End Date:</label>
                                <input type="date" name="end_date" class="form-control datepicker" data-error="Please enter end date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Partner:</label>
                            <select name="partner_id" class="form-control" required>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-task btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div class="modal fade" id="edit-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-tasks' aria-hidden='true'></span> Edit Task</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editTaskForm" method="POST">
                        <input type="hidden" name="id">
                        <input type="hidden" name="wp_id">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="wp_start_date">
                        <input type="hidden" name="wp_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="start_date">Start Date:</label>
                                <input type="date" name="start_date" class="form-control datepicker" data-error="Please enter start date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="end_date">End Date:</label>
                                <input type="date" name="end_date" class="form-control datepicker" data-error="Please enter end date." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Partner:</label>
                            <select name="partner_id" class="form-control" required>
                                <option></option>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="completed" id="completed" value="0">
                                Completed
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-task btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Milestone Modal -->
    <div class="modal fade" id="create-milestone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-certificate' aria-hidden='true'></span> Create Milestone</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createMilestoneForm" method="POST">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="status" value="in_progress">
                        <input type="hidden" name="wp_id">
                        <input type="hidden" name="wp_start_date">
                        <input type="hidden" name="wp_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="mil_date">Date:</label>
                            <input type="date" name="mil_date" class="form-control datepicker" data-error="Please enter date." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="coordinator_id">Partner:</label>
                            <select name="coordinator_id" class="form-control" required>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-milestone btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Milestone Modal -->
    <div class="modal fade" id="edit-milestone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-certificate' aria-hidden='true'></span> Edit Milestone</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editMilestoneForm" method="POST">
                        <input type="hidden" name="id">
                        <input type="hidden" name="wp_id">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="wp_start_date">
                        <input type="hidden" name="wp_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="mil_date">Date:</label>
                            <input type="date" name="mil_date" class="form-control datepicker" data-error="Please enter date." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="coordinator_id">Partner:</label>
                            <select name="coordinator_id" class="form-control" required>
                                <option></option>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="completed" id="completed" value="0">
                                Completed
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-milestone btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Deliverable Modal -->
    <div class="modal fade" id="create-deliverable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-send' aria-hidden='true'></span> Create Deliverable</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createDeliverableForm" method="POST">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="status" value="in_progress">
                        <input type="hidden" name="task_id">
                        <input type="hidden" name="task_start_date">
                        <input type="hidden" name="task_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="del_date">Date:</label>
                            <input type="date" name="del_date" class="form-control datepicker" data-error="Please enter date." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Partner:</label>
                            <select name="partner_id" class="form-control" required>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <input type="hidden" name="status" value="in_progress">
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-deliverable btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Deliverable Modal -->
    <div class="modal fade" id="edit-deliverable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-send' aria-hidden='true'></span> Edit Deliverable</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editDeliverableForm" method="POST">
                        <input type="hidden" name="id">
                        <input type="hidden" name="project_id">
                        <input type="hidden" name="task_id">
                        <input type="hidden" name="task_start_date">
                        <input type="hidden" name="task_end_date">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="del_date">Date:</label>
                            <input type="date" name="del_date" class="form-control datepicker" data-error="Please enter date." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Reminder:</label>
                            <input type="date" name="reminder" class="form-control datepicker" data-error="Please enter a reminder." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="reminder">Partner:</label>
                            <select name="partner_id" class="form-control" required>
                                <option></option>
                                <?php
                                if (!empty($partners)) {
                                    foreach ($partners as $partner) {
                                        echo '<option value="'.$partner->id.'">'.$partner->user_nicename.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="completed" id="completed" value="0">
                                Completed
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-deliverable btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Notice Modal -->
    <div class="modal fade" id="create-notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Create Notice</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createNoticeForm" method="POST">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="project_id" id="project_id">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-notice btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Notice Modal -->
    <div class="modal fade" id="edit-notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit Notice</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editNoticeForm" method="POST">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="project_id" id="project_id">
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="name">Name:</label>
                                <input type="text" name="name" class="form-control" data-error="Please enter a name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="slug">Slug:</label>
                                <input type="text" name="slug" class="form-control" data-error="Please enter a valid slug." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-notice btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
