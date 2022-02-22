<section class="footerSection">
	<div class="container mt-5">
    <div class="row">
      <?php 
        if (!isset($_COOKIE['cookiesBanner'])) {
        
      ?>
      <div class="cookie-consent-banner">
        <div class="cookie-consent-banner__inner">
          <div class="cookie-consent-banner__copy">
            <div class="cookie-consent-banner__header">THIS WEBSITE USES COOKIES</div>
            <div class="cookie-consent-banner__description">We use cookies to personalise content, to provide many media features and to analyse our traffic. We also use the cookie information to help you navigate amonng the apps on this software for your good use of our site, cookies maybe used for analytics purposes to know which pages you have visited You consent to our cookies if you continue to use our website.</div>
          </div>

          <div class="cookie-consent-banner__actions">
            <a href="" class="cookie-consent-banner__cta cookiesAgree">
              OK
            </a>
            
            <a href="" class="cookie-consent-banner__cta cookie-consent-banner__cta--secondary cookiesAgree">
              Decline
            </a>
          </div>
        </div>
      </div>
    <?php }else{}?>

    </div>
		<div class="row">
			<div class="col-sm-3"><img src="images/logo.png" class="logo-img" alt="2logo" width="120"></div><div class="col-sm-9"></div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="footer-widget">
					<p class="fs-5">A double management tool that helps you to plan projects and create payroll for your staff</p>
				</div>
      	<div class="d-flex align-items-center justify-content-around flex-wrap mb-4">
          	<a href="https://web.facebook.com/Weblister" target="_blank" title="facebook"><i class="bi bi-facebook fs-3" ></i></a>
          	<a href="https://www.linkedin.com/company/weblister-co" target="_blank" title="linkedin"><i class="bi bi-linkedin fs-3"></i></a>
          	<a href="https://twitter.com/mutamuls" target="_blank" title="twitter"><i class="bi bi-twitter" alt="twitter fs-3"></i></a>
      	</div>
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2">
				<div class="footer-widget">
					<h4>Useful Links</h4>
            <ul>
                <li><a href="privacy" title="privacy">Privacy</a></li>
              <li><a href="cookies" title="cookies">Cookies</a></li>
            	 <li><a href="knowledge" title="faq">Knowledge base</a></li>
            </ul>
        </div>
			</div>
			<div class="col-sm-2">
				<div class="footer-widget">
					<h4>Other Links</h4>
            <ul>
                <!-- <li><a href="./#reviews" title="client-reviews">Reviews</a></li> -->
                <li><a href="prices" title="pricing">Pricing</a></li>
                <li><a href="contact" title="contact">Contact</a></li>
            </ul>
        </div>
			</div>
		</div>
	</div>
</section>
<style>
  .cookie-consent-banner {
  position: fixed;
  bottom: 0;
  left: 0;
  z-index: 2147483645;
  box-sizing: border-box;
  width: 100%;

  background-color: #F1F6F4;
}

.cookie-consent-banner__inner {     
  max-width: 960px;
  margin: 0 auto;
  padding: 32px 0;
}

.cookie-consent-banner__copy { 
  margin-bottom: 16px;
}

.cookie-consent-banner__actions {    
}

.cookie-consent-banner__header {
  margin-bottom: 8px;
  
  font-family: "CeraPRO-Bold", sans-serif, arial;
  font-weight: normal;
  font-size: 16px;
  line-height: 24px;
}

.cookie-consent-banner__description {
  font-family: "CeraPRO-Regular", sans-serif, arial;
  font-weight: normal;
  color: #838F93;
  font-size: 16px;
  line-height: 24px;
}

.cookie-consent-banner__cta {
  box-sizing: border-box;
  display: inline-block;
  min-width: 164px;
  padding: 11px 13px;
    
  border-radius: 2px;
  
  background-color: #2CE080;
   
  color: #FFF;
  text-decoration: none;
  text-align: center;
  font-family: "CeraPRO-Regular", sans-serif, arial;
  font-weight: normal;
  font-size: 16px;
  line-height: 20px;
}

.cookie-consent-banner__cta--secondary { 
  padding: 9px 13px;
  
  border: 2px solid #3A4649;
  
  background-color: transparent;
  
  color: #2CE080;
}

.cookie-consent-banner__cta:hover {
  background-color: #20BA68;
}

