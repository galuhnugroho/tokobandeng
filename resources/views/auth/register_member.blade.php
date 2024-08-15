<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="/login_page/img/logo_login.png" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                            <br>
                                @if (Session::has('errors'))
                                <ul>
                                    @foreach (Session::get('errors') as $error)
                                    <li style="color: red">{{ $error[0] }}</li>
                                    @endforeach
                                </ul>
                                @endif

							<form action="/register_member" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                @csrf
								<div class="mb-3">
									<label class="mb-2 text-muted" for="nama_member">Nama Lengkap</label>
									<input id="nama_member" type="text" placeholder="Nama Lengkap" class="form-control" name="nama_member" value="" required autofocus>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="no_hp">No. HP</label>
									<input id="no_hp" type="text" placeholder="No. HP" class="form-control" name="no_hp" value="" required autofocus>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">Email</label>
									<input id="email" type="text" placeholder="Email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="konfirmasi_password">Konfirmasi Password</label>
									<input id="konfirmasi_password" type="text" placeholder="Konfirmasi Password" class="form-control" name="konfirmasi_password" required>
								</div>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Register	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Sudah Punya Akun? <a href="/login_member" class="text-dark">Login</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2024 Toko Bandeng 2D 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
        (function () {
        'use strict'
    
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
    
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
      </script>

	<script src="/sbadmin2/vendor/jquery/jquery.min.js"></script>
      
</body>
</html>
