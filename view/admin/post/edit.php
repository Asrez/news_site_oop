<?php require_once "view/admin/part/header.php" ?>
<?php require_once "view/admin/part/sidbar.php" ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">Edit Article</h1>
    </section>
    <section class="row my-3">
        <section class="col-12">
            <form method="post" action="<?= helper::url("admin/post/update/$post->id") ?>"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                           value="<?= $post->title ?>">
                </div>
                <div class="form-group" style="width: 100px;">
                    <label for="cat_id">Category</label><br>
                    <?php foreach ($all_categories as $category_item): ?>
                        <div style="margin-right: auto">
                            <input type="checkbox" name="category[]" value="<?= $category_item->id ?>"
                                <?php foreach ($post->categories as $category): ?>
                                    <?php if ($category->cat_id == $category_item->id): ?>
                                        checked
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            >
                            <label><?= $category_item->name ?></label><br>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="form-group">
                    <img style="width: 100px;" src="" alt="">
                    <hr/>
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control-file" autofocus>
                </div>

                <div class="form-group">
                    <label for="published_at">published at</label>
                    <input type="text" class="form-control" id="published_at" name="published_at" value="<?=$post->published_at?>" required
                           autofocus>
                </div>

                <div class="form-group">
                    <label for="summary">summary</label>
                    <textarea class="form-control" id="summary" name="summary" placeholder="summary ..."
                              rows="3"><?= $post->summary ?></textarea>
                </div>
                <div class="form-group">
                    <label for="body">body</label>
                    <textarea class="form-control" id="body" name="body" rows="5"><?= $post->body ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">update</button>
            </form>
        </section>
    </section>


</main>
<?php require_once "view/admin/part/footer.php" ?>
