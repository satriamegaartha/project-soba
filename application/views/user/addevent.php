<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <!-- <form action="" method="" enctype="multipart/form-data"> -->
            <?php echo form_open_multipart('user/addevent') ?>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Event Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_start" class="col-sm-2 col-form-label">Date Start</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_start" name="date_start">
                    <?= form_error('date_start', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_end" class="col-sm-2 col-form-label">Date End</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_end" name="date_end">
                    <?= form_error('date_end', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="venue" class="col-sm-2 col-form-label">Venue</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="venue" name="venue">
                    <?= form_error('venue', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="htm" class="col-sm-2 col-form-label">HTM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="htm" name="htm">
                    <?= form_error('htm', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <textarea rows="10" class="col-sm-10 form-control " id="description" name="description"></textarea>
                <?= form_error('description', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <!-- UPLOAD GAMBAR  ada nyambung ke jquery di footer ******************************************************************************** -->
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END UPLOAD GAMBAR ******************************************************************************** -->
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add New Event</button>
                </div>
            </div>
            </form>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->