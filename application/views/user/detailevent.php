<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message') ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-10">
        <div class="row">
            <div class="col-md-5 mt-3">
                <img src="<?= base_url('assets/img/event/thumbnail/') . $event['image'] ?>">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title"><strong><?= $event['name'] ?></strong></h3>
                    <p class="card-text">Date Start : <?= date('d F Y', strtotime($event['date_start'])) ?></p>
                    <p class="card-text">Date End : <?= date('d F Y', strtotime($event['date_end'])) ?></p>
                    <p class="card-text">Venue : <?= $event['venue'] ?></p>
                    <p class="card-text">HTM : Rp. <?= $event['htm'] ?></p>
                    <p class="card-text">Subscription : <?= $event['subscribed'] ?></p>
                    <textarea rows="19" cols="50" class="form-control"><?= $event['description'] ?></textarea>

                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->