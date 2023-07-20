<section class="invoice">
    <form class="form-horizontal" id="crud_form" action="<?php echo $home . '/' . $module . '/' . $controller . '/' . $method; ?>/submit/" method="post">  
        
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                   <?php echo $page_title; ?>
                </h2>
            </div><!-- /.col -->
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <table class=" table table-responsive table-striped table-bordered">
                    <th>User</th><th>Roles</th><th>Description</th>
                    <?php foreach ($userRoleData as $userRData) : ?>
                    <tr>
                        <td><font color="blue"><?php echo $userRData['user_nicename'] ?></font></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                         <?php if(is_array($userRData['Roles'])) :  
                             foreach ($userRData['Roles'] as $urdArr) :   ?>
                        <tr>
                            <td width="300px"><a class="form-control btn-danger" href="<?php echo $home . '/' . $module . '/' . $controller . '/unassign/'. $userRData['ID'] . '/' .$urdArr['ID']; ?>">Delete Role</a></td>
                            <td><?php echo $urdArr['Title']; ?></td>
                            <td><?php echo $urdArr['Description']; ?></td>
                        </tr>
                         <?php endforeach; 
                               endif;?></td>
                    
                    <?php endforeach;?>
                </table>
            </div><!-- /.col -->
        </div>
        
        <!-- info row -->
<div class="row">
            <div class="col-md-12">

                <div class="form-group">
                    <label for="user_id" class="col-sm-2 control-label">User</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="user_id" id="user_id">
                            <?php foreach ($user_data as $us_opt_key => $us_opt_value): ?>
                                <option  value="<?php echo $us_opt_key; ?>" title="<?php echo $us_opt_value; ?>"><?php echo $us_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="role_ID" class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role_ID" id="role_ID">
                            <?php foreach ($role_data as $rl_opt_key => $rl_opt_value): ?>
                                <option  value="<?php echo $rl_opt_key; ?>" title="<?php echo $rl_opt_value; ?>"><?php echo $rl_opt_value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                

            </div><!-- /.left column -->
        </div>



        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                
                <button type =" submit" class="btn btn-success pull-right" onmouseover="subtotal_pac()" onfocus="subtotal_pac()"><i class="fa fa-credit-card"></i>Submit</button>
            </div>
        </div>
    </form>

</section>