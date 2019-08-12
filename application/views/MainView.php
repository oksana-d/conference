<?php require('partials/head.php'); ?>

<div id="map"></div>
<div class="container">
    <div class="card">
        <div class="card-header">
            <p class="font-weight-bold">To participate in the conference, please fill out the form</p>
        </div>
        <div class="card-body">
            <div id="filling-form">
                <?php if (! isset($_COOKIE['idUser'])) : ?>
                    <form id="first-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">First name <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" class="form-control" name="firstname">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Last name <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" class="form-control" name="lastname">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="birthday">Birthday <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="birthday" id="datepicker"
                                           readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country <span class="text-danger">*</span></label>
                                    <select id="country" class="form-control" name="country">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone-number" name="phone">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reportSubject">Report subject <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="250" class="form-control" name="reportSubject">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-right">Next</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
                <?php if (isset($_COOKIE['idUser'])) : ?>
                    <form id="second-form">
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" maxlength="50" class="form-control" name="company">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="text" maxlength="50" class="form-control" name="position">
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" id="photo">
                                    <div id="photo-size-error" class="error" for="photo"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="aboutMe">About me</label>
                                    <textarea class="form-control" maxlength="255" name="aboutMe" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="submit" type="submit" class="btn btn-success float-right">Finish</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require('partials/footer.php'); ?>