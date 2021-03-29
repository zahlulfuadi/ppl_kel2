<!DOCTYPE html>
<html>

<head>
	<title>Masuk</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Produk By Mfikri.com">
	<meta name="author" content="M Fikri Setiadi">
	<!-- Bootstrap -->
	<link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
	<!-- styles -->
	<link href="<?php echo base_url() . 'assets/css/styles_login.css' ?>" rel="stylesheet">


</head>

<body class="login-bg" style="background-image: url('assets/img/login-bg.jpeg'); background-size: 100%;">


	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
					<div class="box" style="background-color:powderblue;">
						<div class="content-wrap">
							<img width="310px" src="<?php echo base_url() . 'assets/img/logopos.png' ?>" />
							<p style="color: red; margin-top: 10px;"><?php echo $this->session->flashdata('msg'); ?></p>
							<hr />
							<form action="<?php echo base_url() . 'administrator/cekuser' ?>" method="post">
								<input class="form-control" type="text" name="username" placeholder="Username" required>
								<input class="form-control" type="password" name="password" placeholder="Password" style="margin-bottom:1px;" required>
								<div class="action">
									<button type="submit" class="btn btn-lg " style="width:310px;margin-top:0px; bg-color:#ff9000;">Login</button>
								</div>
							</form>

						</div>
					</div>

					<div class="already">

					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>

</body>

</html>