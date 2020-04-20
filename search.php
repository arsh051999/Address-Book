

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
    <body style="background-image:url('images/b5.jpg')">
    <div class="container">
        <div class="title">
            <h1> Address Book</h1>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form method="post" action="search.php">
                    <input name="email" type="text" placeholder="Enter the mail to search the contact" class="form-control"> 
                    <br>
                    <br>
                    <button type="submit" name="srch" class="btn btn-primary">Search</button>
                    <br><br>
    </form>
        
      <?php
      if(isset($_POST['srch'])){  ?>
            <table class="table bg-light table-bordered text-center table-striped table-hover">

            <tr><td> Name</td><td>Email</td><td>Phone Number</td><td>Pic</td><td>Update</td><td>Delete</td></tr>
        
        <?php
                $sql="select * from  addressbook where Email='$_POST[email]'";
                $connection->query($sql);
                $result=$connection->query($sql);
                while($row=$result->fetch_assoc())
                {
                    $cid=$row['id'];
                    echo"<tr>";
                        echo"<td>".$row['firstName']." ".$row['lastName']."</td>";
                        
                        echo"<td>".$row['Email']."</td>";
                        echo"<td>".$row['phoneNumber']."</td>";
                        echo"<td><a href='".$row['picture']."' target='_blank'>Image</a></td>";
                        echo"<td><a href='updateaddress.php?up=$cid'>Update</td>";
                        echo"<td><a href='Main_.php?del=$cid'>Delete</a></td>";

                        echo"</tr>";
                    
                
                } 
       echo"</table>";
}
      
      
      ?>
      <?php
      
      
      
      if(isset($_GET['del'])){
        $sql="delete from addressbook where id='$_GET[del]';";
        if($connection->query($sql))
            echo"<script>window.alert('deleted');window.location='Main_.php';</script>";
        else
            echo"<div class='alert alert-danger'>Error In Query".$connection->error."</div>";
    }
    
    
    
      ?>
      </div>
       <div class="col-md-2"></div>
     


        
    <script src="js/jquery-3.4.1.min.js"></script>


<script src="js/bootstrap.min.js"></script>
    </body>
</html>