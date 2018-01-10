<?php
/* Including the connection script. */
session_start();
include 'connection.php'; 
if(isset($_POST['btn-upload'])){    
     
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$details= $_POST ['details'];
	$id= $_POST ['txtid'];
	$folder="uploads/";
	


	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// making file name in lower case
	$new_file_name = strtolower($file);
	// making file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	include 'connection.php'; 
				$sql="SELECT * FROM Property where IdNum = '$id' ";
				$result_set=sqlsrv_query($conn,$sql);
        		$row=sqlsrv_fetch_array($result_set);
        		$Fname = $row['Fname'];
        		$Lname=$row['Lname'];
        		$Fullname=$row['Fullname'];
        		$Address=$row['Address'];
        		$Email=$row['Email'];
        		$Mobile=$row['Mobile'];
        		$Nationality=$row['Nationality'];
        		$Propertyid=$row['Propertyid'];
        		$Title=$row['Title'];
				if(move_uploaded_file($file_loc,$folder.$final_file)){
					$sql="INSERT INTO tbl_uploads(fileup,type,size,Details,identification,Fname,Lname,Fullname,Address,Email,Mobile,Nationality,Propertyid,Title) VALUES('$final_file','$file_type','$new_size', '$details','$id','$Fname','$Lname','$Fullname','$Address','$Email','$Mobile','Nationality','$Propertyid','$Title')";
					$tsql="UPDATE Property SET fileup = '$final_file', type ='$file_type', fsize ='$new_size' WHERE IdNum = '".($_SESSION['mm'])."' ";
					sqlsrv_query($conn,$tsql);
					sqlsrv_query($conn,$sql);
					?>
<script>
		alert('successfully uploaded');
        window.location.href='files.php';
</script>
		<?php
	}
else{
		?>
		<script>
			alert('error while uploading file');
        	window.location.href='fileupload.php?fail';
        </script>
		<?php
	}
}
?>
