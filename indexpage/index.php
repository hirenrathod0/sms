
  <!--session_start();
    include_once('config.php');
	  $user="";
  if(isset($_SESSION["sess_user"]))
  {
    $user=$_SESSION["sess_user"];
  }
  else
  {
	  header("location:index.php");
  }
-->
 
<html>
	<head>
	<title>index</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap-theme.min.css">
<link href="bootstrap-toggle-bootstrap-toggle.min.css" rel="stylesheet">
<script src="bootstrap-toggle-bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="bootstrap.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>
<script type="text/javascript" src="npm.js"></script>
	
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
	$(function() {
  
  /* LOCAL STORAGE START */
  // To reset your local storage
  localStorage.removeItem('learnMenu');
  
  //check if menu-pulses are required
  function checkMenuPulseState() {
    if(localStorage.getItem('learnMenu') == 'learned') {
      var $menuPulse = $('.menu-pulse');
      $menuPulse.addClass('is-learned');
    }
  }
  checkMenuPulseState();
  /* LOCAL STORAGE END */
  
  
  $(".menu-link").click(function(e) {
    e.preventDefault();
    
    /* LOCAL STORAGE START */
    localStorage.setItem('learnMenu', 'learned');
    checkMenuPulseState();
    /* LOCAL STORAGE END */
    
    $(".menu-overlay").toggleClass("menu-open");
    $(".menu-toggle").toggleClass("menu-open");
  });
});

	</script>
		<style>
		body {
  margin: 0;
  padding: 0;
  background: #320d7f;
  font-family: Arial, sans-serif;
  color: #fff;
  overflow: hidden;
  cursor:pointer;
}

/* ------  Menu Button ------- */

.menu-toggle {
  position: absolute;
  width: 72px;
  height: 72px;
  top: 12px;
  left: 50%;
  margin-left: -36px;
}

.menu-link {
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: 1010;
}

.menu-logo{
  width: inherit;
  height: inherit;
  margin-top: 14px;
  margin-left: 1px;
  text-align: center;
  position: absolute;
  opacity: 1;
  transition: all 400ms ease;
  fill: white;
}

.menu-open .menu-logo{
  fill: white;
}

.menu-icon {
  position: absolute;
  width: 20px;
  height: 14px;
  margin: auto;
  left: 0;
  top: 0;
  right: 0;
  bottom: 1px;
}

/* ------  Menu Line ------- */

.menu-line {
  background-color: white;
  height: 2px;
  width: 100%;
  border-radius: 0px;
  position: absolute;
  left: 0;
  opacity: 0;
  transition: all 200ms ease;
  z-index: 1000;
}

.menu-line-1 {
  top: -8px;
  margin: auto;
}
.menu-line-2 {
  top: 22px;
}

.menu-link:hover .menu-line-2 {
  opacity: 1;
  transform: translateY(-10px);
}

.menu-link:hover .menu-line-1 {
  opacity: 1;
  transform: translateY(10px);
}

.menu-link:hover .menu-logo {
  width: inherit;
  height: inherit;
  text-align: center;
  margin-top: 12px;
  opacity: 0;
  transform: scale(0.8);
  transition: all 400ms cubic-bezier(0.19, 1, 0.22, 1);
  transform: rotateY(60deg);
}

.menu-link:hover .menu-pulse, {
  border: none;
}

.menu-toggle.menu-open .menu-line-1 {
  transform: translateY(16px) translateY(-50%) rotate(-225deg);
}
.menu-toggle.menu-open .menu-line-2 {
  transform: translateY(-16px) translateY(50%) rotate(225deg);
}

/* ------ Menu Circle ------- */

.menu-circle {
  pointer-events: none;
  background-color: rgba(0, 0, 0, 0);
  border: 2px solid rgba(0, 0, 0, 0);
  width: 100%;
  height: 100%;
  left: -1px;
  bottom: -2px;
  position: absolute;
  border-radius: 50%;
  z-index: 800;
  opacity: 0.2;
  transform: scale(1);
  transition: all 200ms cubic-bezier(0.645, 0.045, 0.355, 1);
  -webkit-box-shadow: 0px 0px 32px 0px rgba(22,24,58,0.05);
  -moz-box-shadow: 0px 0px 32px 0px rgba(22,24,58,0.05);
  box-shadow: 0px 0px 32px 0px rgba(22,24,58,0.05);
}

