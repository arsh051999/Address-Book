

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
    <body text-light>
    <div class="container">
        <div class="title">
            <h2> Address Book</h2>
            <?php 
            $sql="select * from addressbook where id='$_GET[up]'";
           $prow=$connection->query($sql);
           $srow=$prow->fetch_assoc()
        
            
            ?>
        </div>
        <h5> Add Contact details</h5>
        <form method="post" action="" enctype="multipart/form-data">
        <label>Upload your contact image</label>
            <input type="file" name="f1" accept=".jpg,.jpeg,.png" />
            <br/>
            
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" class="form-control" value="<?php echo $srow['firstName']; ?>" name="fname">
            <br>
            <label for="lastName">last Name</label>
            <input type="text" id="lastName" class="form-control" value="<?php echo $srow['lastName']; ?>" name="lname">
            <br>
            <label for="email">E-mail</label>
            <input type="mail" id="email" class="form-control" value="<?php echo $srow['Email']; ?>" name="email">
            <br>
            <label for="Phone">Phone Number</label>
            <input type="phone" id="PhoneNumber" class="form-control" value="<?php echo $srow['phoneNumber']; ?>"  name="phone"pattern="[0-9]{10}">
            <br>
        <div>
            <button id="Add" name="update" type="submit" class="btn btn-success">Update Contact</button>
           <br/>
    
        </form>
                <?php 
                    if(isset($_POST['update']))
                    {
                        
                        $dir="images/";
                        $filename=$dir.$_FILES['f1']['name'];
                        $tmpFname=$_FILES['f1']['tmp_name'];
                        $x=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                        if($x=="jpg" or $x=="jpeg" or $x=="png")
                        {
                            if (move_uploaded_file($tmpFname,$filename)) {
                                $sql="UPDATE addressbook set firstName='$_POST[fname]' , lastName='$_POST[lname]',Email='$_POST[email]',phoneNumber='$_POST[phone]',picture='$filename'  where id='$_GET[up]'"; 
                                if($connection->query($sql)){
                                    echo"<script>window.alert('Contact  Updated');window.location='main_.php';</script>";
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