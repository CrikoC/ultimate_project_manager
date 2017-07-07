<?php
function upm_projects() { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><span class="glyphicon glyphicon-list"></span>
                    Projects
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-project">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add new
                    </button>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <small id="msg"></small>
            </div>
        </div>
        <div class="row" id="projects-list"></div>
    </div>

    <?php
        global $current_user;
        get_current_user();
    ?>
    <!-- Create Project Modal -->
    <div class="modal fade" id="create-project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Create project</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createProjectForm" method="POST">
                        <input type="hidden" name="manager_id" value="<?php echo $current_user->ID; ?>">
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
                        <input type="hidden" name="status" value="in_progress">
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-project btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div class="modal fade" id="edit-project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit project</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editProjectForm" method="POST">
                        <input type="hidden" name="id">
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
                        <input type="hidden" name="status" value="in_progress">
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-project btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
