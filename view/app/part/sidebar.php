<div class="sidebars-area">
    <div class="single-sidebar-widget editors-pick-widget">
        <h6 class="title">انتخاب سردبیر</h6>
        <?php foreach ($selected_news as $news): ?>
            <div class="editors-pick-post">
                <div class="feature-img-wrap relative">
                    <div class="feature-img relative">
                        <div class="overlay overlay-bg"></div>
                        <img class="img-fluid" src="<?= helper::url($news->image) ?>" alt="">
                    </div>
                </div>
                <div class="details">
                    <a href="image-post.php">
                        <h4 class="mt-20"><?= $news->title ?></h4>
                    </a>
                    <ul class="meta">
                        <li><a href="#"><span class="lnr lnr-user"></span> <?= $news->writer ?> </a></li>
                        <li><a href="#"><?= $news->created_at ?><span class="lnr lnr-calendar-full"></span></a></li>
                        <li><a href="#"><?= $news->comment_count ?><span class="lnr lnr-bubble"></span></a></li>
                    </ul>
                    <p class="excert">
                        <?= $news->summary ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="single-sidebar-widget ads-widget">
        <?php if (isset($banners_side)) {
            ?>
            <img class="img-fluid" src="<?=helper::url($banners_side->image)?>" alt="">
        <?php } else { ?>
            <img class="img-fluid" src="img/sidebar-ads.jpg" alt="">
        <?php } ?>
    </div>

    <div class="single-sidebar-widget most-popular-widget">
        <h6 class="title">پر بحث ترین ها</h6>
        <?php foreach ($most_comment_posts as $post): ?>
            <div class="single-list flex-row d-flex">
                <div class="thumb">
                    <img style="width: 100px;height: 80px" src="<?= helper::url($post->image) ?>" alt="">
                </div>
                <div class="details">
                    <a href="image-post.php">
                        <h6><?= $post->title ?></h6>
                    </a>
                    <ul class="meta">
                        <li><a href="#"> <?= $post->created_at ?> <span class="lnr lnr-calendar-full"></span></a></li>
                        <li><a href="#"> <?= $post->comment_count ?> <span class="lnr lnr-bubble"></span></a></li>
                    </ul>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

</div>
