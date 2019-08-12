<?php require('partials/head.php'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">All members</h1>
        </div>
    </div>
    <?php if (isset($users)) : ?>
        <div class="row">
            <div class="col">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Report subject</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $key => $user) : ?>
                            <tr>
                                <td scope="row"><?= ++$key ?></td>
                                <td>
                                    <img class="img rounded-circle profile-img"
                                         src="<?= ! empty($user['photo']) ? $user['photo'] : '/public/img/no-image.png' ?>"
                                         alt="user_photo">
                                </td>
                                <td><?= $user['firstname'] ?> <?= $user['lastname'] ?></td>
                                <td><?= $user['reportSubject'] ?></td>
                                <td><a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col">
            <a href="/" class="members btn btn-success float-right">Back to homepage</a>
        </div>
    </div>
</div>
<?php require('partials/footer.php'); ?>
