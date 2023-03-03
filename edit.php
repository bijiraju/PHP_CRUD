
<?php 
    require 'header.php';
    require 'connection.php';  
    $id=$_GET['id'];

    // Display Data of corresponding id From table
    $sql="SELECT * FROM emp_data WHERE id=:id"; 
    $statement=$connection->prepare($sql); 
    $statement->execute([':id'=>$id]);
    $employee=$statement->fetch(PDO::FETCH_OBJ); 
    // UPADATE
    if(isset($_POST['emp_id']) && isset ($_POST['emp_name'] )&& isset($_POST['email'])){
        $empid=$_POST['emp_id'];
        $empname=$_POST['emp_name'];
        $empemail=$_POST['email'];
        $sql="UPDATE emp_data SET emp_id=:eid,emp_name=:name,email=:em WHERE id=:id"; 
        $stmt = $connection->prepare($sql);
        if($stmt->execute([':eid'=>$empid,':name'=>$empname,':em'=>$empemail,':id'=>$id]))
        {
            echo "Updated ";
            echo '<script>alert("Updated");document.location="index.php"</script>';
            // header("Location:index.php");
            
        }

    }
?>

<div class="container  mt-5 p-3">
    <form action="" method="POST">
        <div class="row justify-content-center ">
            <div class="col-sm-6 border bg-info p-5">
                <h2 class="text-center">Employee Details</h2>
                <div class=" my-3">
                    <label for="emp_id" class="form-label">Enter Employee Id</label>
                    <input type="text" class="form-control" name="emp_id" value="<?= $employee ->emp_id;?>" required>
                </div>
                <div class=" mb-3">
                    <label for="emp_name" class="form-label">Enter Employee Name</label>
                    <input type="text" class="form-control" name="emp_name" value="<?= $employee ->emp_name;?>"required>
                </div>
                <div class=" mb-3">
                    <label for="email" class="form-label">Enter Email Id</label>
                    <input type="email" class="form-control" name="email" value="<?= $employee ->email;?>" required>
                </div>
                <div class=" mb-3">
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
            </div>
            
        </div>
    </form>
    
  
</div>
<?php 
    require 'footer.php';
?>