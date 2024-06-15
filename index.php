<?php
session_start();

if (isset($_SESSION['login'])) {
	header("Location: view_admin/index.php");
	exit;
}

include "templates/auth_header.php";
?>

<div class="text-center my-4">
	<!-- <img src="assets/img/setting/logo.png" class="img-fluid" width="132" height="132" /> -->
</div>

<div class="card">
	<div class="card-body">
		<div class="m-sm-2">
			<div class="text-center mb-4">
				<h1 class="h2">SISTEM INFORMASI MONITORING HAWA BURUNG</h1>
				<p class="lead">
					SIMHURUNG
				</p>
			</div>

			<?php if (isset($_GET["pesan"])): ?>
				<p class="alert alert-danger my-4" style="font-style: italic; color: red; text-align: center;">
					<?= $_GET["pesan"]; ?>
				</p>
			<?php endif; ?>

			<form action="cek_login.php" method="POST">
				<div class="mb-3">
					<label class="form-label">Username</label>
					<input class="form-control form-control-lg" type="text" name="username" placeholder="Username" />
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>
					<input class="form-control form-control-lg" type="password" name="password"
						placeholder="Password" />
				</div>
				<div class="text-center mt-3">
					<button type="submit" class="btn btn-lg btn-primary w-100">Sign in</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include "templates/auth_footer.php";
?>