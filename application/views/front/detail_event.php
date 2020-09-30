<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">

    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
    <section class="single_product_details_area">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a class="gallery_img" href="img/product-img/product-9.jpg">
                                        <img class="d-block w-100" src="<?= base_url('assets/img/event/') . $detailevent['image'] ?>" alt="First slide">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="single_product_desc">
                        <?= $this->session->flashdata('message') ?>

                        <?php $temp = 0; ?>
                        <h3 class="price"><?= $detailevent['name'] ?></h3>
                        <p><strong><?= $detailevent['user_name'] ?></strong></p>
                        <p>Date Start : <?= date('d F Y', strtotime($detailevent['date_start'])) ?></p>
                        <p>Date End : <?= date('d F Y', strtotime($detailevent['date_end'])) ?></p>
                        <p>Venue : <?= $detailevent['venue'] ?></p>
                        <p>HTM : Rp. <?= number_format($detailevent['htm']) ?></p>
                        <textarea rows="19" cols="50" class="form-control"> <?= $detailevent['description'] ?></textarea>

                        <?php foreach ($usersubscribe as $us) : ?>
                            <?php if ($us['event_id'] == $detailevent['id']) { ?>
                                <form class="cart clearfix mb-50 mt-3 d-flex" method="post" action="<?= base_url('front/unsubscribe/') . $us['event_id'] . "/" .  $detailevent['user_id'] ?>">
                                    <button type="submit" name="addtocart" value="5" class="btn cart-submitmt-3">Unsubscribe Event</button>
                                </form>
                                <?php $temp = 1; ?>
                            <?php } ?>
                        <?php endforeach; ?>
                        <?php if ($temp != 1) { ?>
                            <form class="cart clearfix mb-50 mt-3 d-flex" method="post" action="<?= base_url('front/usersubscribe/') . $user['id'] . "/" . $detailevent['user_id'] . "/" . $detailevent['id'] ?>">
                                <button type="submit" name="addtocart" value="5" class="btn cart-submit btn btn-danger mt-3">Subscribe Event</button>
                            </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->


</section>
<!-- ****** New Arrivals Area End ****** -->