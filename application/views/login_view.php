<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>JCORE - LOGIN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="">
    <?php echo $_def_css_files; ?>
    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style-blessed3ef7a.css"> -->
	<!-- animation CSS -->
	<link href="assets/css/ample-login/animate.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="assets/css/ample-login/style.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="assets/css/ample-login/colors/default.css" id="theme"  rel="stylesheet">

    <style>
	    .ui-pnotify-title {
	    	color: white !important;
	    }
	    body {
	    	font-family: arial;
	    }
	    .new-login-register .lg-info-panel .lg-content {
	    	margin-top: 35%;
	    }
	    .new-login-register .lg-info-panel .inner-panel {
    	    background: rgba(0, 0, 0, 0.7);
	    }
	    .new-login-register .lg-info-panel {
	    	background: url('assets/img/login.jpg') no-repeat center center / cover !important;
	    }
	    hr {
	    	border-top: 1px solid #eaeaea;
	    }
    </style>
    </head>
<body class="focused-form animated-content login-background">
<section id="wrapper" class="new-login-register">
      <div class="lg-info-panel">
          <div class="inner-panel">
              <div class="lg-content">
              	  <img style="height: 100px; width: 100px;" src="<?php echo $company->logo_path; ?>">
                  <hr><h1 style="font-family: sans-serif!important; color: white;"><b>JCORE</b> STANDARD ACCOUNTING</h1><hr>
                  <h3 style="color: #03a9f4;"><?php echo $company_info[0]->company_name; ?></h3>
                  <span style="position: absolute; bottom: -3%; right: 1%;"><p>powered by <img src="assets/img/jdev-logo2.png" height="30" width="70"></p></span>
              </div>
          </div>
      </div>
      <div class="new-login-box">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Sign In</h3>
                    <small>Please Enter your details below</small>
                  	<form action="#" class="form-horizontal" id="validate-form" style="margin-top: 15%;">
						<div class="form-group mb-md" id="userdiv">
	                        <div class="col-xs-12">
	                        	<label>USERNAME</label>
                        		<input name="user_name" id="user" type="text" class="form-control " style="border-radius: 0;" placeholder="Username" data-parsley-minlength="20" placeholder="At least 6 characters" required>
	                        </div>
						</div>
						<div class="form-group mb-md" id="passdiv">
	                        <div class="col-xs-12">
	                       		<label>PASSWORD</label>
								<input name="user_pword" id="pass" type="password" class="form-control" style="border-radius: 0;" id="exampleInputPassword1" placeholder="Password">
	                        </div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 hidden " style="margin-bottom: 10px;">
								<button id="btn_register" class="btn btn-info btn-block">Register</button>
							</div>
							<div class="col-sm-offset-6"></div>								
							<div class="col-xs-12 col-sm-12">
								<button id="btn_login" class="btn btn-primary btn-block btn-custom-jk" data-style="expand-left" data-spinner-color="white" data-size="s" style="margin-bottom: 50px;">
								<span class=""></span> Login
								</button>
							</div>
						</div>
					</form>
                </div>
      </div>            

</section>
<?php echo $_def_js_files; ?>
<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
    <script>
        $(document).ready(function(){
            var bindEventHandlers=(function(){
                $('#btn_login').click(function(){
                    var l = Ladda.create(this);
                    l.start();
                    validateUser().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){
                            setTimeout(function(){
                                window.location.href = "dashboard";
                            },600);
                        }
                    }).always(function(){
                        l.stop();
                    });
                });
                $('input').keypress(function(evt){
                    if(evt.keyCode==13){
                    	evt.preventDefault();
                    	$('#btn_login').click();
                    }
                });
            })();
            var validateUser=function(){
                var _data={uname : $('input[name="user_name"]').val() , pword : $('input[name="user_pword"]').val()};
                return $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Login/transaction/validate",
                    "data" : _data,
                    "beforeSend": function(){
                    }
                });
            };
            var showNotification=function(obj){
                PNotify.removeAll(); //remove all notifications
                new PNotify({
                    title:  obj.title,
                    text:  obj.msg,
                    type:  obj.stat
                });
            };
        });
    </script>
</body>
<!-- Mirrored from avenxo.kaijuthemes.com/extras-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2016 12:14:53 GMT -->
</html>