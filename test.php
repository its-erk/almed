<!-- Profile Card -->
            <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body text-center">
                  <img src="../dist/assets/images/faces/face1.jpg" alt="profile" class="img-lg rounded-circle mb-3">
                  <h4 class="card-title"><?= htmlspecialchars($user['full_name'] ?: $user['username']) ?></h4>
                  <p class="text-muted"><?= ucfirst($user['role']) ?></p>
                  <a href="profile-edit.php" class="btn btn-primary btn-sm mb-2">Edit Profile</a>
                  <a href="change-password.php" class="btn btn-outline-secondary btn-sm">Change Password</a>
                </div>
              </div>
            </div>

            <!-- Account Details Card -->
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Account Details</h4>
                  <p class="card-description">Update your personal and contact information</p>

                  <form method="POST" action="profile-update.php">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                      </div>

                      <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                      </div>

                      <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                      </div>

                      <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" value="<?= ucfirst($user['role']) ?>" disabled>
                      </div>

                      <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" value="<?= ucfirst($user['status']) ?>" disabled>
                      </div>
                    </div>

                    <div class="mt-4 text-end">
                      <button type="reset" class="btn btn-light">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>