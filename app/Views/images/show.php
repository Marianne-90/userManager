<div class="row d-flex align-items-center justify-content-center mt-4">
    <!-- Gallery item -->
    <div class="col-xl-5 col-lg-6 col-md-6 mb-4">
        <div class="bg-white rounded shadow-sm"><img src=<?php echo base_url('images/' . $user['user_login'] . '/' . $image['image_dir']); ?> alt=<?php echo $image['image_name'];?> class="img-fluid card-img-top">
            <div class="p-4">
                <h5 class="text-dark"><?php echo $image['image_name'];?></h5>
                <div class="d-flex align-items-center justify-content-center">
                    <div class="py-5 text-right"><a href=<?php echo base_url('image/'.$user['user_id']);?> class="btn btn-dark px-5 py-3 text-uppercase">Volver</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End -->

</div>