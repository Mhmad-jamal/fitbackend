<?php require'sidebar.php'; ?>

<!--Page Container--> 
<section class="page-container">
    <div class="page-content-wrapper">

        

        <!--Main Content-->

 <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                                        <div class="block-heading d-flex align-items-center title-pages">
                    <h5 class="text-truncate">New Food Program</h5>
                </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-block mb-4">

<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >


<div class="form-row">
  <div class="form-group col-md-12">
    <div class="block col-md-12" style="padding-bottom: 35px">

  <label class="control-label">Name</label>
   <input type="text" value="" placeholder="Title" name="name" class="form-control" required>

  <!--  <label class="control-label">Description</label>
   <textarea type="text" value="" placeholder="Description" maxlength="350" rows="4" id="description" class="advancedtinymce form-control" name="workout_description" requiredd></textarea>
 -->
   <label class="control-label">Category</label>
   <select class="form-control" name="category_id" required>
    <?php foreach($category_list as $category): ?>
   <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_title']; ?></option>
    <?php endforeach; ?>
   </select> 

  

   <label class="control-label">Day 1</label>
   <input type="hidden" value="1" name="day_1">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day1[]">
    <?php foreach($food_list1 as $food1): ?>
        <option data-calories="<?php echo $food1['diet_calories']; ?>"  data-fat="<?php echo $food1['diet_fat']; ?>" data-protein="<?php echo $food1['diet_protein']; ?>" data-carbs="<?php echo $food1['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food1['diet_image']; ?>" value="<?php echo $food1['diet_id']; ?>"><?php echo $food1['diet_title']; ?></option>
    <?php endforeach; ?>
