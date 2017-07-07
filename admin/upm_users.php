<?php
function upm_users() { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><span class="glyphicon glyphicon-user"></span>
                    Partners
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-user">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add new
                    </button>
                </h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <small id="msg"></small>
                </div>
            </div>
            <div class="row" id="users-list"></div>
        </div>
    </div>
    <?php
    global $current_user;
    get_current_user();
    ?>

    <!-- Create user Modal -->
    <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Create User</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="createUserForm" method="POST">
                        <input type="hidden" name="manager_id" value="<?php echo $current_user->ID; ?>">
                        <div class="form-group has-feedback">
                            <label class="control-label" for="user_login">Username:</label>
                            <input type="text" name="user_login" class="form-control" data-error="Please enter user name." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="user_email">Email:</label>
                            <input type="email" name="user_email" class="form-control" data-error="Please enter a valid email." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="password">Password:</label>
                                <input type="password" name="password" class="form-control" data-error="Please enter a valid password." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="repeat_password">Repeat Password:</label>
                                <input type="password" name="repeat_password" class="form-control" data-error="You did not repeat the password correctly ." data-match="password" required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="first_name">First Name:</label>
                                <input type="text" name="first_name" class="form-control" data-error="Please enter first name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="last_name">Last Name:</label>
                                <input type="text" name="last_name" class="form-control" data-error="Please enter last name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="telephone">Telephone:</label>
                                <input type="tel" name="telephone" class="form-control" data-error="Please enter a telephone." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-xs-6">
                                <label class="control-label" for="cellphone">Cellphone:</label>
                                <input type="tel" name="cellphone" class="form-control" data-error="Please enter a cellphone." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="user_url">Website:</label>
                            <input type="url" name="user_url" class="form-control" data-error="Please enter a website." />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-create-user btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit user info Modal -->
    <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit User
                    </h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editUserForm" method="POST">
                        <input type="hidden" title="user_id" name="user_id">
                        <h3>Account Info:</h3>
                        <div class="row">
                            <div class="form-group has-feedback col-md-6">
                                <label class="control-label" for="first_name">First Name:</label>
                                <input type="text" title="first_name" name="first_name" class="form-control" data-error="Please enter first name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-md-6">
                                <label class="control-label" for="last_name">Last Name:</label>
                                <input type="text" title="last_name" name="last_name" class="form-control" data-error="Please enter last name." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-md-6">
                                <label class="control-label" for="user_email">Email:</label>
                                <input type="email" title="user_email" name="user_email" class="form-control" data-error="Please enter email." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group has-feedback col-md-6">
                                <label class="control-label" for="user_url">Website:</label>
                                <input type="url" title="user_url" name="user_url" class="form-control" data-error="Please enter a website." />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group has-feedback col-md-6">
                                <label class="control-label" for="telephone">Telephone:</label>
                                <input type="tel" title="telephone" name="telephone" class="form-control" data-error="Please enter a telephone." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback col-md-6">
                                <label class="control-label" for="cellphone">Cellphone:</label>
                                <input type="tel" title="cellphone" name="cellphone" class="form-control" data-error="Please enter a cellphone." required />
                                <span class="glyphicon form-control-feedback"></span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-user btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit password Modal -->
    <div class="modal fade" id="edit-user-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <span class='glyphicon glyphicon-lock' aria-hidden='true'></span> Edit password
                    </h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" class="editPasswordForm" method="POST">
                        <input type="hidden" name="user_id">
                        <div class="form-group has-feedback">
                            <label class="control-label" for="new_pass">Password:</label>
                            <input type="password" title="new_pass" name="new_pass" class="form-control" data-error="Please enter a valid password." required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label" for="repeat_new_pass">Repeat Password:</label>
                            <input type="password" title="repeat_new_pass" name="repeat_new_pass" class="form-control" data-error="You did not repeat the password correctly ." data-match="password" required />
                            <span class="glyphicon form-control-feedback"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn crud-edit-user-password btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}