.menu-pulse {
  border: 2px solid white;
  border-radius: 50%;
  position: absolute;
  display: block;  
  width: inherit;
  height: inherit;
  top: 50%;
  left: 50%;
  transform: translateX(-50%) translateY(-50%);
  box-sizing: content-box;
  opacity: 0;
  
  &.is-learned {
    visibility: hidden;
  }
} 

.first-pulse {
  animation: pulse-border 2000ms ease-out infinite;
}
.second-pulse {
  animation: pulse-border 2000ms 400ms ease-out infinite;
}

@keyframes pulse-border {
  0% {
    transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
    opacity: 0;
  }
  10% {
    opacity: 1;
  }
  50% {
    transform: translateX(-50%) translateY(-50%) translateZ(0) scale(2);
    opacity: 0;
  }
  100% {
    transform: translateX(-50%) translateY(-50%) translateZ(0) scale(2);
    opacity: 0;
    border-width: 1px;
  }
}

.menu-toggle:hover .menu-circle {
   background-color: #320d7f;
  border: 2px solid white;
  opacity: 1;
  transform: scale(0.8);
  transition: all 400ms cubic-bezier(0.19, 1, 0.22, 1);

  -webkit-box-shadow: 0px 0px 32px 0px rgba(22,24,58,0.1);
  -moz-box-shadow: 0px 0px 32px 0px rgba(22,24,58,0.1);
  box-shadow: 0px 0px 32px 0px rgba(22,24,58,0.1);
}

.menu-toggle.menu-open .menu-circle {
  transform: scale(25);
  transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1), opacity 800ms cubic-bezier(0.19, 1, 0.22, 1);
  opacity: 0;
}

/* ------ Menu Overlay ------- */
.menu-overlay {
 background-color:#320d7f;
  color: #333;
  height: 100%;
  width: 100%;
  position: fixed;
  text-align: center;
  transition: opacity 0.2s ease-in-out;
  z-index: 800;
  opacity: 0;
  visibility: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.menu-overlay.menu-open {
  opacity: 1;
  visibility: visible;
  left: 0px;
  top: 0;
}
	@import "compass/css3";

html, body{
  margin:0px; padding:0px;
}

*, *:after, *:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

header{
  z-index: 1;
  position:fixed; 
  width:100%; 
  height:60px; 
  background:rgba(0,0,0,0.1);
}

header a{
  color:white;
  background:rgba(0,0,0,0.1); 
  display:inline-block; 
  padding:0px 30px; 
  height:60px;
  line-height:60px; 
  text-align:center;
  font-family: 'Roboto Slab', serif; 
  text-decoration:none;
  text-transform:uppercase; 
  letter-spacing:2px; 
  font-weight:700;
}
#hero1{
 background:url("houseimage3.jpg");
  background-size:cover;
  background-position:center center;
  background-attachment:fixed;
  
}

.hero, .content{
  text-align:center; 
  position:relative;
  width: 100%;
}



.hero .inner{
  background: rgba(0,0,0,0.7) url(data:image/png;base64) repeat;
width:100%;
	height:100%;
	
	background-size:cover;
	
			  
  
  }


.copy{
  position:absolute; 
  top:50%; 
  height:10em; 
  margin-top:-5em; 
  width:100%;
}

.hero h1, .hero p{ 
  color:#fff;
}


h1{
  margin:0px;
  font-family: 'Roboto Slab', serif;
  font-weight:400;
  font-size:32px;
  padding:0px 20px;
}

