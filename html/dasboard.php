<?php
session_start();
include('../php/connection.php');
if($_SESSION){} else { header('Location: ../index.html'); }
?>
<!doctype html>
<html>
	<head>
		<title>Need Blood ?</title>
		<link rel="stylesheet" href="../lib/style.css">
		<script type="text/javascript" src="../lib/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="../lib/javaScript.js"></script>
	</head>
	<body>
		<div class="header">
			<img src="../lib/image/logo.jpg" class="logoOnDashboard" >
			<h3 class="headingDashboard">Need Blood ?</h3>
			<span class="transactionLinks receiveLink">Receive ?</span>
			<span class="transactionLinks donateLink">Donate ?</span>
			<span class="userName">Welcome : <span><?php echo($_SESSION['userName']) ?></span></span>
			<input id="userIdInput" type="hidden" value="<?php echo($_SESSION['userId']) ?>">
		</div>
		<div class="roleStyle">
			<span class="roleTitle">Role : </span>
			<?php
				$userId = $_SESSION['userId'];
				$rolesSql = "SELECT rolename as roleName FROM role
                INNER JOIN rolemapping ON role.id=rolemapping.roleid
                WHERE rolemapping.userid = '$userId'";
				$resultRoles=mysql_query($rolesSql,$conn);
				while($rowRoles=mysql_fetch_row($resultRoles)){
					?>
						<span class="roleSpan">
							<input class="roleRadioInput" type="radio" name="roleradio" value="<?php echo($rowRoles[0]) ?>">
							<span class="roleHead"><?php echo($rowRoles[0]) ?></span>
						</span>
				<?php					
				}
				mysql_close($conn);
			?>
			<!--<span class="roleSpan">
				<input type="radio" name="roleradio">
				<span class="roleHead">Hospital</span>
			</span>
			<span class="roleSpan">
				<input type="radio" name="roleradio">
				<span class="roleHead">Bank</span>
			</span>
			<span class="roleSpan">
				<input type="radio" name="roleradio">
				<span class="roleHead">Donor</span>
			</span>
			<span class="roleSpan">
				<input type="radio" name="roleradio">
				<span class="roleHead">Recipient</span>
			</span>-->
			<a class="signOutLink" href="../php/logout.php">
				<img class="signOutIcon" src="../lib/image/signoutIcon.png" class="logoOnDashboard" >
				<span>SignOut</span>
			</a>
		</div>
		
		<div id="mainContainer">
			

			
		</div>
	</body>
	<script type="text/javascript">
	$( document ).ready(function() {
		$(".roleRadioInput").first().click();
		$(".roleHead").each(function() {
    		if($(this).html()=="hospital"){
    			$('.donateLink').remove();    			
    		}
    		if($(this).html()=="bank"){
    			$('.transactionLinks').remove();    			
    		}
		});
	});
	</script>
</html>