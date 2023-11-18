<?php require'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_food_program.php",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[0, 'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
     { mData: 'id', "width": "1%", "className": "text-center" },
   
    { mData: 'name', "width": "20%"},
    { mData: 'category_name', "width": "8%"},
    { mData: 'calories', "width": "8%" },
    { mData: 'carbs', "width": "8%" },
    { mData: 'protein', "width": "8%" },
    { mData: 'fat', "width": "10%" },
   
    
 
    { "mData": null,
    "width": "13%",
    "className": "text-center",
    'orderable': false,
    'searchable': false,
    "mRender" : function (data) {
      return "<a class='btn btn-small btn-primary' href='../controller/edit_food_program.php?id="+data.id+"'>Edit</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_food_program.php?id="+data.id+"'>Delete</a>";}
    }
    ]
  });
  });
</script>

<!--Page Container--> 
<section class="page-container">
    <div class="page-content-wrapper">

        <!--Main Content-->

 <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h5>Food Program</h5>
                        </div>
                    </div>

<div class="col-12">
                        <div class="block table-block mb-4" style="margin-top: 20px;">

                            <div class="row">
                                <div class="table-responsive">
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
            <tr>
                <th>Id</th>
                
                <th>Name</th>
                <th>Category</th>
                <th>Calories</th>
                <th>Carbs</th>
                <th>Protein</th>
                <th>Fat</th>

                <th>Actions</th>
            </tr>
        </thead>

</table>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
