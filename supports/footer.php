<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
        	<?php 
	        if (!isset($_COOKIE['newCookieBanner'])):
	        
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
	    	<?php endif;?>
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify text-white">osabox.co <i> IS A SIMPLE </i> initiative to help small to medium scale entrepreneurs manage their projects and also create seamless payroll and generate payslips for their startup businesses </p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Legal</h6>
            <ul class="footer-links">
				<li><a href="privacy" title="privacy" class="text-decoration-none text-white">Privacy</a></li>
          		<!-- <li><a href="guidelines" title="cookies" class="text-decoration-none text-white">Knowlege</a></li> -->
        	 	<li><a href="terms-of-use" title="faq" class="text-decoration-none text-white">Terms of Use</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="https://login.osabox.co" title="sign_in">Sign in</a></li>
              <li><a href="register" title="sign_up">Sign Up</a></li>
              <li><a href="contact" title="contact_us">Contacts Us</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          	<div class="col-md-8 col-sm-6 col-xs-12">
            	<p class="copyright-text">Copyright &copy; <?php echo date("Y")?> All Rights Reserved by 
         			<a href="./">Osabox.co</a>
            	</p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
				<li><a href="https://web.facebook.com/Weblister" target="_blank" title="facebook" class="text-decoration-none text-white  facebook"><i class="bi bi-facebook" ></i></a></li>
	          	<li><a href="https://www.linkedin.com/company/weblister-co" target="_blank" title="linkedin" class="text-decoration-none text-white  linkedin"><i class="bi bi-linkedin"></i></a></li>
	          	<li><a href="https://twitter.com/mutamuls" target="_blank" title="twitter" class="text-decoration-none text-white  twitter"><i class="bi bi-twitter" alt="twitter"></i></a></li>  
            </ul>
          </div>
        </div>
      </div>
</footer>
<style>
	.site-footer{
		background-color:#6499cd;
		padding:45px 0 20px;
		font-size:15px;
		line-height:24px;
		color:#fff;
	}
	.site-footer hr
	{
	border-top-color:#bbb;
	opacity:0.5
	}
	.site-footer hr.small
	{
	margin:20px 0
	}
	.site-footer h6
	{
	color:#fff;
	font-size:16px;
	text-transform:uppercase;
	margin-top:5px;
	letter-spacing:2px
	}
	.site-footer a
	{
	color:#fff;
	}
	.site-footer a:hover
	{
	color:#3366cc;
	text-decoration:none;
	}
	.footer-links
	{
	padding-left:0;
	list-style:none
	}
	.footer-links li
	{
	display:block
	}
	.footer-links a
	{
	color:#fff
	}
	.footer-links a:active,.footer-links a:focus,.footer-links a:hover
	{
	color:#3366cc;
	text-decoration:none;
	}
	.footer-links.inline li
	{
	display:inline-block
	}
	.site-footer .social-icons
	{
	text-align:right
	}
	.site-footer .social-icons a
	{
	width:40px;
	height:40px;
	line-height:40px;
	margin-left:6px;
	margin-right:0;
	border-radius:100%;
	background-color:#33353d
	}
	.copyright-text
	{
	margin:0
	}
	@media (max-width:991px)
	{
	.site-footer [class^=col-]
	{
	margin-bottom:30px
	}
	}
	@media (max-width:767px)
	{
	.site-footer
	{
	padding-bottom:0
	}
	.site-footer .copyright-text,.site-footer .social-icons
	{
	text-align:center
	}
	}
	.social-icons
	{
	padding-left:0;
	margin-bottom:0;
	list-style:none
	}
	.social-icons li
	{
	display:inline-block;
	margin-bottom:4px
	}
	.social-icons li.title
	{
	margin-right:15px;
	text-transform:uppercase;
	color:#96a2b2;
	font-weight:700;
	font-size:13px
	}
	.social-icons a{
	background-color:#eceeef;
	color:#818a91;
	font-size:16px;
	display:inline-block;
	line-height:44px;
	width:44px;
	height:44px;
	text-align:center;
	margin-right:8px;
	border-radius:100%;
	-webkit-transition:all .2s linear;
	-o-transition:all .2s linear;
	transition:all .2s linear
	}
	.social-icons a:active,.social-icons a:focus,.social-icons a:hover
	{
	color:#fff;
	background-color:#29aafe
	}
	.social-icons.size-sm a
	{
	line-height:34px;
	height:34px;
	width:34px;
	font-size:14px
	}
	.social-icons a.facebook:hover
	{
	background-color:#3b5998
	}
	.social-icons a.twitter:hover
	{
	background-color:#00aced
	}
	.social-icons a.linkedin:hover
	{
	background-color:#007bb6
	}
	.social-icons a.dribbble:hover
	{
	background-color:#ea4c89
	}
	@media (max-width:767px)
	{
	.social-icons li.title
	{
	display:block;
	margin-right:0;
	font-weight:600
	}
	}
</style>
<script type="text/javascript">
 //    (function(){
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
  	$(document).on("click", ".cookiesAgree", function(e){
      e.preventDefault();
      var cvalue = "newCookieBanner";
      var cname = "newCookieBanner";
        newCookieBannerSet(cname, cvalue);
        setTimeout(function(){
          $(".cookie-consent-banner").hide("slow");
          window.location = "./";
        }, 500);
      })
      function newCookieBannerSet(cname, cvalue) {
        event.preventDefault();    
        const d = new Date();
        d.setTime(d.getTime() + (30*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
    
    //Start of Tawk.to Script

    // var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    // (function(){
    // var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    // s1.async=true;
    // s1.src='https://embed.tawk.to/6213596ea34c245641274f7d/1fsdpamrm';
    // s1.charset='UTF-8';
    // s1.setAttribute('crossorigin','*');
    // s0.parentNode.insertBefore(s1,s0);
    // })();

    //End of Tawk.to Script-->
</script>	