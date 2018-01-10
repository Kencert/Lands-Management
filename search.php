<?php 
 session_start();
include 'connection.php'; 
 if (!isset($_SESSION['ID'])){
  echo "<script>alert('Please login first!')</script>";
  echo"<script>window.open('index.php','_self')</script>";
  }
  $expire_time = 5*60; //expire time
  if( $_SESSION['activity'] < time()-$expire_time ) {
    echo "<script> alert('Session expired')</script>";
    echo "<script>window.open ('logout.php','_self')</script>";
    
    die();
}
else {
    $_SESSION['activity'] = time(); // you have to add this line when logged in also;
    
}


 ?>
<header class = "main-header">
<?php
include 'menu.php'; 
?> 
</header>
<form method="post" action="" name="form" id="form">   
   <link rel="stylesheet" type="text/css" href="style.css" media="screen"  />

<br />
 <input type="text" autofocus="autofocus" name="search_file" required = "text" placeholder ="Search" id="search_file" style="width:500px; font-size:20px; margin-top: 70px;" class="textboxclass" /> 
				<input type="submit"  class="btn btn-primary" name="submit" value="Search">
			</br>
			<td>Reason For Search:</td>
			<select name = "reason" required><option value=""></option><option value="Looking to Lease">Looking to lease</option><option value="Looking to Acquire">Looking to Acquire</option><option value="Dispute Settling">Dispute Settling</option></select>

</form>
<body style="background-image: url('download.jpg'); min-height: 100vh;  background-position: center center;  background-size: cover;  position: relative;">
<div class="container" style="margin-top: 10px; width: 75%; background-color: #d2f3f3;">
<div class="alert alert-success"><center> <h4>Record Results </h4></center> </div> 
	<table >
		<thead>
			<tr>
				<th >No.</th>
				<th >Owner Full Names</th>
				<th >Property Title</th>
				<th >Block No.</th>
				<th >Size</th>
			</tr>
		</thead>
 
		<tbody>	
			<?php
			include 'connection.php'; 

			error_reporting(0);
			
			if ($_REQUEST['submit']) {
				if( $conn == false ) {
   					 echo "<script> alert ('Connection Error!.')</script>";
					}
			     $reason = $_POST['reason'];
			     $id = $_SESSION['ID'];
			     $search_file = $_POST['search_file'];
			     $save =sqlsrv_query($conn1 , " insert into [Search] (Searchfile,Reason,Userid) values('$search_file','$reason','$id')");
			     $select=sqlsrv_query( $conn, "SELECT * FROM Property Where Fname like '%".$search_file."%' or Lname like '%".$search_file."%' or Fullname like '%".$search_file."%' or Email like '%".$search_file."%'  or IdNum like '%$search_file%' Order by IdNum ");
			     $i = 0;
			   if( $select == false ){  
			 	   echo "<script> alert ('Query Error!.')</script>";
			       }
			     while($row=sqlsrv_fetch_array($select))  {
  		  			 $i++;
  			       echo '<tr>';
			         echo '<td class="text-center">' . $i . '</td>';
			         echo '<td class="text-center">' . $row['Fullname'] . '</td>';
			         echo '<td class="text-center">' . $row['Title'] . '</td>';
			         echo '<td class="text-center">' . $row['Block'] . '</td>';
			         echo '<td class="text-center">' . $row['Email'] . '</td>';
			         echo "</tr>";
			           }
		
			
			if (empty($search_file)) {
			   echo '<script language="javascript">';
			   echo 'alert("Text field cannot be empty. Please Try it again.")';
			   echo '</script>';
			   header( "refresh:2; url=search.php" ); 
			       }			 
			   }
			
			?>       
		</tbody>
	</table>

</div>
<?php
include 'footer.php';
?>