<?php require 'sidebar.php';


?>


 

<!--Page Container-->
<section class="page-container">
    <div class="page-content-wrapper">


    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $subscription["id"]?>" >
    <div class="content sm-gutter">
    <div class="container-fluid padding-25 sm-padding-10">
    <h2  style="text-align: center;">Edit  Subscription </h2>
    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="control-label d-flex ">Name </label>
                            <input type="text" value="<?php echo $subscription["name"]?>" required placeholder="3-Month and Get 1 month Free " name="name" class="form-control" required="">
                        </div>
                    </div>
    <div class="row  mt-3">
    <div class="col-md-4">
     <label class="control-label d-flex ">Subscription duration </label>
                        
    <select class="form-control" id="subscriptionDuration" name="subscription_duration">
    <option <?php echo ($subscription["subscription_duration"] == "1") ? 'selected' : '' ?> value="1">1 month</option>
    <option <?php echo ($subscription["subscription_duration"] == "2") ? 'selected' : '' ?> value="2">2 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "3") ? 'selected' : '' ?> value="3">3 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "4") ? 'selected' : '' ?> value="4">4 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "5") ? 'selected' : '' ?> value="5">5 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "6") ? 'selected' : '' ?> value="6">6 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "7") ? 'selected' : '' ?> value="7">7 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "8") ? 'selected' : '' ?> value="8">8 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "9") ? 'selected' : '' ?> value="9">9 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "10") ? 'selected' : '' ?> value="10">10 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "11") ? 'selected' : '' ?> value="11">11 months</option>
    <option <?php echo ($subscription["subscription_duration"] == "12 ") ? 'selected' : '' ?> value="12">12 months</option>
</select>
</div>
       
    </div>
    
<div class="row  mt-3">
   
   <div class="col-md-4">
   <label class="control-label d-flex ">Price</label>
   <input type="number" value="<?php echo $subscription["price"]?>" required placeholder="Number Only" name="price" class="form-control" required="">
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