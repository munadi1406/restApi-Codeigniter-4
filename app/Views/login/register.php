<?= $this->extend('login/layout') ?>
<?= $this->section('content') ?>

<div class="animate form ">
    <section class="login_content">
        <form method="POST" action="<?= base_url('register') ?>">
            <h1>Create Account</h1>
            <?php if (session()->has('error')) {
                if (is_array(session('error'))) { ?>
                    <?php foreach (session('error') as $error) : ?>
                        <h3><?= $error ?></h3>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <h3><?= session('error') ?></h3>
            <?php }
            } ?>
            <div>
                <input type="text" class="form-control" placeholder="Username" required name="username" />
            </div>
            <div>
                <input type="email" class="form-control" placeholder="Email" required name="email" />
            </div>
            <div>
                <input type="password" class="form-control" placeholder="Password" required name="password" />
            </div>
            <div>
                <button class="btn btn-default submit" type="submit">Submit</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">Already a member ?
                    <a href="<?= base_url('login') ?>" class="to_register"> Log in </a>
                </p>
                <div class="clearfix"></div>
            </div>
        </form>
    </section>
</div>


<?= $this->endSection() ?>