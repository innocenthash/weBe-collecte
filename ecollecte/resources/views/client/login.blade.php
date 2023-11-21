{{-- <!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>JustDo Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="css/themify-icons.css">
  <link rel="stylesheet" href="css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="http://www.urbanui.com/justdo/template/images/logo.svg" alt="logo">
              </div>
              <h6 class="font-weight-light">login</h6>
              <form class="pt-3" action="" method="post">

                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="nom d'utilisateur" name="username" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="mot de passe" name="mot_de_passe" required="">
                    </div>
                    <div class="mt-3">
                        <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    </div>
                    <div class="mt-3">
                        <a href="{{URL::to('/signup')}}"> N'avez-vous pas un compte ? S'enregistrer</a>
                    </div>
                </fieldset>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="js/vendor.bundle.base.js"></script>
  <script src="js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html> --}}




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="frontendloginclient/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontendloginclient/css/util.css">
	<link rel="stylesheet" type="text/css" href="frontendloginclient/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('frontendloginclient/images/bg-01.jpg');">
			<div class="wrap-login100">

                @if ( Session::has('status'))
                <div class="alert alert-danger">
                {{Session::get('status')}}
                {{Session::put('status',null)}}
            </div>
            @endif
            @if (count($errors)>0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
            <li>{{$error}}</li>
            </div>

            @endforeach
            @endif


				<form class="login100-form validate-form" action="{{url('/acceder_au_compte_client')}}" method="POST">
                    {{ csrf_field() }}
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
					Se Connecter
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="E-mail">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
                            <a href="{{URL::to('/signup')}}"> N'avez-vous pas un compte ? S'enregistrer</a>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="frontendloginclient/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="frontendloginclient/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="frontendloginclient/vendor/bootstrap/js/popper.js"></script>
	<script src="frontendloginclient/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="frontendloginclient/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="frontendloginclient/vendor/daterangepicker/moment.min.js"></script>
	<script src="frontendloginclient/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="frontendloginclient/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="frontendloginclient/js/main.js"></script>

</body>
</html>

