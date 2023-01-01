<?php require_once "view/app/part/header.php" ?>

    <div class="site-main-container">
        <!-- Start top-post Area -->
        <section class="top-post-area pt-10">
            <div class="container no-padding">
                <div class="row small-gutters">
                    <div class="col-lg-8 top-post-left">
                        <div class="feature-image-thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid" src="img/top-post1.jpg" alt="">
                        </div>
                        <div class="top-post-details">
                            <ul class="tags">
                            </ul>
                            <a href="image-post.php">
                                <h3>عنوان خبر</h3>
                            </a>
                            <ul class="meta">
                                <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                <li><a href="#">۱۳۳۹/۲/۴<span class="lnr lnr-calendar-full"></span></a></li>
                                <li><a href="#">۵<span class="lnr lnr-bubble"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 top-post-right">
                        <div class="single-top-post">
                            <div class="feature-image-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="img/top-post2.jpg" alt="">
                            </div>
                            <div class="top-post-details">
                                <ul class="tags">

                                </ul>
                                <a href="image-post.php">
                                    <h4>عنوان</h4>
                                </a>
                                <ul class="meta">
                                    <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                    <li><a href="#">۱۳۳۹/۲/۴<span class="lnr lnr-calendar-full"></span></a></li>
                                    <li><a href="#"> ۱<span class="lnr lnr-bubble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-top-post mt-10">
                            <div class="feature-image-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="img/top-post3.jpg" alt="">
                            </div>
                            <div class="top-post-details">
                                <ul class="tags">
                                </ul>
                                <a href="image-post.php">
                                    <h4>عنوان</h4>
                                </a>
                                <ul class="meta">
                                    <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                    <li><a href="#">۱۳۳۹/۲/۴<span class="lnr lnr-calendar-full"></span></a></li>
                                    <li><a href="#">۵<span class="lnr lnr-bubble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="news-tracker-wrap">
                            <h6><span>خبر فوری:</span> <a href="#">مربی تیم ایران اخراج شد</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End top-post Area -->
        <!-- Start latest-post Area -->
        <section class="latest-post-area pb-120">
            <div class="container no-padding">
                <div class="row">
                    <div class="col-lg-8 post-list">
                        <!-- Start latest-post Area -->
                        <div class="latest-post-wrap">
                            <h4 class="cat-title">آخرین اخبار</h4>
                            <?php foreach ($last_news as $news): ?>
                                <div class="single-latest-post row align-items-center">
                                    <div class="col-lg-5 post-left">
                                        <div class="feature-img relative">
                                            <div class="overlay overlay-bg"></div>
                                            <img class="img-fluid" src="<?= $news->image ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-7 post-right">
                                        <a href="image-post.php">
                                            <h4><?= $news->title ?></h4>
                                        </a>
                                        <ul class="meta">
                                            <li><a href="#"><span class="lnr lnr-user"></span> <?= $news->writer ?> </a>
                                            </li>
                                            <li><a href="#"> <?= $news->created_at ?> <span
                                                            class="lnr lnr-calendar-full"></span></a></li>
                                            <li><a href="#"> <?= $news->comment_count ?><span
                                                            class="lnr lnr-bubble"></span></a></li>
                                        </ul>
                                        <p class="excert">
                                            <?= $news->summary ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- End latest-post Area -->

                        <!-- Start banner-ads Area -->
                        <div class="col-lg-12 ad-widget-wrap mt-30 mb-30">
                            <?php if (isset($banners_down)) {?>
                                <img class="img-fluid" src="<?=helper::url($banners_down->image)?>" alt="">
                            <?php } else { ?>
                                <img class="img-fluid" src="img/banner-ad.jpg" alt="">

                            <?php } ?>
                        </div>
                        <!-- End banner-ads Area -->
                        <!-- Start popular-post Area -->
                        <div class="popular-post-wrap">
                            <h4 class="title">اخبار پربازدید</h4>
                            <div class="row mt-20 medium-gutters">
                                <?php foreach ($most_view_posts as $post): ?>
                                    <div class="col-lg-6 single-popular-post mb-3">
                                        <div class="feature-img-wrap relative">
                                            <div class="feature-img relative">
                                                <div class="overlay overlay-bg"></div>
                                                <img class="img-fluid" src="<?= $post->image ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="details">
                                            <a href="image-post.php">
                                                <h4><?= $post->title ?></h4>
                                            </a>
                                            <ul class="meta">
                                                <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                                <li><a href="#"><?= $post->created_at ?><span
                                                                class="lnr lnr-calendar-full"></span></a>
                                                </li>
                                                <li><a href="#"> ۵<span class="lnr lnr-bubble"></span></a></li>
                                            </ul>
                                            <p class="excert">
                                                <?= $post->summary ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- End popular-post Area -->
                    </div>
                    <div class="col-lg-4">
                        <?php require_once "view/app/part/sidebar.php" ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End latest-post Area -->
    </div>

<?php require_once "view/app/part/footer.php" ?>