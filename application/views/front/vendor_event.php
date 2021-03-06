<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>Popular Event</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="karl-projects-menu mb-100">
        <div class="text-center portfolio-menu">
            <div class="row justify-content-center">
                <div class="col-sm-8 ">
                    <form method="post" action="<?= base_url('front/vendorevent/' . $vendor) ?>">
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <select class="form-control" id="vendor" name="vendor">
                                        <?php if ($vendor) { ?>
                                            <option value="0"><?= $vendor_list_select['name'] ?></option>
                                        <?php } else { ?>
                                            <option value="0">Select Vendor</option>
                                        <?php } ?>
                                        <?php foreach ($vendor_list as $v) : ?>
                                            <?php if ($v['id'] > 1) : ?>
                                                <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_start">Date Start</label>
                                    <input type="date" class="form-control" id="date_start" name="date_start" value="<?= $date_start ?>">
                                    <?= form_error('date_start', '<small class="text-danger pl-3">', '</small>'); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_end">Date End</label>
                                    <input type="date" class="form-control" id="date_end" name="date_end" value="<?= $date_end ?>">
                                    <?= form_error('date_end', '<small class="text-danger pl-3">', '</small>'); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-4">
                                    <button class="btn btn-info" name="submit" type="submit">Search</button>
                                    <a class="btn btn-secondary" href="<?= base_url('front/resetlisting') ?>">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row karl-new-arrivals">

            <?php foreach ($event as $e) : ?>
                <?php $temp = 0; ?>
                <!-- Single gallery Item Start -->
                <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s">
                    <!-- Product Image -->
                    <div class="product-img">
                        <img src="<?= base_url('assets/img/event/thumbnail/') . $e['image'] ?>" alt="">
                        <div class="product-quicview">
                            <a href="<?= base_url('front/detailevent/') . $e['id'] ?>"><i class="ti-fullscreen"></i></a>
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="product-description">
                        <h4 class="product-price"><?= $e['name'] ?></h4>

                        <p> <strong><?= $e['user_name'] ?></strong></p>
                        <p> <strong>Date : </strong> <?= date('d F Y', strtotime($e['date_start'])) . " - " .  date('d F Y', strtotime($e['date_start']))  ?></p>
                        <p> <strong>Venue : </strong> <?= $e['venue'] ?></p>
                        <p> <strong>HTM : </strong> Rp. <?= number_format($e['htm']) ?></p>
                        <?php foreach ($usersubscribe as $us) : ?>
                            <?php if ($us['event_id'] == $e['id']) { ?>
                                <form class="cart clearfix mb-50 d-flex" method="post" action="<?= base_url('front/unsubscribe/') . $us['event_id'] . "/" .  $e['user_id'] ?>">
                                    <button type="submit" name="addtocart" value="5" class="btn cart-submit mt-3">Unsubscribe Event</button>
                                </form>
                                <?php $temp = 1; ?>
                            <?php } ?>
                        <?php endforeach; ?>
                        <?php if ($temp != 1) { ?>
                            <form class="cart clearfix mb-50 d-flex" method="post" action="<?= base_url('front/usersubscribe/') . $e['user_id'] . "/" . $e['id'] ?>">
                                <button type="submit" name="addtocart" value="5" class="btn cart-submit btn btn-danger mt-3">Subscribe Event</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mb-3">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</section>
<!-- ****** New Arrivals Area End ****** -->