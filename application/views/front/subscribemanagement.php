<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area">

    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
    <section>
        <!-- <div class="container"> -->
        <div class="row justify-content-center mt-4">
            <?= $this->session->flashdata('message') ?>
            <div class="col-12 col-md-6 ">
                <form method="post" action="<?= base_url('front/subscribemanagement') ?>">
                    <div class="form-row justify-content-center">
                        <div class="col-md-4 mb-3 mt-4">
                            <div class="form-group">
                                <select class="form-control" id="is_active" name="is_active">
                                    <?php if ($this->session->userdata('is_active') == '1') { ?>
                                        <option value="Active">Active</option>
                                        <option value="Not Active">Not Active</option>
                                    <?php } elseif ($this->session->userdata('is_active') == '0') { ?>
                                        <option value="Not Active">Not Active</option>
                                        <option value="Active">Active</option>
                                    <?php } ?>

                                    <?php if ($this->session->userdata('is_active') == NULL) { ?>
                                        <option value="All">All</option>
                                        <option value="Active">Active</option>
                                        <option value="Not Active">Not Active</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mt-0">
                            <div class="form-group mt-4">
                                <button class="btn btn-info" name="submit" type="submit">Search</button>
                                <a class="btn btn-secondary" href="<?= base_url('front/resetlistingsubs') ?>">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">


                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date Start</th>
                            <th scope="col">Date End</th>
                            <th scope="col">Venue</th>
                            <th scope="col">HTM (Rp)</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($usersubscribe as $us) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= $us['user_name'] ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= $us['name'] ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= date('d F Y', strtotime($us['date_start'])) ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= date('d F Y', strtotime($us['date_end'])) ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= $us['venue'] ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= number_format($us['htm']) ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/detailevent/') . $us['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">

                                            <?php if ($us['is_active'] == 1) { ?>
                                                <div class="badge badge-success text-wrap">Active</div>
                                            <?php } else { ?>
                                                <div class="badge badge-warning text-wrap">Not Active</div>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('front/unsubscribe/') . $us['id'] . "/" .  $us['user_id'] ?>" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- </div> -->
    </section>
    <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->


</section>
<!-- ****** New Arrivals Area End ****** -->