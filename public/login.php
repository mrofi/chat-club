<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login do chat</title>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase:600" rel="stylesheet">
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap/colorpicker/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="/css/login.css">
</head>
<body style="background-image: url('/background/page-top.jpg')">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="jumbotron text-center">
					<h1>World of Azarezal</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="well">
					<legend class="text-center">Sign in to Play</legend>
					<form role="form" class="form" method="POST" action="index.php" accept-charset="UTF-8">
						<!-- <label for="department">Department</label> -->
						<!-- <input class="span3" placeholder="Department" type="text" name="user[department]" required> -->
						<!-- <label for="username">Username</label> -->
						<div class="row form-group">
							<label for="char-name" class="col-xs-3 control-label">Name</label>
							<div class="col-xs-9">
								<input id="char-name" class="form-control" placeholder="Character Name" type="text" name="user[username]" required> 
							</div>
						</div>
						<div class="row form-group">
							<label for="char-color" class="col-xs-3 control-label">Color</label>
							<div class="col-xs-9">
								<input id="char-color" class="form-control colorpicker" style="color: transparent;" placeholder="Character Color" type="text" name="user[color]" required> 
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<button class="btn btn-primary btn-block" type="submit">Sign in</button>
							</div>
						</div>
					</form>    
				</div>
			</div>
		</div>
	</div>

    <script src="/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- <script src="\\code.jquery.com/jquery.min.js"></script> -->
	<script>
		$(function() {
			$('.colorpicker').on('changeColor', function() {
				$(this).css('background-color', $(this).val());
			}).colorpicker();
		});
	</script>
</body>
</html>