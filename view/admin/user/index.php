<?php require_once "view/admin/part/header.php" ?>
<?php require_once "view/admin/part/sidbar.php" ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h5"><i class="fas fa-newspaper"></i> Users</h1>
        </div>
        <section class="table-responsive">
            <table class="table table-striped table-sm">
                <caption>List of users</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>username</th>
                    <th>email</th>
                    <th>permission</th>
                    <th>created at</th>
                    <th>setting</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->permission ?></td>
                        <td><?= $user->created_at ?></td>
                        <td>
                            <?php if ($user->permission == "user"): ?>
                                <a role="button" class="btn btn-sm btn-success text-white" href="<?=helper::url("admin/user/permission_edit/$user->id")?>">click to be admin</a>
                            <?php elseif ($user->permission == "admin"): ?>
                                <a role="button" class="btn btn-sm btn-warning text-white" href="<?=helper::url("admin/user/permission_edit/$user->id")?>">click not to be admin</a>
                            <?php endif; ?>
                            <a role="button" class="btn btn-sm btn-primary text-white" href="<?=helper::url("admin/user/edit/$user->id")?>">edit</a>
                            <a role="button" class="btn btn-sm btn-danger text-white" href="<?=helper::url("admin/user/delete/$user->id")?>">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>


    </main>
<?php require_once "view/admin/part/footer.php" ?>