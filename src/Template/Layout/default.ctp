<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = '';      
?>
<!doctype html> 
<html lang="en">
<head>
	<?=  $this->Html->charset() ?>   	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $cakeDescription ?> Videos</title>  
	<link rel="icon" type="image/x-icon" href="<?php echo $this->request->webroot."images/favicon-32x32.png";?>" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<?= $this->Html->css( array('custom/slick-theme.css','custom/slick.css','custom/style.css','custom/responsive.css') ) ?>  
	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,700italic,400italic,600italic,600"
	rel="stylesheet" type="text/css">
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" type="text/javascript"></script>
	<?= $this->Html->script(array('jquery.min.js','jquery-ui.min.js')) ?> 
	<script src="https://apis.google.com/js/platform.js"></script>   
	<script>
		$(document).ready(function(){ 
                $('.flash-msg').delay(5000).fadeOut('slow');
        });



         /************Google Login**********************/

        
    var startApp = function() {
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
                client_id: '699723558929-99dmpstsi1cbcuhlbgc3fjruivosplfe.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
            });
            attachSignin(document.getElementById('customBtn')); 
            attachSignin(document.getElementById('customBtn1'));   
        });
    };
    var googleUser = {};
    function attachSignin(element) {
        auth2.attachClickHandler(element, {},
            function(googleUser) {
                var profile = googleUser.getBasicProfile();
                var google_id = profile.getId();
                var full_name = profile.getName();
                var image = profile.getImageUrl();
                var g_email = profile.getEmail()
                var uid = '<?php echo $loggeduser["id"]; ?>';
                if (google_id != '' && uid == '') {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->request->webroot ?>users/gplogin",
                        data: {
                            id: profile.getId(),
                            name: profile.getName(),
                            first_name: profile.getGivenName(),
                            last_name: profile.getFamilyName(),
                            email: profile.getEmail(),
                            image: profile.Paa,
                            action: 'gplogin'
                        },
                        dataType: "json",
                        success: function(data) {
                           // console.log(data);
                           // return false;
                            if (data.isSuccess != 'true') {
                                alert(data.msg);
                            } else {
                                location.reload();
                            }
                        },
                        error: function() {}
                    });
                }
            },
            function(error) {
                //alert(JSON.stringify(error, undefined, 2));
            });
    }
    

  /************Google Login End**********************/
	</script>     
	 
	<style>
	.alert-danger{text-align: center;}
	.alert-success{text-align: center;}
	.alert-success{
		padding: 10px;
		font-size: 15px;
		margin: 0px;
	}
	.message.error{
		background: #cc0000;
		padding: 10px;
		color: #fff;
		font-size: 15px;
		margin: 0px 0px 0px 0px;
	}
	.my-error-class{
		color:red !important;
	}
	.my-valid-class{
		color:#49BA64 !important;  
	}
    .error-message{
        color: red;
    } 
    .error{
        color: red;
    }  

</style>   
      

