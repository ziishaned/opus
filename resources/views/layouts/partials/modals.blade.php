<div class="modal fade" id="profile-pic-cropper" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Crop your profile picture</h4>
            </div>
            <div class="modal-body" style="padding-left: 0px; padding-right: 0px;">
                <form action="#" method="POST" role="form" id="crop-image-form">
                    <div class="center-block">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-3">
                                <img src="" id="cropimage">
                                <input type="text" name="profile_image" id="profile-image-name" value="" class="hide">
                                <input type="text" name="x" id="x" class="hide">
                                <input type="text" name="y" id="y" class="hide">
                                <input type="text" name="w" id="w" class="hide">
                                <input type="text" name="h" id="h" class="hide">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding-bottom: 0px; margin-top: 15px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update-image-size">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="update-category-modal" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update category</h4>
            </div>
            <div class="modal-body" style="padding-left: 0px; padding-right: 0px;">
                <form action="#" method="POST" role="form" id="update-category-form">
                    <div class="plr15">
                        <input type="hidden" name="_method" value="patch">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="category_name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="outline">Outline</label>
                            <textarea name="description" id="update-outline" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding-bottom: 0px; margin-top: 25px;">
                        <button class="btn btn-default pull-left" id="update-close-category" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success pull-right" id="update-edit-category">Update</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create-category-modal" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create category</h4>
            </div>
            <div class="modal-body" style="padding-left: 0px; padding-right: 0px;">
                <form action="{{ isset($organization) ? route('organizations.categories.store', [$organization->slug]) : '' }}" method="POST" role="form" id="update-category-form">
                    <div class="plr15">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="category_name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="outline">Outline</label>
                            <textarea name="description" id="outline" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding-bottom: 0px; margin-top: 25px;">
                        <button class="btn btn-default pull-left" id="update-close-category" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary pull-right" id="update-edit-category">Create</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>