</select>

      <label class="control-label">Day 2</label>
      <input type="hidden" value="2" name="day_2">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day2[]">
    <?php foreach($food_list2 as $food2): ?>
   <option  data-calories="<?php echo $food2['diet_calories']; ?>" data-fat="<?php echo $food2['diet_fat']; ?>" data-protein="<?php echo $food2['diet_protein']; ?>" data-carbs="<?php echo $food2['diet_carbs']; ?>"  data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food2['diet_image']; ?>" value="<?php echo $food2['diet_id']; ?>"><?php echo $food2['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 3</label>
     <input type="hidden" value="3" name="day_3">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day3[]">
    <?php foreach($food_list3 as $food3): ?>
   <option  data-calories="<?php echo $food3['diet_calories']; ?>" data-fat="<?php echo $food3['diet_fat']; ?>" data-protein="<?php echo $food3['diet_protein']; ?>" data-carbs="<?php echo $food3['diet_carbs']; ?>"  data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food3['diet_image']; ?>" value="<?php echo $food3['diet_id']; ?>"><?php echo $food3['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 4</label>
     <input type="hidden" value="4" name="day_4">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day4[]">
    <?php foreach($food_list4 as $food4): ?>
   <option  data-calories="<?php echo $food4['diet_calories']; ?>" data-fat="<?php echo $food4['diet_fat']; ?>" data-protein="<?php echo $food4['diet_protein']; ?>" data-carbs="<?php echo $food4['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food4['diet_image']; ?>" value="<?php echo $food4['diet_id']; ?>"><?php echo $food4['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 5</label>
     <input type="hidden" value="5" name="day_5">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day5[]">
    <?php foreach($food_list5 as $food5): ?>
   <option   data-calories="<?php echo $food5['diet_calories']; ?>" data-fat="<?php echo $food5['diet_fat']; ?>" data-protein="<?php echo $food5['diet_protein']; ?>" data-carbs="<?php echo $food5['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food5['diet_image']; ?>" value="<?php echo $food5['diet_id']; ?>"><?php echo $food5['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 6</label>
     <input type="hidden" value="6" name="day_6">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day6[]">
    <?php foreach($food_list6 as $food6): ?>
   <option  data-calories="<?php echo $food6['diet_calories']; ?>" data-fat="<?php echo $food6['diet_fat']; ?>" data-protein="<?php echo $food6['diet_protein']; ?>" data-carbs="<?php echo $food6['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food6['diet_image']; ?>" value="<?php echo $food6['diet_id']; ?>"><?php echo $food6['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 7</label>
     <input type="hidden" value="7" name="day_7">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day7[]">
    <?php foreach($food_list7 as $food7): ?>
   <option  data-calories="<?php echo $food7['diet_calories']; ?>" data-fat="<?php echo $food7['diet_fat']; ?>" data-protein="<?php echo $food7['diet_protein']; ?>" data-carbs="<?php echo $food7['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food7['diet_image']; ?>" value="<?php echo $food7['diet_id']; ?>"><?php echo $food7['diet_title']; ?></option>
    <?php endforeach; ?>
   </select>
   <label class="control-label">Allergies or diseases</label>
   <select multiple="multiple" class="my-select form-control diet-select"  name="Allergies[]">
    <?php foreach($Allergies_list as $Allergies): ?>
   <option   data-img-src="<?php echo SITE_URL ?>/images/<?php echo $Allergies['image']; ?>" value="<?php echo $Allergies['id']; ?>"><?php echo $Allergies['name']; ?></option>
    <?php endforeach; ?>
   </select>

   <div class="row">
    <div class="col-md-3">
        <label class="control-label">Program Calories</label>
        <input type="text" class="form-control"  name="calories" id="calories" readonly >
    </div>
    <div class="col-md-3">
        <label class="control-label">Program Carbs</label>
        <input type="text" class="form-control" name="carbs" id="carbs" readonly >
    </div>
    <div class="col-md-3">
        <label class="control-label">Program Protein</label>
        <input type="text" class="form-control" name="protein" id="protein" readonly >
    </div>
    <div class="col-md-3">
        <label class="control-label">Program Fat</label>
        <input type="text" class="form-control" name="fat" id="fat" readonly >
    </div>
</div>



   <!-- <label class="control-label">Image</label>

<div class="new-image" id="image-preview">
  <label for="image-upload" id="image-label">Choose File</label>
  <input type="file" name="workout_image" id="image-upload" requiredd />
</div>

<span class="text-danger recomendedsize">Recommended size: <b>650 x 350</b> </span>

 -->
 <br/>
<br/>
   <div class="action-button">
   <input type="submit" name="save" value="Submit" class="btn btn-embossed btn-primary">
   <input type="reset" name="reset" value="Reset" class="btn btn-embossed btn-danger">
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

<script>
    $(document).ready(function () {
    // Add a common class to all select elements
    $('.diet-select').on('change', function () {
        var selectedCalories = [];
        var selectedcarbs = [];
        var selectedprotein = [];
        var selectedfat = [];

        // Iterate through each selected option in all select elements
        $('.diet-select option:selected').each(function () {
            var calories = parseFloat($(this).data('calories'));
            var carbs = parseFloat($(this).data('carbs'));
            var protein = parseFloat($(this).data('protein'));
            var fat = parseFloat($(this).data('fat'));

            // Check if the values are valid numbers before pushing them
            if (!isNaN(calories)) selectedCalories.push(calories);
            if (!isNaN(carbs)) selectedcarbs.push(carbs);
            if (!isNaN(protein)) selectedprotein.push(protein);
            if (!isNaN(fat)) selectedfat.push(fat);
        });

        // Calculate the sum and display in the input fields
        displaySum(selectedCalories, '#calories');
        displaySum(selectedcarbs, '#carbs');
        displaySum(selectedprotein, '#protein');
        displaySum(selectedfat, '#fat');
    });

    function displaySum(values, targetId) {
        // Calculate the sum of the values array
        var sum = values.reduce(function (a, b) {
            return a + b;
        }, 0);

        // Display the sum in the input field
        $(targetId).val(sum / 7);
    }
});

    </script>