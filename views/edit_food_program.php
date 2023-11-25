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
                    <h5 class="text-truncate">Edit Food Program</h5>
                </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-block mb-4">

<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >

<input type="hidden" value="<?php echo $_GET["id"];?>" name="program_id">

<div class="form-row">
  <div class="form-group col-md-12">
    <div class="block col-md-12" style="padding-bottom: 35px">

  <label class="control-label">Name</label>
   <input type="text" value="<?php echo  $program_data["name"]?>" placeholder="Title" name="name" class="form-control" required>

  <!--  <label class="control-label">Description</label>
   <textarea type="text" value="" placeholder="Description" maxlength="350" rows="4" id="description" class="advancedtinymce form-control" name="workout_description" requiredd></textarea>
 -->
   <label class="control-label">Category</label>
   <select class="form-control" name="category_id" required>
    <?php foreach ($category_list as $category): ?>
        <option value="<?php echo $category['category_id']; ?>" <?php echo ($category['category_id'] == $program_data["category_id"]) ? 'selected' : ''; ?>>
            <?php echo $category['category_title']; ?>
        </option>
    <?php endforeach; ?>
</select>
<?php 
 function getCoursesValue($id) {
  $courses = array(
      1 => "breakfast",
      2 => "snack 1",
      3 => "lunch",
      4 => "snack 2",
      5 => "dinner"
  );

  // Check if the ID exists in the array
  if (array_key_exists($id, $courses)) {
      // Return the corresponding value
      return $courses[$id];
  } else {
      // If the ID is not found, you can return a default value or handle it as needed
      return "Course not found";
  }
}
 ?>
  

   <label class="control-label">Day 1</label>
   <input type="hidden" value="1" name="day_1">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day1[]">
    <?php foreach ($food_list1 as $food1): 
        
        $selected = in_array($food1['diet_id'], $day1_values) ? 'selected' : '';
        ?>
        <option data-calories="<?php echo $food1['diet_calories']; ?>"
                data-fat="<?php echo $food1['diet_fat']; ?>"
                data-protein="<?php echo $food1['diet_protein']; ?>"
                data-carbs="<?php echo $food1['diet_carbs']; ?>"
                data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food1['diet_image']; ?>"
                value="<?php echo $food1['diet_id']; ?>" <?php echo $selected; ?>>
                <?php echo $food1['diet_title'] . "    (" . getCoursesValue($food1['course']) . " - " . $food1['diet_calories'] . ')'; ?>
        </option>
    <?php endforeach; ?>
</select>

      <label class="control-label">Day 2</label>
      <input type="hidden" value="2" name="day_2">
     
   <select multiple="multiple" class="my-select form-control diet-select"  name="day2[]">
    <?php foreach($food_list2 as $food2): ?>
        <?php
        $selected = in_array($food2['diet_id'], $day2_values) ? 'selected' : '';
        ?>
   <option  data-calories="<?php echo $food2['diet_calories']; ?>"
    data-fat="<?php echo $food2['diet_fat']; ?>" data-protein="<?php echo $food2['diet_protein']; ?>"
     data-carbs="<?php echo $food2['diet_carbs']; ?>" 
      data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food2['diet_image']; ?>" 
      value="<?php echo $food2['diet_id']; ?> " <?php echo $selected; ?>>
      
      <?php echo $food2['diet_title'] . "    (" . getCoursesValue($food2['course']) . " - " . $food2['diet_calories'] . ')'; ?>
    </option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 3</label>
     <input type="hidden" value="3" name="day_3">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day3[]">
    <?php foreach($food_list3 as $food3): ?>
        <?php
        $selected = in_array($food3['diet_id'], $day3_values) ? 'selected' : '';
        ?>
   <option <?php echo $selected; ?>  data-calories="<?php echo $food3['diet_calories']; ?>" 
   data-fat="<?php echo $food3['diet_fat']; ?>" data-protein="<?php echo $food3['diet_protein']; ?>"
    data-carbs="<?php echo $food3['diet_carbs']; ?>"  data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food3['diet_image']; ?>" 
    value="<?php echo $food3['diet_id']; ?>">
    <?php echo $food3['diet_title'] . "    (" . getCoursesValue($food3['course']) . " - " . $food3['diet_calories'] . ')'; ?>
