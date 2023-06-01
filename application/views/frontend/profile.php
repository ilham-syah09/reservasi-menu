 <!-- Contact Start -->
 <div class="container-fluid pt-5">
     <div class="text-center mb-4">
         <h2 class="section-title px-5"><span class="px-2">Your Profile</span></h2>
     </div>
     <div class="row px-xl-5">
         <div class="col-lg-6 mb-5">
             <form action="<?= base_url('changeProfile'); ?>" method="post" enctype="multipart/form-data">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="font-weight-semi-bold mb-4">Profile</h4>
                         <div class="text-center p-2 mb-3">
                             <img src="<?= base_url('upload/profile/' . $this->dt_user->image); ?>" width="150" class="img-fluid rounded-circle" alt="avatar">
                         </div>
                         <div class="row">
                             <input type="hidden" name="id" value="<?= $this->dt_user->id; ?>">
                             <input type="hidden" name="previmage" value="<?= $this->dt_user->image; ?>">
                             <div class="col-md-12 form-group">
                                 <label>Image</label>
                                 <input class="form-control" type="file" name="image">
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Name</label>
                                 <input class="form-control" type="text" value="<?= $this->dt_user->name; ?>" name="name">
                             </div>
                             <div class="col-md-6 form-group">
                                 <label>Email</label>
                                 <input class="form-control" type="text" value="<?= $this->dt_user->email; ?>" readonly name="email">
                             </div>
                             <div class="col-md-12 form-group">
                                 <label>No Hp</label>
                                 <input class="form-control" type="text" value="<?= $this->dt_user->noHp; ?>" name="noHp">
                             </div>

                             <div class="col-md-12 form-group">
                                 <label>Alamat</label>
                                 <textarea name="alamat" class="form-control"><?= $this->dt_user->alamat; ?></textarea>
                             </div>
                         </div>
                         <div class="text-center">
                             <button type="submit" class="btn btn-primary">save</button>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
         <div class="col-lg-6 mb-5">
             <form action="<?= base_url('changePassword'); ?>" method="post" enctype="multipart/form-data">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="font-weight-semi-bold mb-4">Change Password</h4>
                         <div class="row">
                             <div class="col-md-12 form-group">
                                 <label>Current Password</label>
                                 <input class="form-control" type="password" name="current_password">
                             </div>
                             <div class="col-md-12 form-group">
                                 <label>New Password</label>
                                 <input class="form-control" type="password" name="password">
                             </div>
                             <div class="col-md-12 form-group">
                                 <label>Retype New Password</label>
                                 <input class="form-control" type="password" name="retype_password">
                             </div>
                         </div>
                         <div class="text-center">
                             <button type="submit" class="btn btn-primary">save</button>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Contact End -->