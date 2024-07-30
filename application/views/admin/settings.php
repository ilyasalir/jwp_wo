<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Setting Profile Website</h3>
                    <h6 class="font-weight-normal mb-0">JWP Wedding Organizer</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Setting  Profile Website</h4>
                  <?= $this->session->flashdata('message');?>
                  <form action="<?= base_url('admin/Settings/updateData');?>" method="post" enctype="multipart/form-data">
                     <input type="hidden" value="<?= $settings->id;?>" name="id">
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Name Website</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="website_name" placeholder="Website Name" value="<?= $settings->website_name;?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Phone Number 1</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="phone_number1" placeholder="Phone Number 1" value="<?= $settings->phone_number1;?>" required>
                            </div>  
                            <div class="form-group">
                                <label for="exampleInputName1">Phone Number 2</label>
                                <<input type="text" class="form-control" id="exampleInputName1" name="phone_number2" placeholder="Phone Number 2" value="<?= $settings->phone_number2;?>">
                            </div>  
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Email 1</label>
                                <input type="email" class="form-control" id="exampleInputName1" name="email1" placeholder="Email 1"
                                 value="<?= $settings->email1;?>" required>
                            </div>  
                            <div class="form-group">
                                <label for="exampleInputName1">Email 2</label>
                                <<input type="email" class="form-control" id="exampleInputName1" name="email2" placeholder="Email 2"
                                 value="<?= $settings->email2;?>">
                            </div>  
                        </div>                        

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleAddress1">Address</label>
                                <textarea class="form-control" id="exampleAddress1" name="address" rows="4"><?= $settings->address;?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleMaps1">Maps</label>
                                <textarea class="form-control" id="exampleMaps1" name="maps" rows="4"><?= $settings->maps;?></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Logo Website</label>
                                <input type="file" class="form-control" id="exampleInputName1" name="logo" value="">
                            </div>
                            <div class="form-group">
                                <img src="<?= base_url('assets/files/').$settings->logo;?>" class="img-thumbnail" style="max-width: 120px;" alt="">   
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputName1">Facebook</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="facebook_url" placeholder="Facebook"
                                 value="<?= $settings->facebook_url;?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Instagram</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="instagram_url" placeholder="Instagram"
                                 value="<?= $settings->instagram_url;?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Youtube</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="youtube_url" placeholder="Youtube"
                                 value="<?= $settings->youtube_url;?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleHeaderBussinesHour1">Header Bussines Hour</label>
                                <textarea class="form-control" id="exampleHeaderBussinesHour1" name="header_bussines_hour" rows="4"><?= $settings->header_bussines_hour;?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTimeBussinesHour1">Time Bussines Hour</label>
                                <textarea class="form-control" id="exampleTimeBussinesHour1" name="time_bussines_hour" rows="4"><?= $settings->time_bussines_hour;?>
                                </textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-warning mr-2">Update</button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>