<form id="second-form">
    <div class="row">
        <div class="col">
            <a href="#" class="float-right">All members (<?= $countUser['total'] ?>)</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" maxlength="50" class="form-control" name="company">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" maxlength="50" class="form-control" name="position">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" accept="image/x-png,image/jpeg">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="about_me">About me</label>
                <textarea class="form-control" maxlength="255" name="about_me" rows="6"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success float-right">Finish</button>
        </div>
    </div>
</form>