</option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 4</label>
     <input type="hidden" value="4" name="day_4">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day4[]">
 
    <?php foreach($food_list4 as $food4): ?>
        <?php
        $selected = in_array($food4['diet_id'], $day4_values) ? 'selected' : '';
        ?>
   <option <?php echo $selected; ?>
     data-calories="<?php echo $food4['diet_calories']; ?>" data-fat="<?php echo $food4['diet_fat']; ?>"
      data-protein="<?php echo $food4['diet_protein']; ?>" data-carbs="<?php echo $food4['diet_carbs']; ?>"
      data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food4['diet_image']; ?>" value="<?php echo $food4['diet_id']; ?>">
      <?php echo $food4['diet_title'] . "    (" . getCoursesValue($food4['course']) . " - " . $food4['diet_calories'] . ')'; ?>
    </option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 5</label>
     <input type="hidden" value="5" name="day_5">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day5[]">
    <?php foreach($food_list5 as $food5): ?>
        <?php
        $selected = in_array($food5['diet_id'], $day5_values) ? 'selected' : '';
        ?>
   <option <?php echo $selected; ?>   
   data-calories="<?php echo $food5['diet_calories']; ?>" 
   data-fat="<?php echo $food5['diet_fat']; ?>" data-protein="<?php echo $food5['diet_protein']; ?>"
    data-carbs="<?php echo $food5['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food5['diet_image']; ?>"
    value="<?php echo $food5['diet_id']; ?>">  <?php echo $food5['diet_title'] . "    (" . getCoursesValue($food5['course']) . " - " . $food5['diet_calories'] . ')'; ?>
</option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 6</label>
     <input type="hidden" value="6" name="day_6">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day6[]">
    <?php foreach($food_list6 as $food6): ?>
        <?php
        $selected = in_array($food6['diet_id'], $day6_values) ? 'selected' : '';
        ?>
   <option  <?php echo $selected; ?> data-calories="<?php echo $food6['diet_calories']; ?>"
    data-fat="<?php echo $food6['diet_fat']; ?>" data-protein="<?php echo $food6['diet_protein']; ?>" 
    data-carbs="<?php echo $food6['diet_carbs']; ?>" data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food6['diet_image']; ?>"
     value="<?php echo $food6['diet_id']; ?>">  <?php echo $food6['diet_title'] . "    (" . getCoursesValue($food6['course']) . " - " . $food6['diet_calories'] . ')'; ?>
</option>
    <?php endforeach; ?>
   </select>

     <label class="control-label">Day 7</label>
     <input type="hidden" value="7" name="day_7">
   <select multiple="multiple" class="my-select form-control diet-select"  name="day7[]">
    <?php foreach($food_list7 as $food7): ?>
        <?php
        $selected = in_array($food7['diet_id'], $day7_values) ? 'selected' : '';
        ?>
   <option <?php echo $selected; ?> 
    data-calories="<?php echo $food7['diet_calories']; ?>" data-fat="<?php echo $food7['diet_fat']; ?>" 
    data-protein="<?php echo $food7['diet_protein']; ?>" data-carbs="<?php echo $food7['diet_carbs']; ?>"
     data-img-src="<?php echo SITE_URL ?>/images/<?php echo $food7['diet_image']; ?>" 
     value="<?php echo $food7['diet_id']; ?>">  <?php echo $food7['diet_title'] . "    (" . getCoursesValue($food7['course']) . " - " . $food7['diet_calories'] . ')'; ?>
</option>
    <?php endforeach; ?>
   </select>
   <label class="control-label">Allergies or diseases</label>
   <select multiple="multiple" class="my-select form-control diet-select" name="Allergies[]">
    <?php foreach ($Allergies_list as $Allergy): ?>
        <?php
        $selected = in_array($Allergy['id'], $program_allergies) ? 'selected' : '';
        ?>
        <option <?php echo $selected; ?> data-img-src="<?php echo SITE_URL ?>/images/<?php echo $Allergy['image']; ?>" value="<?php echo $Allergy['id']; ?>"><?php echo $Allergy['name']; ?></option>
    <?php endforeach; ?>
</select>

   

   <div class="row">
    <div class="col-md-3">
        <label class="control-label">Program Calories</label>
        <input type="text" class="form-control" value="<?php echo $program_data["calories"]; ?>"  name="calories" id="calories" readonly >
    </div>
    <div class="col-md-3">
        <label class="control-label">Program Carbs</label>
        <input type="text" class="form-control" value="<?php echo $program_data["carbs"]; ?>" name="carbs" id="carbs" readonly >
    </div>
    <div class="col-md-3">
        <label class="control-label">Program Protein</label>
        <input type="text" class="form-control" name="protein" value="<?php echo $program_data["protein"]; ?>" id="protein" readonly >
    </div>
    <div class="col-md-3">
        <label class="control-label">Program Fat</label>
        <input type="text" class="form-control" value="<?php echo $program_data["fat"]; ?>" name="fat" id="fat" readonly >
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

    // Round the sum to two decimal places
    var roundedSum = (sum / 7).toFixed(2);

    // Display the rounded sum in the input field
    $(targetId).val(roundedSum);
}
});

    </script>