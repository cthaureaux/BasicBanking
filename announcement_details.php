<?php 
include('db_connection.php');
include('LoginCheck.php');
	
if(isset($_POST["submit"])){
	$announcement = [
		"id" => $_POST["announcementID"],
		"title" => $_POST["title"],
		"desc" => $_POST["description"],
		"date" => $_POST["datePosted"]
	];
}

$data = [];

$sql = "SELECT * FROM announcements WHERE announcementID = {$_GET["id"]}";

$res = $db->query($sql);

if($res->num_rows > 0){
	$data = $res->fetch_assoc();
}
?>
<html>
	<head>
        <title>Your Announcements</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<style>
		    .container-transform {
                transition: all 0.6s ease;
            }
            .container-transform:hover{
                transform: scale(1.1);
            }
		</style>
    </head>
    <body class = "bg-light">
		<?php include "navbar.php"; ?>
		<div class=' container container-transform mt-5 bg-white' style="box-shadow: 0 5px 8px 5px rgba(0, 0, 0, .15);">
			<div class='row'>
				<div class='col-md-9 mx-auto'>
					<h1 class='text-muted mt-4 mb-4 text-center'>Announcement</h1><hr>
					<div class='row mt-5'>
						<div class='col-md-2'>
						</div>	
						<div class='col-md-8'>
							<h2 class='text-muted text-center'><?php echo $data["title"]; ?></h2>
							<p class="font-weight-bold text-center mt-4">Posted: <?php echo date("m/d/Y", strtotime($data["datePosted"])); ?></p>
							<p class = "text-center"><strong>Description:</strong> <?php echo $data["description"]; ?></p>
							
							<form  class = "mt-5" method='post' action='<?php echo $_SERVER["REQUEST_URI"];?>'>
								<input type='hidden' name='announcementID' value='<?php echo $data["announcementID"]; ?>'>
								<input type='hidden' name='title' value='<?php echo $data["title"]; ?>'>
								<input type='hidden' name='description' value='<?php echo $data["description"]; ?>'>
								<input type='hidden' name='datePosted' value='<?php echo $data["datePosted"]; ?>'>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
<?php
    include 'footer.html';
?>
</html>