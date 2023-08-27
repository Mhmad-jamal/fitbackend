<?php require 'sidebar.php'; ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table_id').dataTable({
      "bProcessing": true,
      "sAjaxSource": "../controller/get_supports.php",
      "responsive": true,
      "bPaginate": true,
      "aaSorting": [
        [1, 'desc']
      ],
      "sPaginationType": "full_numbers",
      "iDisplayLength": 10,
      "aoColumns": [{
          mData: 'id',
          "width": "5%",
          "className": "text-center"
        },
        {
          mData: 'user',
          "width": "10%",
          "className": "text-center"
        },
        {
          mData: 'message',
          "width": "25%",
          "className": "text-center"
        },
        {
          mData: 'response',
          "width": "25%",
          "className": "text-center",
          render: function(data, type, row) {
            return data !== '' ? data : '<small> No response yet </small>';
          }
        },
        {
          mData: 'date_time',
          "width": "15%",
          "className": "text-center"
        },

        {
          "mData": null,
          "width": "9%",
          "className": "text-center",
          'orderable': false,
          'searchable': false,
          "mRender": function(data) {
            return "<a class='btn btn-small btn-success'  data-toggle='modal' data-target='#responseModal' onclick='setResponseModal(" + data.id + ")'>Response</a> ";
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
              <h5>Supports</h5>
            </div>
          </div>

          <div class="col-12">
            <div class="block table-block mb-4" style="margin-top: 20px;">

              <div class="row">
                <div class="table-responsive">

           

                  <!-- Modal -->
                  <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header" style="justify-content: space-between;">
                          <h5 class="modal-title" id="responseModalLabel">Send response</h5>
                          <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body">
                        <form action="../controller/add_support_response.php" method="post" ><div class="form-group col-md-12">
                            <div class="block col-md-12" style="padding-bottom: 35px">

                              <label class="control-label">Response:</label>
                              <input type="hidden" name="support_id" id="support_id">
                              <textarea  placeholder="Enter Response" name="response" id="response" class="form-control" required></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Send</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>



                  <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%" style="border-radius: 5px;">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>user</th>
                        <th>Message</th>
                        <th>Response</th>
                        <th>Date</th>
                        <th></th>

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




<script>


  function setResponseModal(id){

    $("#response").val('');
    $("#support_id").val(id);

  }
</script>