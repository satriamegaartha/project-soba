<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>Event Vendor</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row karl-new-arrivals">

            <?php foreach ($vendor as $v) : ?>
                <?php $temp = 0; ?>
                <!-- Single gallery Item Start -->
                <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig mb-5" data-wow-delay="0.2s">
                    <!-- Product Image -->
                    <div class="product-img">
                        <img src="<?= base_url('assets/img/profile/thumbnail/') . $v['image'] ?>" alt="">
                        <div class="product-quicview">
                            <a href="<?= base_url('front/vendorevent/') . $v['id'] ?>"><i class="ti-fullscreen"></i></a>
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="product-description">
                        <h5 class="product-price"><?= $v['name'] ?></h5>
                        <p><?= $v['address'] ?></p>
                        <p><?= $v['email'] ?></p>
                        <p><small class="text-muted">Member since <?= date('d F Y', $v['date_created']) ?></small></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="row mb-3 mt-5 justify-content-center">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</section>
<!-- ****** New Arrivals Area End ****** -->