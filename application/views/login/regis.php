
<div style="font-family: Lucida Calligraphy;" class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Register</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">

      <form action="<?= base_url('Login/regis'); ?>" method="post">
        <div class="input-group mb-3">
          <input style="border:none; border-bottom: solid;" type="text" class="form-control" name="nm_user" value="<?= set_value('nm_user'); ?>" placeholder="Full name">
          <span class="pt-3 fas fa-user"></span>
        </div>
        <?= form_error('nm_user', '<small class="text-danger mb-2">', '</small>'); ?>
        <div class="input-group mb-3">
          <input style="border:none; border-bottom: solid;" type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Username">
          <span class="pt-3 fas fa-user"></span>
        </div>
        <?= form_error('username', '<small class="border-danger mb-2">', '</small>'); ?>
        <div class="input-group mb-3">
          <input style="border:none; border-bottom: solid;" type="password" class="form-control" name="password" placeholder="Password">

          <span class="pt-3 fas fa-lock"></span>
        </div>
        <?= form_error('password', '<small class="text-danger mb-2">', '</small>'); ?>
        <div class="row">
          <button type="submit" class="btn btn-block" style="background-color:#FFA07A;">Register</button>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <a href="<?= base_url('Login'); ?>" class="text-center">Sudah Punya Akun!!</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>