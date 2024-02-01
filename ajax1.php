<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  

    <title></title>
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION</h1>
        <div class="d-flex justify-content-end">
             <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Add Records</button>
        </div>
        <div>
            <h2 class="text-danger">All Records</h2>
            <div id="records_contant"></div>
        </div>
        <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <label>Firstname:</label>
            <input type="text"  id="firstname" class="form-control" placeholder="First Name">

        </div>
        <div class="form-group">
            <label>Lastname:</label>
            <input type="text"  id="lastname" class="form-control" placeholder="Last Name">

        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email"  id="email" class="form-control" placeholder="Email">

        </div>
        <div class="form-group">
            <label>Mobile:</label>
            <input type="text"  id="mobile" class="form-control" placeholder="Mobile Number">

        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- /////update modal -->
<!-- The Modal -->
<div class="modal" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <label for="upd_firstname">upd_Firstname:</label>
            <input type="text"  id="upd_firstname" class="form-control" >

        </div>
        <div class="form-group">
            <label for="upd_lastname">upd_Lastname:</label>
            <input type="text"  id="upd_lastname" class="form-control" >

        </div>
        <div class="form-group">
            <label for="upd_email">upd_Email:</label>
            <input type="email"  id="upd_email" class="form-control" >

        </div>
        <div class="form-group">
            <label for="upd_mobile">upd_Mobile:</label>
            <input type="text"  id="upd_mobile" class="form-control" >

        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="updateuserdetail()">update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
  </div>
</div>
        
        
         
    </div>
        
                 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        readRecords();
    });
    

        function readRecords(){
        var readrecord = "readrecord";
        $.ajax({
            url : "backend1.php",
            type : "post",
            data : { readrecord: readrecord },
            success: function (data, status){
                $('#records_contant').html(data);
            }
        });
    }
    

    function addRecord(){
        var firstname =$('#firstname').val();
        var lastname =$('#lastname').val();
        var email =$('#email').val();
        var mobile =$('#mobile').val();

        if(!firstname || !lastname || !email || !mobile){
            alert("All fieds are required!");
        }
        if (isNaN(mobile) || mobile.length !== 10) {
        alert('Invalid mobile number');
        
        }
        
       
        else{
            $.ajax({
                url:"backend1.php",
                type:'post',
                data:{firstname:firstname,
                    lastname:lastname,
                    email:email,
                    mobile:mobile
                },
                success:function(data,status){
                    
                    readRecords();

                },   
            });
        }
        }

    function DeleteUser(deleteid){
        var conf =confirm("Are you sure");
        if(conf==true){
            $.ajax({
                url:"backend1.php",
                type:"post",
                data:{deleteid:deleteid},
                success:function(data,status){
                    readRecords();
                }

            });
        }

    }


    function GetUserDetails(id){
        $('#hidden_user_id').val(id);


        $.post("backend1.php", {
                id:id
        },function(data,status){
            var user=JSON.parse(data);
            $('#upd_firstname').val(user.firstname);
            $('#upd_lastname').val(user.lastname);
            $('#upd_email').val(user.email);
            $('#upd_mobile').val(user.mobile);
        }
        );
        $('#update_user_modal').modal("show");
    }



    function updateuserdetail(){
        var firstnameupd =$('#upd_firstname').val();
        var lastnameupd =$('#upd_lastname').val();
        var emailupd =$('#upd_email').val();
        var mobileupd =$('#upd_mobile').val();

        var hidden_user_idupd =$('#hidden_user_id').val();


        $.post("backend1.php",{
            hidden_user_idupd:hidden_user_idupd,
            firstnameupd:firstnameupd,
            lastnameupd:lastnameupd,
            emailupd:emailupd,
            mobileupd:mobileupd,
        },
        function(data,status){
            $('#update_user_modal').modal("hide");
            readRecords();

        }
            );

    }





</script>
</body>
</html>