p{
  font-family: 'Noto Sans', sans-serif; 
  font-size:14px;
  padding:0px 20px;
}
.menu1
{
font-family:Trebuchet MS;
font-size:30px;
color:white;
}.menu2
{
font-size:30px;
font-family:Trebuchet MS;
color:white;
}.menu3
{
font-size:30px;
font-family:Trebuchet MS;
color:white;
}
.menu1:hover
{
color:white;
text-decoration:underline;
}
.menu2:hover
{
color:white;
text-decoration:underline;
}
.menu3:hover
{
color:white;
text-decoration:underline;
}
.demo7 {
  
    position: absolute;
    width: 100%;
    height: 100%;
  }

 .demo7-ball {
    width: 50px;
    height: 50px;
    border-radius: 99px;
    position: absolute;
    border: 1px solid lightblue;
  }
  .logo
  {
	margin-top:-100px;
	margin-left:-10px;
  }
  .head
  {
	font-family:Algerian MS;font-size:62px;
  }
  .logoimg
  {
	width:200px;
	height:200px;
	
  }
@media only screen and (max-width: 500px) {
		
	.logo
  {
	margin-top:20px;
  }
  .head
  {
	font-family:Trebuchet MS;font-size:15px;
  }
  .logoimg
  {
	width:100px;
	height:100px;
	
  }
 
	
}
.headmsg
{
	font-size:25px;
	
}
.foot{
	position:absolute;
	
	
}

		</style>
	</head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="shortcut icon" type="image/x-icon" href="images/1.png" />

	<body>
	
	
	  <div class="menu-toggle">
		<a href="#" class="menu-link">
      
      <span class="menu-logo">
        <svg width="48px" height="48" viewBox="0 0 256 256">
          <path d="M128 183.7l-64-38.4V90.6l64 38.4 64-38.4v39.5l32 19.2V34.1l-96 57.6-96-57.6v129.3l96 57.6 76.7-46-31.1-18.7">
          </path>
        </svg>
      </span>
      
			<span class="menu-icon">
				<span class="menu-line menu-line-1"></span>
				<span class="menu-line menu-line-2"></span>
			</span>

      <span class="menu-circle">
        <span class="menu-pulse first-pulse"></span>
        <span class="menu-pulse second-pulse"></span>
      </span>
      
    </a>
  </div>

<div class="menu-overlay">
  <div class="overlay-content">
		<a href="login.php" target="_self" class="menu1">Login</a><br><br>
		
		<a href="facility.php" class="menu2"> Facility</a><br><br>
	<!--	<a href="http://localhost/NMC/client/GUI/index.html" class="menu2"> <-- Back to site</a><br><br>
		
		
			<a href="logout.php" class="menu3">LOG OUT</a>  
	-->
  </div>
  <div class="foot">
	<!--<h6>	<center><p class="createdby" style="color:cyan; margin-top:610px;; margin-left:-1000px">@<b CLASS="techpi"> &nbsp;TechPi's Creation</b>&nbsp;("techpi_29@gmail.com")</p></h6>-->
	<h6>	<!--<center><p class="createdby" style="color:cyan; margin-top:610px;; margin-left:-1000px">@<b CLASS="techpi"> &nbsp;TechPi's Creation</b>&nbsp;</p></h6>-->
	
		</div>

</div>
<section id="hero1" class="hero">
 <div id="content"></div>
  <script src="all.js"></script>
  <div class="inner">
    <div class="copy">
	
	<div class="logo">
	<img src="houseicon.png" class="logoimg"/>
	<!--<div class="foot">
	<!--<h6>	<center><p class="createdby" style="color:cyan; margin-top:-5px; margin-left:1000px">@<b CLASS="techpi"> &nbsp;TechPi's Creation</b>&nbsp;("techpi_29@gmail.com")</p></h6>-->
	
	<!--<h6>	<center><p class="createdby" style="color:cyan; margin-top:-5px; margin-left:1000px">@<b CLASS="techpi"> &nbsp;TechPi's Creation</b>&nbsp;</p></h6>
	
		</div>-->

    </div><br><br>
    <span class="head" ><b>Society&nbsp;Management&nbsp;System&nbsp; &nbsp;</b></span><br><br>
   <!-- <span class="head"><b></b></span><br><br>-->
    <span class="headmsg">"Unity is strength"</span>
	
	
    </div>
  </div>
  
  
</section>


	</body>
</html>