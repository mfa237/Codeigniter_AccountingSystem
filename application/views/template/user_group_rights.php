<style>
/*
    .tab-container .nav.nav-tabs li a {
        background: #414141 !important;
        color: white !important;
    }

    .tab-container .nav.nav-tabs li a:hover {
        background: #414141 !important;
        color: white !important;
    }

    .tab-container .nav.nav-tabs li a:focus {
        background: #414141 !important;
        color: white !important;
    }
    */
</style>

<center>
    <table width="100%" class="table table-striped" style="font-family: tahoma;">
        <tbody>
        <tr class="row_child_tbl_user_group_list">
            <td>
                <br />

                <div class="tab-container tab-left tab-default">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#user_rights_<?php echo $user_group_id; ?>" data-toggle="tab"><i class="fa fa-users"></i> Information</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="user_rights_<?php echo $user_group_id; ?>" style="min-height: 300px;">

                            <form id="frm_user_group_rights_<?php echo $user_group_id; ?>">

                            <input type="hidden" name="user_group_id" value="<?php echo $user_group_id; ?>">

                            <span style="margin-left: 1%"><b><i class="fa fa-list"></i> User Group Rights</b></span>
                            <hr />
                            <div class="table-responsive">
                                <table id="tbl_user_group_rights" class="table table-striped"  cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="80%">Description</th>
                                        <th width="20%">Permission</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($rights as $right){ ?>
                                            <tr style="border: 1px solid lightgray;">
                                                <td><?php echo $right->link_name; ?></td>
                                                <td>
                                                    <select name="link_code[]" class="cbo_links">
                                                        <option value="<?php echo $right->link_code; ?>" <?php echo ($right->is_allowed?'selected':''); ?>>Enable</option>
                                                        <option value="0" <?php echo ($right->is_allowed?'':'selected'); ?>>Disable</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            </form>


                            <hr />
                            <div class="row">
                                <div class="col-lg-12">
                                    <button id="btn_user_group_rights_<?php echo $user_group_id; ?>" class="btn btn-primary <?php echo ($user_group_id==1?'disabled':''); ?>" style="text-transform: none;"><i class="fa fa-check-circle"></i><span class=""></span> Save User Group Rights</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


            </td>
        </tr>
        </tbody>

    </table>
</center>

