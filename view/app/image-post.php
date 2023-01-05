<?php require_once "view/app/part/header.php" ?>
    <div class="site-main-container">
        <!-- Start top-post Area -->
        <!-- End top-post Area -->
        <!-- Start latest-post Area -->
        <section class="latest-post-area pb-120">
            <div class="container no-padding">
                <div class="row">
                    <div class="col-lg-8 post-list">
                        <!-- Start single-post Area -->
                        <div class="single-post-wrap">
                            <div class="feature-img-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="<?= helper::url($post->image) ?>" alt="">
                            </div>
                            <div class="content-wrap">
                                <h3><?= $post->title ?></h3>
                                <ul class="meta pb-20">
                                    <li><a href="#"><span class="lnr lnr-user"></span><?= $post->user_id ?></a></li>
                                    <li><a href="#"><?= $post->created_at ?><span class="lnr lnr-calendar-full"></span></a>
                                    </li>
                                    <li><a href="#">۴<span class="lnr lnr-bubble"></span></a></li>
                                </ul>
                                <p><?= $post->body ?> </p>
                                <div class="navigation-wrap justify-content-between d-flex">
                                    <a class="prev" href="#"><span class="lnr lnr-arrow-right"></span>خبر بعدی</a>
                                    <a class="next" href="#">خبر قبلی<span class="lnr lnr-arrow-left"></span></a>
                                </div>

                                <div class="comment-sec-area">
                                    <div class="container">
                                        <div class="row flex-column">
                                            <h6>نظرات</h6>
                                            <?php foreach ($comments as $comment) { ?>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">

                                                            <div class="desc">
                                                                <h4><?= $comment->name ?>:</h4>
                                                                <p class="date mt-3"><?= $comment->created_at ?></p>
                                                                <p class="comment">
                                                                    <?= $comment->body ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $message = helper::flash("comment_error");
                            ?>
                            <div class="comment-form">
                                <?= (!empty($message)) ? $message : "" ?>
                                <h4>درج نظر جدید</h4>
                                <form method="POST" action="<?= helper::url("post/add_comment/$post->id") ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                            <textarea class="form-control mb-10" rows="4" name="body"
                                                      placeholder="متن نظر" onfocus="this.placeholder = ''"
                                                      onblur="this.placeholder = 'متن نظر'" required=""></textarea>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-control mb-3" type="email" name="email" id=""
                                                       placeholder="ایمیل">
                                                <input class="form-control mb-3" type="text" name="name" id=""
                                                       placeholder="نام">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <span class="mt-2 ml-5"> لطفا عدد مقابل را در کادر روبرو وارد کنید </span>
                                                <img class="mr-4" src="<?= helper::url("captcha") ?>" alt="" width="120"
                                                     height="40">
                                            </div>
                                            <div class="col-4">
                                                <input class="form-control" type="text" name="captcha" id="">
                                                <input type="submit" class="primary-btn text-uppercase mt-4"
                                                       value="ارسال">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End single-post Area -->
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