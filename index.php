
<?php 

    require 'header.php';
    require 'connection.php';
    if(isset($_POST['emp_id']) && isset ($_POST['emp_name'] )&& isset($_POST['email'])){
        $empid=$_POST['emp_id'];
        $empname=$_POST['emp_name'];
        $empemail=$_POST['email'];
        
        $stmt = $connection->prepare( "SELECT 1 FROM `emp_data` WHERE `email` = ? ");
        $stmt->execute([$empemail]);
        $user= $stmt->fetch();
        $stmt = $connection->prepare( "SELECT 1 FROM `emp_data` WHERE `emp_id` = ? ");
        $stmt->execute([$empid]);
        $checkid= $stmt->fetch();   
        if( $user ) {
          echo '<script>alert("Email already Exist")</script>';
          }
          else if($checkid){
            echo '<script>alert("Employee id already Exist")</script>';
          }
           else {
        $sql='INSERT INTO emp_data(emp_id,emp_name,email)VALUES(:eid,:name,:email)';
        $statement=$connection->prepare($sql);
        if($statement->execute([':eid'=>$empid,':name'=>$empname,':email'=>$empemail]))
        {
            echo "Inserted Successfully";
        }
      }
      }    
    
    // Display Data From table
    $sql="SELECT * FROM emp_data"; 
    $statement=$connection->prepare($sql); 
    $statement->execute();
    $employee=$statement->fetchAll(PDO::FETCH_OBJ);  
?>
<div class="container  mt-5 p-3  ">
    <form action="" method="POST">
        <div class="row justify-content-center ">
            <div class="col-sm-6 border bg-info p-5">
                <h2 class="text-center">Employee Details</h2>
                <div class=" my-3">
                    <label for="emp_id" class="form-label">Enter Employee Id</label>
                    <input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="Employee id" required>
                </div>
                <div class=" mb-3">
                    <label for="emp_name" class="form-label">Enter Employee Name</label>
                    <input type="text" class="form-control" name="emp_name" id="emp_name" placeholder="Employee Name" required>
                </div>
                <div class=" mb-3">
                    <label for="email" class="form-label">Enter Email Id</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" required>
                </div>
                <div class=" mb-3">
                    <button type="submit"  class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
    
    <div class="row justify-content-center pt-4">
        <div class="col-sm-12">  
            <table class="table table-hover border">           
                <thead>           
                    <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($employee as $emp): ?>
                    <tr>
                        <td><?= $emp ->emp_id;?></td>
                        <td><?= $emp->emp_name;?></td>
                        <td><?= $emp ->email;?></td>
                        <td>
                            <a href="edit.php?id=<?=$emp->id?>" class="btn btn-success" name="edit"
                             value="" >Edit  </a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?=$emp->id?>" class="btn btn-danger" name="delete"
                             value="" onclick="confirm('Do you want to delete?')">Delete  </a>

                            
                        </td>
                    </tr>   
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
    require 'footer.php';
?>