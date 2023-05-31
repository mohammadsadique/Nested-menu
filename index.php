<?php
    require('required_files/db.php');
    require('required_files/memberQuery.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NadSoft Members</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>List of members</h2>
  <div id="showMemberList">
    <?php
        echo getNestedData(0);
    ?>
  </div>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Add Member
  </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Member</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <form id="itemForm">
            <div class="modal-body">
                <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select class="form-control" id="sel1" name="parent_id">
                        <?php echo showSelectOption(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="text" class="form-control" id="usr" name="name">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="saveChanges">Save changes</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '#itemForm .btn-success', function(e) {
        e.preventDefault();
        var sel1Data = $('#sel1').val();
        var usrData = $('#usr').val();
        if(sel1Data && usrData){
            var regex = /^[A-Za-z]+$/;
            if (regex.test(usrData)) {
                $.ajax({
                    url: "required_files/process.php",
                    type: 'POST',
                    data: {name: usrData , parent_id:sel1Data },
                    success: function(res){
                        var result = JSON.parse(res);
                        if(result.success == 'success'){
                            alert('Form submitted successfully!');
                            $("#myModal .close").click();
                            $('#sel1').html(result.selectData);
                            $('#sel1').prop('selectedIndex', 0);
                            $('#usr').val('');
                            $('#showMemberList').html(result.data)
                        }
                    }
                });
            } else {
                // Input value contains other characters (invalid)
                alert('Input is invalid: ' + usrData);
            }
        } else {
            alert('Every fields are required.');
        }
    });
</script>
</body>
</html>

