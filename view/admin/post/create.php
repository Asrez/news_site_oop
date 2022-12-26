<?php require_once "view/admin/part/header.php" ?>
<?php require_once "view/admin/part/sidbar.php" ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <section class="pt-3 pb-1 mb-2 border-bottom">
            <h1 class="h5">Create Article</h1>
        </section>

        <section class="row my-3">
            <section class="col-12">

                <form method="post" action="<?= helper::url("admin/post/store") ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"  placeholder="Enter title ..."
                                autofocus>
                    </div>

                    <?php foreach ($all_categories as $category_item): ?>
                        <div style="margin-right: auto">
                            <input type="checkbox" name="categories[]" value="<?= $category_item->id ?>"
                            <label><?= $category_item->name ?></label><br>
                        </div>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control-file"  autofocus>
                    </div>

                    <div class="form-group">
                        <label for="published_at">published at</label>
                        <input type="text" class="form-control" id="title" name="published_at" value="<?=date("Y-m-d H:i:s",time())?>" autofocus></div>

                    <div class="form-group">
                        <label for="summary">summary</label>
                        <textarea class="form-control" id="summary" name="summary" placeholder="summary ..." rows="3"
                                   autofocus></textarea>
                    </div>

                    <div class="form-group">
                        <label for="body">body</label>
                        <textarea class="form-control" id="body" name="body" placeholder="body ;,','..." rows="5"
                                  autofocus></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">store</button>
                </form>
            </section>
        </section>


    </main>
<?php require_once "view/admin/part/footer.php" ?>