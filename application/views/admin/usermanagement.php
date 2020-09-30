<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="<?= base_url('admin/usermanagement') ?>">
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Keyword</label>
                            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Active Account</label>
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

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Account Type</label>
                            <select class="form-control" id="role" name="role">
                                <?php if ($this->session->userdata('role') == '2') { ?>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Member">Member</option>
                                <?php } elseif ($this->session->userdata('role') == '3') { ?>
                                    <option value="Member">Member</option>
                                    <option value="Vendor">Vendor</option>
                                <?php } ?>

                                <?php if ($this->session->userdata('role') == NULL) { ?>
                                    <option value="All">All</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Member">Member</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 search_button">
                        <div class="form-group mt-4">
                            <button class="btn btn-info" name="submit" type="submit">Search</button>
                            <a class="btn btn-secondary" href="<?= base_url('admin/resetlisting') ?>">Reset</a>
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

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Member Since</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($user_all)) : ?>
                        <tr>
                            <div class="alert alert-warning" role="alert">
                                Data not found.
                            </div>
                        </tr>
                    <?php endif; ?>
                    <?php $i = $start; ?>
                    <?php foreach ($user_all as $u) : ?>
                        <?php if ($u['role_id'] != 1) { ?>
                            <?php if ($u['role_id'] == 2) { ?>
                                <tr class="table-primary">
                                <?php } else { ?>
                                <tr>
                                <?php } ?>
                                <th scope="row"><?= ++$i; ?></th>
                                <td>
                                    <a href="<?= base_url('admin/detailuser/') . $u['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= $u['name'] ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/detailuser/') . $u['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= $u['email'] ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/detailuser/') . $u['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= $u['address'] ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/detailuser/') . $u['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?= date('d M Y', $u['date_created']) ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/detailuser/') . $u['id'] ?>" style="text-decoration:none; color:#706f6f">
                                        <div style="height:100%;width:100%;">
                                            <?php if ($u['is_active'] == 1) { ?>
                                                <a class="badge badge-success text-wrap" href="<?= base_url('admin/set_active/') . $u['id'] ?>">Active</a>
                                            <?php } else { ?>
                                                <a class="badge badge-warning text-wrap" href="<?= base_url('admin/set_active/') . $u['id'] ?>">Not Active</a>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/dropuser/') . $u['id'] ?>" class="badge badge-danger">Delete</a>
                                </td>
                                </tr>
                            <?php } ?>
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