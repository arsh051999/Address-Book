

<!DOCTYPE html>
<html>
    <head>
    <?php 
     $server="localhost";
     $dbUser="root";
     $dbpwd="";
     $dbname="address_book";
     $connection= new mysqli($server,$dbUser,$dbpwd,$dbname);
     if(!$connection){
        die("Not Connected!");
     }


    ?>
   
     <title>Address Book</title>
     <link href="cs/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="cs/style.css">
     
    </head>
    <body style="background-image:url('images/bg2.jpg')">
    <div class="container">
        <div class="title">
            <h2> Address Book</h2>
        </div>
        <h5> Add Contact details</h5>
        <form method="post" action="" enctype="multipart/form-data">
        <label>Upload your contact image</label>
            <input type="file" name="f1" accept=".jpg,.jpeg,.png" />
            <br/>
            
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" class="form-control" name="fname">
            <br>
            <label for="lastName">last Name</label>
            <input type="text" id="lastName" class="form-control" name="lname">
            <br>
            <label for="email">E-mail</label>
            <input type="mail" id="email" class="form-control" name="email">
            <br>
            <label for="Phone">Phone Number</label>
            <input type="phone" id="PhoneNumber" class="form-control" name="phone"pattern="[0-9]{10}">
            <br>
        <div>
            <button id="Add" name="upload" type="submit" class="btn btn-success">Add Contact</button>
           <br/>
    
        </form>
                <?php 
                    if(isset($_POST['upload']))
                    {
                        
                        $dir="images/";
                        $filename=$dir.$_FILES['f1']['name'];
                        $tmpFname=$_FILES['f1']['tmp_name'];
                        $x=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                        if($x=="jpg" or $x=="jpeg" or $x=="png")
                        {
                            if (move_uploaded_file($tmpFname,$filename)) {
                                $sql="INSERT into addressbook(firstName,lastName,Email,phoneNumber,picture) values('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[phone]','$filename');";
                                if($connection->query($sql)){
                                    echo"<script>window.alert('Contact Added');window.location='main_.php';</script>";
                                }
                                else{
                                    echo"<div class='alert alert-danger'>Error in query".$connection->error."</div>";
                                }
                            }
                            else {
                                echo "File Not Uploaded";
                            }
                        }
                        else
                        {
                            echo "only jpg , png and jpeg files can be uploaded.";
                        }

                        
                    } 
                ?> 
        
        
        </div>
    </div>
   
    <script src="js/jquery-3.4.1.min.js"></script>

<script src="js/bootstrap.min.js"></script>
    </body>
</html>