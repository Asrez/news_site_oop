<?php require_once "view/admin/part/header.php" ?>
<?php require_once "view/admin/part/sidbar.php" ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h5"><i class="fas fa-newspaper"></i> Articles</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a role="button" href="<?= helper::url("admin/post/create") ?>"
                   class="btn btn-sm btn-success">create</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <caption>List of posts</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>summary</th>
                    <th>view</th>
                    <th>status</th>
                    <th>Writer</th>
                    <th>categories</th>
                    <th>image</th>
                    <th>setting</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>
                            <a class="text-primary" href="">
                                <?= $post->id ?>
                            </a>
                        </td>
                        <td>
                            <?= $post->title ?>
                        <td>
                            <?= helper::limit_word($post->summary, 10) ?>
                        </td>
                        <td>

                            <?= helper::limit_word($post->body, 30) ?>
                        </td>
                        <td>
                            <?php if ($post->is_brake): ?>
                                <span class="badge badge-success">#breaking_news</span>
                            <?php endif; ?>
                            <?php if ($post->is_selected): ?>
                                <span class="badge badge-dark">#editor_selected</span>
                            <?php endif; ?>

                        </td>
                        <td>
                            <?= $post->writer ?>
                        </td>

                        <td>
                            <?php foreach ($post->categories as $category):
                                echo $category->name;
                                echo "<br>";
                            endforeach; ?>
                        </td>
                        <td><img style="width: 80px;" src="<?= helper::url($post->image) ?>"</td>
                        <td style="width: 25rem;">
                            <a role="button" class="btn btn-sm btn-warning btn-dark text-white"
                               href="<?= helper::url("admin/post/edit/braking/$post->id") ?>">
                                <?= $post->is_brake === 1 ? "remove breaking news" : "add breaking news"; ?>
                            </a>
                            <a role="button" class="btn btn-sm btn-warning btn-dark text-white"
                               href="<?= helper::url("admin/post/edit/selected/$post->id") ?>">
                                <?= $post->is_selected === 1 ? "remove selected " : "add selected"; ?>
                            </a>
                            <hr class="my-1"/>
                            <a role="button" class="btn btn-sm btn-primary text-white"
                               href="<?= helper::url("admin/post/edit/$post->id") ?>">edit</a>
                            <a role="button" class="btn btn-sm btn-danger text-white"
                               href="<?= helper::url("admin/post/delete/$post->id") ?>">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>


    </main>
<?php require_once "view/admin/part/footer.php" ?>