</head> 
<body>

	<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="<?php echo $this->request->webroot ?>"><img src="<?php echo $this->request->webroot; ?>images/logo.png" /></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fa fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">

				<form class="form-inline search my-2 my-lg-0"  method="get" id="searchform" action="<?php echo $this->request->webroot; ?>videos/search">
	              <input class="form-control input-sm s " id="s" name="search" autocomplete="off" value="<?php if(isset($_GET['search'])){  echo $_GET['search']; }elseif(isset($searchval)){ echo $searchval; } ?>" type="search" placeholder="Search" aria-label="Search" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">

	              <button class="btn red my-2 my-sm-0" type="submit" style="border-top-left-radius: 0px;
	   				 border-bottom-left-radius: 0px;"><i class="fa fa-search" aria-hidden="true"></i></button> 
	            </form>  


				<ul class="navbar-nav ml-auto">
					<li class="nav-item pr-4">
						<a class=" js-scroll-trigger active theme-color" href="<?php echo $this->request->webroot ?>"><i class="fa fa-home d-block text-lg-center" aria-hidden="true"></i>HOME</a>
					</li>
					
					<li class="nav-item pr-4">
						<a class="js-scroll-trigger" href="<?php echo $this->request->webroot ;?>categories/movies"><i class="fa fa-film d-block text-lg-center" aria-hidden="true"></i>MOVIES</a>
					</li>
					<li class="nav-item pr-4">
						<a class="js-scroll-trigger" href="<?php echo $this->request->webroot ;?>categories/series"><i class="fa fa-camera d-block text-lg-center" aria-hidden="true"></i>SERIES</a>  
					</li>
				
					<?php if($loggeduser){ ?>   
					<li class="nav-item pr-4">
						<a class="js-scroll-trigger" href="<?php echo $this->request->webroot ;?>categories/collections"><i class="fa fa-clone d-block text-lg-center" aria-hidden="true"></i>COLLECTIONS  </a>
					</li>
					 <li class="nav-item dropdown">
		                <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                	<?php if(!empty($currentuser["image"])){  ?>    
                            <img style="width:34px;height:34px;border-radius: 50%;" src="<?php echo $currentuser["image"]; ?>">
                            <?php }else{  ?>
                            <img style="width:34px;height:34px;border-radius: 50%;" src="<?php echo $this->request->webroot ?>images/noimage.png">
                            <?php } ?>
		                
		                </a> 
		                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		                  <a class="dropdown-item" href="<?php echo $this->request->webroot ?>users/myaccount"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
		                  <a class="dropdown-item" href="<?php echo $this->request->webroot ?>users/myplan"><i class="fa fa-user" aria-hidden="true"></i> My Plan</a>
		                  <a class="dropdown-item" href="<?php echo $this->request->webroot ?>users/changepassword"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
		                  <a class="dropdown-item" href="<?php echo $this->request->webroot ?>users/logout"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>  
		                </div>
		      		</li>
		      		<?php }else{ ?>
		      			<li class="nav-item log">
						<a class="js-scroll-trigger theme-btn theme-bg" href="<?php echo $this->request->webroot ?>users/login">LOGIN</a>
					</li>
		      		<?php } ?>

				</ul>
			</div>
		</div>
	</nav>

 


	<?= $this->fetch('content') ?>    

	<footer>
		<div class="ftr">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 mx-auto">
						<div class="ftr-inner text-center">
							<ul class="mb-4 p-0">
								<li class="px-2 d-inline"><a href="<?php echo $this->request->webroot; ?>" class="active">HOME</a></li>
								<li class="px-2 d-inline"><a href="#">COLLECTIONS</a></li>
								<li class="px-2 d-inline"><a href="<?php echo $this->request->webroot; ?>categories/movies">MOVIES</a></li>
								<li class="px-2 d-inline"><a href="<?php echo $this->request->webroot; ?>categories/aboutus">SERIES</a></li>
							</ul>
							<ul class="mb-4 p-0">
								<li class="px-2 d-inline"><a href="<?php if(isset($globalsettings[3]['value'])){ echo $globalsettings[3]['value']; } ?>"><img src="<?php echo $this->request->webroot; ?>images/f1.png" /></a></li>
								<li class="px-2 d-inline"><a href="<?php if(isset($globalsettings[5]['value'])){ echo $globalsettings[5]['value']; } ?>"><img src="<?php echo $this->request->webroot; ?>images/f2.png" /></a></li> 
								<li class="px-2 d-inline"><a href="<?php if(isset($globalsettings[7]['value'])){ echo $globalsettings[7]['value']; } ?>"><img src="<?php echo $this->request->webroot; ?>images/f3.png" /></a></li>
								<li class="px-2 d-inline"><a href="<?php if(isset($globalsettings[4]['value'])){ echo $globalsettings[4]['value']; } ?>"><img src="<?php echo $this->request->webroot; ?>images/f4.png" /></a></li>
							</ul>

							<h4 class="mb-3"><?php if(isset($globalsettings[2]['value'])){ echo $globalsettings[2]['value']; } ?></h4>  
							<h4><?php if(isset($globalsettings[0]['value'])){ echo $globalsettings[0]['value']; } ?></h4>     
						</div>
					</div>


					<div class="bottom">
						<div class="lft mb-lg-0 mb-3">
							<h5 class="mb-0">Copyright &copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?> </h5>   
						</div>
						<div class="rt">
							<ul class="m-0 p-0">
								<li class="px-2 pl-lg-3 d-inline"><a href="<?php echo $this->request->webroot; ?>staticpages/aboutus">About Us</a></li>
								<li class="px-2 pl-lg-3 d-inline"><a href="<?php echo $this->request->webroot; ?>staticpages/term"> Terms and Conditions</a></li>
								<li class="px-2 pl-lg-3 d-inline"><a href="<?php echo $this->request->webroot; ?>staticpages/privacy">Privacy Policy</a></li>
								<li class="px-2 pl-lg-3 d-inline"><a href="<?php echo $this->request->webroot; ?>staticpages/faq">FAQ</a></li>  
								<li class="px-2 pl-lg-3 d-inline"><a href="<?php echo $this->request->webroot; ?>staticpages/contact"> Contact Us</a></li>
							</ul>  
						</div>
					</div>


				</div>
			</div>
		</div>
	</footer>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->

	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>     
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="<?php echo $this->request->webroot; ?>js/parallax.js"></script>
	<script src="<?php echo $this->request->webroot; ?>js/slick.min.js"></script>
    <script src="<?php echo $this->request->webroot; ?>js/slick.js"></script>

	<script>
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();

		     //>=, not <=
		     if (scroll >= 100) {
		        //clearHeader, not clearheader - caps H
		        $("#mainNav").addClass("darkHeader");
		    } else {
		    	$("#mainNav").removeClass("darkHeader");
		    }
		});
	</script>  

	  <!---Start-Facebook Login-->
    <script type="text/javascript">
        function testAPI() {
            FB.api('/me?fields=id,email,name,birthday,locale,age_range,gender,first_name,last_name,picture', function(response) {  
                data = {
                    myid : response,
                    action:'fblogin'
                }

                $.ajax({
                    url: '<?php echo $this->request->webroot ?>users/fblogin',
                    data: data,
                    method: 'post',
                    dataType: 'json',
                    beforeSend: function(){  
                        var info_html = '<div class="alert alert-info"><strong>Please Wait...</strong></div>';
                        $('.alert-box1').html(info_html).css('display', 'block');
                    },
                    success: function(resdata){
                        console.log(resdata);
                        //window.location.href = resdata.link;
                        if(resdata.isSuccess != 'true'){
                            alert(resdata.msg);
                        }else{

                         $('.alert-box1').html(resdata.msg).css('display', 'block');
                         setTimeout(function(){ location.reload();; }, 2000);
                            
                        }
                    }
                });
            });
        }
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            if (response.status === 'connected') {
                testAPI();
            } else {
                console.log('Please log ') ;
            }
        }
        $(document).ready(function(){
            window.fbAsyncInit = function() {  
                FB.init({
                    appId      : '760608767466285',
                    cookie     : true,  
                    xfbml      : true, 
                    version    : 'v2.10' 
                });
            };
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            $(function() {
                $('.omb_login').on('click', function (e) {
                    e.preventDefault();
                    FB.login(function(response) {
                        checkLoginState();
                    }, {scope: 'email'});
                });
            });
        })


       /*slick* start*/
	jQuery('.respons').slick({
	  dots: false,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  arrows: true,
	  responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 1,
			infinite: true,
			dots: true
		  }
		},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}




		  ]
	});	
	/*slick* end*/

	jQuery("#s").autocomplete({
		minLength: 2,
		select: function(event, ui) {
			jQuery("#s").val(ui.item.label);
			jQuery("#searchform").submit();
		},
		source: function (request, response) {
			jQuery.ajax({
				url: '<?php echo $this->request->webroot;?>videos/searchjson',
				data: {
					term: request.term
				},
				dataType: "json",
				success: function(data) {
					response(jQuery.map(data, function(el, index) {
						return {
							value: el.name,
							name: el.name,
							poster: el.poster
						}; 
					}));
				}
			});
		}
	}).data("ui-autocomplete")._renderItem = function (ul, item) {
		return jQuery("<li></li>")
			.data("item.autocomplete", item) 
			.append("<a><img width='40' src='<?php echo $this->request->webroot;?>images/videos/" + item.poster + "' /> " + item.name + "</a>")
			.appendTo(ul)
	};
    </script>    
    <!--End-Facebook Login-->    

</body>
</html>	