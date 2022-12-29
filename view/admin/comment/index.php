<?php require_once "view/admin/part/header.php"; ?>
<?php require_once "view/admin/part/sidbar.php"; ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5"><i class="fas fa-newspaper"></i> Comments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a role="button" href="#" class="btn btn-sm btn-success disabled">create</a>
        </div>
    </div>
    <section class="table-responsive">
        <table class="table table-striped table-sm">
            <caption>List of comments</caption>
            <thead>
            <tr>
                <th>#</th>
                <th>user ID</th>
                <th>post ID</th>
                <th>comment</th>
                <th>status</th>
                <th>setting</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= $comment->id ?></td>
                    <td><a href=""><?= $comment->username ?></a>
                    </td>
                    <td>
                        <?= $comment->title ?>
                    </td>
                    <td>
                        <?= $comment->body ?>
                    </td>
                    <td>
                        <?= $comment->status ?>
                    </td>
                    <td>
                        <?php if ($comment->status == "unseen" || $comment->status == "seen"): ?>
                            <a role="button" class="btn btn-sm btn-success text-white"
                               href="<?= helper::url("admin/user/status_edit_to_approved/$comment->id") ?>">click to approved</a>
                        <?php endif; if ($comment->status == "unseen" || $comment->status == "approved"): ?>
                            <a role="button" class="btn btn-sm btn-warning text-white"
                               href="<?= helper::url("admin/user/status_edit_to_seen/$comment->id") ?>">click not to approved</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>


</main>
<?php require_once "view/admin/part/footer.php"; ?>
