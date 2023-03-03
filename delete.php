<?php

    require 'connection.php'; 
    // delete tabl
        $bid=$_GET['id'];
        $sql='DELETE FROM emp_data WHERE id=:id';
        $stmt = $connection->prepare($sql);
        if($stmt->execute([':id'=>$bid]))
        {
            echo '<script>alert("Deleted");document.location="index.php"</script>';
            // header("Location:index.php");
        }
    
?>
