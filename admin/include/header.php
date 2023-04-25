<?php date_default_timezone_set('Asia/Hong_Kong'); ?>
<style>
	/* The Modal (background) */
	.modal {
		display: none;
		position: fixed;
		z-index: 1;
		padding-top: 100px;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		margin: 0;
		background-color: rgb(0, 0, 0);
		background-color: rgba(0, 0, 0, 0.4);
	}

	/* Modal Content */
	.modal-content {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
	}

	/* The Close Button */
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}

	.modal iframe {
		width: 100%;
		height: 500px;
		border: 0;
	}
</style>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<i class="icon-reorder shaded"></i>
			</a>

			<a class="brand" href="index.php">

			</a>

			<div class="nav-collapse collapse navbar-inverse-collapse">
				<ul class="nav pull-right">
					<li><a href="#">
							Admin
						</a></li>
					<li class="nav-user dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="images/user.png" class="nav-avatar" />
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="change-password.php">Change Password</a></li>
							<li class="divider"></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->