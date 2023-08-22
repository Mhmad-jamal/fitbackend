<?php require 'sidebar.php'; ?>



<!--Page Container-->
<section class="page-container">
    <div class="page-content-wrapper">


    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <div class="content sm-gutter">
    <div class="container-fluid padding-25 sm-padding-10">
    <h2  style="text-align: center;">Add New  Subscription </h2>
    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="control-label d-flex ">Name </label>
                            <input type="text" value="" required placeholder="3-Month and Get 1 month Free " name="name" class="form-control" required="">
                        </div>
                    </div>
    <div class="row  mt-3">
   
        <div class="col-md-4">
        <label class="control-label d-flex ">Start Date</label>
        <input type="date" value="" required placeholder="date" name="start_date" class="form-control" required="">
    </div>
    </div>
    <div class="row  mt-3">
   
   <div class="col-md-4">
   <label class="control-label d-flex ">End Date</label>
   <input type="date" value="" required placeholder="date" name="end_date" class="form-control" required="">
</div>
</div>
<div class="row  mt-3">
   
   <div class="col-md-4">
   <label class="control-label d-flex ">Price</label>
   <input type="number" value="" required placeholder="Number Only" name="price" class="form-control" required="">
</div>
</div>
    <div class="row  mt-3">
    <div class="col-md-4">

        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </div>


    

</div>

    </div>
    </form>
      
    </div>
</section>