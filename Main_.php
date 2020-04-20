

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
     <link rel="stylesheet" href="cs/mainstyle.css">
     
    </head>
    <body>
    <div class="container">
        <div class="title">
            <h1> Address Book</h1>
            <p>Welcome to my address book. You can save your contact's by simply hitting 'Add Contact' button.' You can also search for your desired contact by hitting 'Search Contact' button.</p>
            <p> There are also few other options to manipulate your data such as Update your data by click on 'Update'' link provided. Similarly, remove conatct data by clicking 'Delete link'</p>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
        <table class="table bg-light table-bordered text-center table-striped table-hover">

            <tr><td> Name</td><td>Email</td><td>Phone Number</td><td>Pic</td><td>Update</td><td>Delete</td></tr>
           
      <?php
      
      $sql="select * from  addressbook order by firstName ASC";
      $connection->query($sql);
      $result=$connection->query($sql);
      while($row=$result->fetch_assoc()){
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
      </table>


        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
                <a href="address.php" class="btn btn-block btn-primary">Add Contact</a>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3">
            <a href="search.php" class="btn btn-block btn-secondary">Search Contact</a>
            </div>
            <div class="col-md-2"></div>
            
        </div>
    <script src="js/jquery-3.4.1.min.js"></script>


<script src="js/bootstrap.min.js"></script>
    </body>
</html>