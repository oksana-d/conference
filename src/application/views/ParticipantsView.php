<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">All members</h1>
        </div>
    </div>
    <?php if (isset($users)): ?>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-responsive">
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
                    <?php foreach ($users as $key => $user): ?>
                        <tr>
                            <th scope="row"><?= ++$key ?></th>
                            <td>
                                <img class="img rounded-circle profile-img" src="<?= !empty($user['photo']) ? $user['photo'] : 'img/no-image.png' ?>" alt="user_photo">
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
    <?php endif; ?>
</div>
