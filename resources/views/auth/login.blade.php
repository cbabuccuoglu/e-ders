
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ONLINE DENEME SINAVI SİSTEMİ</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	 {{Html::style('css/icons/icomoon/styles.min.css')}}
     {{Html::style('assets/css/bootstrap.min.css')}}
     {{Html::style('assets/css/bootstrap_limitless.min.css')}}
     {{Html::style('assets/css/layout.min.css')}}
     {{Html::style('assets/css/components.min.css')}}
     {{Html::style('assets/css/colors.min.css')}}

     {{Html::script('js/main/jquery.min.js')}}
     {{Html::script('js/main/bootstrap.bundle.min.js')}}
     {{Html::script('js/plugins/loaders/blockui.min.js')}}
     {{Html::script('assets/js/app.js')}}


</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark" style="background: #a4070b">
		<div class="navbar-brand">
			<a href="index.html" class="d-inline-block">

			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
		</div>


	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
                <form action="{{route('user.login.submit')}}" method="POST" class="login-form">
                	@csrf
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								 <br /> <br /><br />
								<h5 class="mb-0">Öğretmen/Öğrenci/Veli Girişi</h5>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="email" class="form-control" placeholder="Öğrenci & Veli & Öğretmen Numaranızı Giriniz">
								   @if ($errors->has('email'))
                                <span style="color:red;" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Şifrenizi Giriniz">
								 @if ($errors->has('password'))
                                <span style="color:red;" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Giriş Yap <i class="icon-circle-right2 ml-2"></i></button>
							</div>


						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
	<div class="navbar navbar-expand-lg navbar-light">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-footer">
                    <span class="navbar-text">
                        &copy; 2020. <a href="#">Online Deneme Sınavı Sistemi</a>
                    </span>


                </div>
            </div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
