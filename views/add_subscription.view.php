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
   <label class="control-label d-flex ">Subscription Duration</label>
   <select class="form-control" id="subscriptionDuration" name="subscription_duration">
        <option value="1">1 month</option>
        <option value="2">2 months</option>
        <option value="3">3 months</option>
        <option value="4">4 months</option>
        <option value="5">5 months</option>
        <option value="6">6 months</option>
        <option value="7">7 months</option>
        <option value="8">8 months</option>
        <option value="9">9 months</option>
        <option value="10">10 months</option>
        <option value="11">11 months</option>
        <option value="12">12 months</option>
      </select>
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