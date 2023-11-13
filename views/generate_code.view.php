<?php require 'sidebar.php'; 

?>
<script>
    // Function to generate a random token
    function generateToken(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let token = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            token += characters.charAt(randomIndex);
        }
        return token;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const generateButton = document.getElementById('generateButton');
        const codeInput = document.querySelector('input[name="code"]');

        generateButton.addEventListener('click', function() {
            // Generate a token
            const generatedToken = generateToken(10); // Change 10 to your desired token length

            // Fill the input field with the generated token
            codeInput.value = generatedToken;
        });
    });
</script>

<script type="text/javascript">
    function deleteCode(id) {
        if (confirm("Are you sure you want to delete this code?")) {
            let formdata = new FormData();
            formdata.append('id', id);
            $.ajax({
                url: '../controller/generate_code.php', // Adjust the URL to your delete script
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: formdata,
                success: function(response) {

                    $('#table_id').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
    $(document).ready(function() {

        $.fn.dataTable.ext.errMode = 'throw';
        $('#table_id').dataTable({
            "bProcessing": true,
            "sAjaxSource": "../controller/get_generated_code.php",
            "responsive": true,
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
            "aoColumns": [{
                    mData: 'id',
                    "width": "5%"
                },
                {
                    mData: 'code',
                    "width": "10%"
                },
                {
                    mData: 'subscription_name',
                    "width": "10%"
                },
                {
                    mData: 'date',
                    "width": "10%"
                },
                {
                    mData: 'status',
                    "width": "5%",
                    "className": "status text-center",
                    "render": function(data, type, row) {

                       console.log(data);
                        return data == 0 ? 'Unused' : 'Used';
                    }
                },
                {
                    "width": "5%",
                    "render": function(data, type, row) {
                        buttons = " <a class='btn btn-small btn-danger btn-delete deleteItem' data-url='../controller/delete_code.php?id=" + row.id + "'>Delete</a>";



                        return buttons;
                    }
                }
            ],
            "order": [
                [0, "desc"]
            ], // Sort by the first column (id) in descending order
            "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                oSettings.jqXHR = $.ajax({
                    "dataType": 'json',
                    "type": "GET",
                    "url": sSource,
                    "success": function(data) {
                        fnCallback(data); // Populate DataTable with the retrieved data
                    }
                });
            }
        });
    });
</script>

<!--Page Container-->
<section class="page-container">
    <div class="page-content-wrapper">


        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="content sm-gutter">
                <div class="container-fluid padding-25 sm-padding-10">
                    <div class="row mt-3">

                        <div class="col-md-4">
                            <label class="control-label">Generate Code</label>

                            <input type="text" value="" required placeholder="Code" name="code" class="form-control" required="">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label class="control-label">Subscription</label>
                            <select class="form-control" name="subscription_id" required="">
                                <?php foreach ($subscription_lists as $item) : ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class=" mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" id="generateButton">Generate</button>
                    </div>

                </div>
<?php
if (isset($_SESSION['insert_message']) && !empty($_SESSION['insert_message'])) {
    echo $_SESSION['insert_message'] ;
    unset($_SESSION['insert_message']);
    $_SESSION['insert_message']="<div></div>";

}

?>
            </div>
        </form>
        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h5>Code</h5>
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
                                                <th>Code</th>
                                                <th>Subscription name</th>

                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>

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