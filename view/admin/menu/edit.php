<?php require_once "view/admin/part/header.php" ?>
<?php require_once "view/admin/part/sidbar.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">Edit Menu</h1>
    </section>

    <section class="row my-3">
        <section class="col-12">
            <form method="post" action="<?=helper::url("admin/menu/update/$menu->id")?>">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name ..."
                           value="<?= $menu->name ?>" required>
                </div>

                <div class="form-group">
                    <label for="url">url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter url ..."
                           value=" <?= $menu->url ?> " required>
                </div>
                <div class="form-group">
                    <label for="parent_id">parent ID</label>
                    <select name="parent_id" id="parent_id" class="form-control" autofocus>
                        <option value="0">0</option>
                        <?php foreach ($all_parent_menus as $item): ?>
                            <option value="<?= $item->id ?> " <?= $item->id == $menu->parent_id ? "selected" : "" ?> ><?= $item->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">update</button>
            </form>
        </section>
    </section>


</main>
<?php require_once "view/admin/part/footer.php" ?>
