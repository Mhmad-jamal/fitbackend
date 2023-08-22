<?php require'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $.fn.dataTable.ext.errMode = 'throw';
    $('#table_id').dataTable({
     "bProcessing": true,
     "sAjaxSource": "../controller/get_all_subscritption.php",
     "responsive": true,
     "bPaginate":true,
     "aaSorting": [[5,'desc']],
     "sPaginationType":"full_numbers",
     "iDisplayLength": 10,
     "aoColumns": [
    { mData: 'id', "width": "5%"},
    { mData: 'name', "width": "5%"},
    { mData: 'start_date', "width": "5%"},
    { mData: 'end_date', "width": "5%"},
    { mData: 'price', "width": "5%"},
    { mData: 'created_at', "width": "5%"},

    
    
    { "mData": null,
    "width": "8%",
    "className": "text-center",
    'orderable': false,
    'searchable': false,
    "mRender" : function (data) {

      buttons = "<a class='btn btn-small btn-primary' href='../controller/edit_subscription.php?id="+data.id+"'>Edit</a> <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_subscription.php?id="+data.id+"'>Delete</a>";
      
      

      return buttons;
      }
      
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
                            <h5>Subscription</h5>
                        </div>
                    </div>

<div class="col-12">
                        <div class="block table-block mb-4" style="margin-top: 20px;">

                            <div class="row">
                                <div class="table-responsive">
<table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
    <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Price </th>
                <th>Created At </th>

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
