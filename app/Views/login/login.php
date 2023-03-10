<?= $this->extend('login/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->has('error')) : ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?php if (is_array(session('error'))) : ?>
      <?php foreach (session('error') as $error) : ?>
        <h1> <?= esc($error) ?></h1>
      <?php endforeach ?>
    <?php else : ?>
      <h1><?= esc(session('error')) ?></h1>
    <?php endif ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>
<div class="animate form ">
  <section class="login_content">
    <form method="post" action="<?= base_url('login-auth') ?>">
      <h1>Login MKDIR</h1>
      <div>
        <input type="text" class="form-control" placeholder="Username" required name="username" />
      </div>
      <div>
        <input type="password" class="form-control" placeholder="Password" required name="password" />
      </div>
      <div>
        <button class="btn btn-default submit" type="submit">Log in</button>
        <a class="reset_pass" href="#">Lost your password?</a>
      </div>

      <div class="clearfix"></div>

      <div class="separator">
        <p class="change_link">New to site?
          <a href="<?= base_url('register') ?>" class="to_register"> Create Account </a>
        </p>
        <div class="clearfix"></div>
      </div>
    </form>
  </section>
</div>


<?= $this->endSection() ?>