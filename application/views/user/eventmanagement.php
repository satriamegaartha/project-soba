<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="<?= base_url('user/eventmanagement') ?>">
                <div class="form-row">
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
                        <div class="form-group">
                            <label>Active Event</label>
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
                    <div class="col-md-3 search_button">
                        <div class="form-group mt-4">
                            <button class="btn btn-info" name="submit" type="submit">Search</button>
                            <a class="btn btn-secondary" href="<?= base_url('user/resetlisting') ?>">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-warning" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message') ?>

            <a href="<?= base_url('user/addevent') ?>" class="btn btn-primary mb-3">Add New Event</a>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date Start</th>
                        <th scope="col">Date End</th>
                        <th scope="col">Venue</th>
                        <th scope="col">HTM (Rp)</th>
                        <th scope="col">Subscription</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($event)) : ?>
                        <tr>
                            <div class="alert alert-warning" role="alert">
                                Data not found.
                            </div>
                        </tr>
                    <?php endif; ?>
                    <?php $i = $start; ?>

                    <?php foreach ($event as $e) : ?>
                        <tr>

                            <th scope="row"><?= ++$i; ?></th>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?= $e['name'] ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?= date('d-m-Y', strtotime($e['date_start'])) ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?= date('d-m-Y', strtotime($e['date_end'])) ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?= $e['venue'] ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?= number_format($e['htm']) ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?= $e['subscribed'] ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('user/detailevent/') . $e['id'] ?>" style="text-decoration:none; color:#706f6f">
                                    <div style="height:100%;width:100%;">
                                        <?php if ($e['is_active'] == 1) { ?>
                                            <div class="badge badge-success text-wrap">Active</div>
                                        <?php } else { ?>
                                            <div class="badge badge-warning text-wrap">Not Active</div>
                                        <?php } ?>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href=" <?= base_url('user/editevent/') . $e['id'] ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= base_url('user/dropevent/') . $e['id'] ?>" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->