.cookie-consent-banner__cta--secondary:hover {
  border-color: #838F93;
    
  background-color: transparent;
  
  color: #22C870;
}

.cookie-consent-banner__cta:last-child {
  margin-left: 16px;
}
.footerSection {
    margin:10em auto;
}
#fixed-form-container{
    position: fixed;
    bottom: 5px;
    left: 3%;
    width: 94%;
    text-align: center;
    margin: 0;

}

#fixed-form-container .button:before { 
   content: "+ ";
}

#fixed-form-container .expanded:before { 
    content: "- ";
}

#fixed-form-container .button { 
  font-size:1.1em; 
	cursor: pointer;
	margin-left: auto;
  margin-right: auto;
	border: 2px solid #e25454;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px 5px 0px 0px;
	padding: 5px 20px 5px 20px;
	background-color: #e25454;
	color: #fff;
	display: inline-block;
	text-align: center;
	text-decoration: none;
  -webkit-box-shadow: 4px 0px 5px 0px rgba(0,0,0,0.3);
  -moz-box-shadow: 4px 0px 5px 0px rgba(0,0,0,0.3);
  box-shadow: 4px 0px 5px 0px rgba(0,0,0,0.3);
}

#fixed-form-container .body{
    background-color: #fff; 
    border-radius: 5px;
    border: 2px solid #e25454;
    margin-bottom: 16px;
    padding: 10px; 
    -webkit-box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.3);
}

@media only screen and (min-width:768px){
    #fixed-form-container .button{
       margin: 0;

    }
    #fixed-form-container {
        left: 20px;
        width: 390px;
        text-align: left;
    }

    #fixed-form-container .body{
        padding: 30px;
        border-radius: 0px 5px 5px 5px;
    }
}
@media(max-width:767px) {
	#fixed-form-container {
		margin-top:10em;
	}
}

</style>

<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<!-- <script src="toastr/toastr.min.js"></script> -->
<script src="app/plugins/toastr/toastr.min.js"></script>
<script src="app/intl.17/build/js/intlTelInput.js"></script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList", 
  "itemListElement": [{
    "@type": "ListItem", 
    "position": 1, 
    "name": "Login",
    "item": "https://login.osabox.net"  
  },{
    "@type": "ListItem", 
    "position": 2, 
    "name": "Register",
    "item": "https://osabox.net"  
  },{
    "@type": "ListItem", 
    "position": 3, 
    "name": "Pricing",
    "item": "https://osabox.net/prices"  
  },{
    "@type": "ListItem", 
    "position": 4, 
    "name": "Knowledge",
    "item": "https://osabox.net/knowledge"  
  },{
    "@type": "ListItem", 
    "position": 5, 
    "name": "Privacy",
    "item": "https://osabox.net/privacy"  
  },{
    "@type": "ListItem", 
    "position": 6, 
    "name": "Cookies",
    "item": "https://osabox.net/cookies"  
  }]
}
</script>
<script type="text/javascript">
 //   (function(){
	// var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	// s1.async=true;
	// s1.src='https://weblister.co/js/js.js';
	// s1.charset='UTF-8';
	// s1.setAttribute('crossorigin','*');
	// s0.parentNode.insertBefore(s1,s0);
	// })();
</script>

<script>
    $(document).ready(function(){
        $(".hamburger").click(function(){
            $(this).toggleClass("is-active");
        });
    });
	var uuid = "<?php echo getUserIpAddr();?>";
	
    function successNow(msg){
        toastr.success(msg);
        toastr.options.progressBar = false;
        toastr.options.positionClass = "toast-bottom-right";
    }

    function errorNow(msg){
        toastr.error(msg);
        toastr.options.progressBar = true;
        toastr.options.positionClass = "toast-top-center";
    }

    function toasTshow(msg){
        Command: toastr["success"](msg);

        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": true,
          "showDuration": "3000",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "5000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
    }

  $(document).on("click", ".cookiesAgree", function(e){
      e.preventDefault();
      var cvalue = "cookiesBanner";
      var cname = "cookiesBanner";
        cookiesBannerSet(cname, cvalue);
        setTimeout(function(){
          $(".cookie-consent-banner").hide("slow");
          window.location = "./";
        }, 500);
      })
      function cookiesBannerSet(cname, cvalue) {
        event.preventDefault();    
        const d = new Date();
        d.setTime(d.getTime() + (30*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
    
</script>