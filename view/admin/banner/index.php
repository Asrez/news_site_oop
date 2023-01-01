<?php require_once "view/admin/part/header.php" ?>
<?php require_once "view/admin/part/sidbar.php" ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h5"><i class="fas fa-image"></i> Banner</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a role="button" href="<?=helper::url("admin/banner/create")?>" class="btn btn-sm btn-success">create</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <caption>List of banners</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>url</th>
                    <th>position</th>
                    <th>image</th>
                    <th>setting</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($banners as $banner): ?>
                    <tr>
                        <td>
                            <?= $banner->id ?>
                        </td>
                        <td>
                            <?= $banner->url ?>
                        </td>
                        <td>
                            <?= $banner->position ?>
                        </td>
                        <td><img style="width: 80px;" src="<?= helper::url($banner->image) ?>" alt=""></td>
                        <td>
                            <a role="button" class="btn btn-sm btn-primary text-white" href="<?=helper::url("admin/banner/edit/$banner->id")?>">edit</a>
                            <a role="button" class="btn btn-sm btn-danger text-white" href="<?=helper::url("admin/banner/delete/$banner->id")?>">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>

            </table>
        </div>


    </main>
<?php require_once "view/admin/part/footer.php" ?>