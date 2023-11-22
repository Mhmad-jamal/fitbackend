<?php require 'sidebar.php'; ?>

<!--Page Container-->
<section class="page-container">
  <div class="page-content-wrapper">



    <!--Main Content-->

    <div class="content sm-gutter">
      <div class="container-fluid padding-25 sm-padding-10">
        <div class="row">
          <div class="col-12">
            <div class="block-heading d-flex align-items-center title-pages">
              <h5 class="text-truncate">Edit food Recipe</h5>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">


                <div class="form-row">
                  <div class="form-group col-md-12">
                    <div class="block col-md-12" style="padding-bottom: 35px">

                      <input type="hidden" value="<?php echo $diet['diet_id']; ?>" name="diet_id">

                      <label class="control-label">Food Name</label>
                      <input type="text" value="<?php echo $diet['diet_title']; ?>" placeholder="Title" name="diet_title" class="form-control" required="">

                     <!--  <label class="control-label">Description</label>
                      <textarea value="" name="diet_description" class="advancedtinymce form-control" id="description" required=""><?php echo $diet['diet_description']; ?></textarea>
 -->
                      <label class="control-label">Ingredients</label>
                      <textarea value="" name="diet_ingredients" class="advancedtinymce form-control" id="ingredients" required=""><?php echo $diet['diet_ingredients']; ?></textarea>

                      <label class="control-label">Directions</label>
                      <textarea value="" name="diet_directions" class="advancedtinymce form-control" id="directions" required=""><?php echo $diet['diet_directions']; ?></textarea>

                    <!--   <label class="control-label">Category</label>
                      <select class="form-control" name="diet_category" required>
                        <option value="<?php echo $diet['diet_category']; ?>" selected><?php echo $diet['category_title']; ?></option>
                        <?php foreach ($categories_lists as $categories_list) : ?>
                          <option value="<?php echo $categories_list['category_id']; ?>"><?php echo $categories_list['category_title']; ?></option>
                        <?php endforeach; ?>
                      </select> -->
                      <label class="control-label">Course</label>

                      <select class="form-control" name="course" required="">
                        <option value="1" <?php if ($diet['course'] == 1) echo 'selected'; ?>>Breakfast</option>
                        <option value="2" <?php if ($diet['course'] == 2) echo 'selected'; ?>>Snack 1</option>
                        <option value="3" <?php if ($diet['course'] == 3) echo 'selected'; ?>>Lunch</option>
                        <option value="4" <?php if ($diet['course'] == 4) echo 'selected'; ?>>Snack 2</option>
                        <option value="5" <?php if ($diet['course'] == 5) echo 'selected'; ?>>Dinner</option>
                      </select>

                    <!--   <label class="control-label">Price</label>

                      <select class="custom-select form-control" name="diet_price">
                        <?php
                        if ($diet['diet_price'] == 'free') {
                          echo '<option value="-">-</option>';
                          echo '<option value="free" selected="selected">Free</option>';
                          echo '<option value="premium">Premium</option>';
                        } else if ($diet['diet_price'] == 'premium') {
                          echo '<option value="-">-</option>';
                          echo '<option value="premium" selected="selected">Premium</option>';
                          echo '<option value="free">Free</option>';
                        } else {
                          echo '<option value="-" selected="selected">-</option>';
                          echo '<option value="free">Free</option>';
                          echo '<option value="premium">Premium</option>';
                        }
                        ?>
                      </select> -->

                      <label class="control-label">Calories</label>
                      <input type="text" value="<?php echo $diet['diet_calories']; ?>" placeholder="Calories" name="diet_calories" class="form-control" required="">

                      <label class="control-label">Carbs</label>
                      <input type="text" value="<?php echo $diet['diet_carbs']; ?>" placeholder="Carbs (Grams)" name="diet_carbs" class="form-control" required="">

                      <label class="control-label">Protein</label>
                      <input type="text" value="<?php echo $diet['diet_protein']; ?>" placeholder="Protein (Grams)" name="diet_protein" class="form-control" required="">

                      <label class="control-label">Fat</label>
                      <input type="text" value="<?php echo $diet['diet_fat']; ?>" placeholder="Fat (Grams)" name="diet_fat" class="form-control" required="">
                      <label class="control-label">Recipe Link</label>
   <input type="text" value="<?php echo $diet["link"]?>" placeholder="https://" name="link" class="form-control" >
                    <!--   <label class="control-label">Servings</label>
                      <input type="text" value="<?php echo $diet['diet_servings']; ?>" placeholder="Servings" name="diet_servings" class="form-control" required="">
 -->
                     <!--  <label class="control-label">Total Time</label>
                      <input type="text" value="<?php echo $diet['diet_time']; ?>" placeholder="Total Time (Minutes)" name="diet_time" class="form-control" required="">
 -->
<!--                       <label class="control-label">Featured</label>
 -->
                       <input type="hidden" value="1" name="diet_featured">
                       <input type="hidden" value="1" name="diet_status">

                       

                     


                     


                     


                      <label>Food  Image</label>

                      <div class="new-image" id="image-preview" style="background: url(../images/<?php echo $diet['diet_image'] ?>);background-size: cover; background-position: center;">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="hidden" value="<?php echo $diet['diet_image']; ?>" name="diet_image_save">
                        <input type="file" name="diet_image" id="image-upload" />
                      </div>

                      <span class="text-danger">Recommended size: <b>650 x 350 Pixels</b> </span>
                      <br>
                      <br>

                      <div class="action-button">
                        <input type="submit" name="update" value="Update" class="btn btn-embossed btn-primary">
                        <a onclick="alertdelete();">
                          <input name="trash" value="Delete" class="btn btn-embossed btn-danger" style="width: 80px;"></a>
                        <script type="text/javascript">
                          function alertdelete() {
                            swal({
                              title: "Are you sure?",
                              text: "You will not be able to recover this item!",
                              type: "warning",
                              cancelButtonClass: "btn-default btn-sm",
                              showCancelButton: true,
                              confirmButtonClass: "btn-danger btn-sm",
                              confirmButtonText: "Yes, delete it!",
                              closeOnConfirm: false
                            }, function() {
                              window.location.href = "<?php echo SITE_URL ?>/controller/delete_diet.php?id=<?php echo $diet['diet_id']; ?>"
                            });
                          }
                        </script>
                      </div>

                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>