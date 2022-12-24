<?php require_once "view/admin/part/header.php" ?>

<?php require_once "view/admin/part/sidbar.php" ?>


<main role="main " class="col-md-9 ml-sm-auto col-lg-10 px-4 ">

    <section class="pt-3 pb-1 mb-2 border-bottom ">
        <h1 class="h5 ">Create Category</h1>
    </section>
    <section class="row my-3 ">
        <section class="col-12 ">
            <form method="post" action="<?= helper::url("admin/category/store") ?>">
                <div class="form-group ">
                    <label for="name ">Title</label>
                    <input type="text " class="form-control " id="name" name="name" placeholder="Enter name ... ">
                </div>
                <button type="submit " class="btn btn-primary btn-sm ">store</button>
            </form>
        </section>


</main>


<?php require_once "view/admin/part/footer.php" ?>

