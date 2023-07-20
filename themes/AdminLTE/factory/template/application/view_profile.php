<div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <h3 class="widget-user-username"><?php if(isset($userData['Name'])){echo $userData['Name'];} ?></h3>
                </div>
                <div class="widget-user-image">
                  <?php if(isset($userData['Photo'])): ?><img class="img-circle" src="<?php echo $home .'/'. $userData['Photo']; ?>" alt="User Avatar"> <?php endif; ?>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Role</h5>
                        <span class="description-text"><?php if(isset($userTitle)){echo $userTitle;} ?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Employee ID</h5>
                        <span class="description-text"><?php if(isset($userData['ID'])){echo $userData['ID'];} ?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Address</h5>
                        <span class="description-text"><?php if(isset($userData['Address'])){echo $userData['Address'];} ?></span><br>
                        <span class="description-text">Pin: <?php if(isset($userData['Pincode'])){echo $userData['Pincode'];} ?></span><br>
                        <span class="description-text"> phone: <?php if(isset($userData['Address'])){echo $userData['Phone'];} ?></span><br>
                        <span class="description-text"> Email: <?php if(isset($userData['Email'])){echo $userData['Email'];} ?></span><br>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div>