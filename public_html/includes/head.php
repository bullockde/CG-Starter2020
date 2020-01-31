<head>  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width" />
  <title><?php echo $admin_name ?> v<?php echo $admin_ver; ?> - Home</title>
  <meta name="description" content="<?php echo $admin_name ?> v<?php echo $admin_ver; ?>" />
  <meta name="author" content="Oscuro Designs" />
  <link rel='canonical' href='<?php echo $site_base; ?>' />
  <link rel="shortcut icon" href="favicons/favicon.ico"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://cdn.rawgit.com/bootstrap-wysiwyg/bootstrap3-wysiwyg/master/src/bootstrap3-wysihtml5.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <style>
    .event { position: relative; width: 100%; height: 100%; padding-bottom: 20px; display: inline-block; }
    .event-info, .event-image { position: relative; display: block; }
    .event-info { height: 100%; float: left; width: 44%; }
    .event-image { float: right; width: 56%; }
    .event-image > img { height: 30%; width: 30%;}


:root {
  --main-bg-color: green;
  --main-txt-color: #000000; 
  --main-link-color: #000000; 
  --main-padding: 15px;

  --color-green: #01e801;
}

body, html {
  height: 100%;
  margin: 0;
}
a:hover, a{
  color: var(--main-link-color);
  text-decoration: none;
}
.bgimg {
  /*background-image: url('<?php echo $site_base; ?>/images/forestbridge.jpg');*/
  /*height: 100%;
  background-position: center;
  background-size: cover;
  background: #2b8ad6;*/
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 20px;
  width: 25%;
  margin: 8em auto;
  
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}
.bottomleft {
  position: absolute;
  left: 0;
  right: 16px;
}
.bottomright {
  position: absolute;
  bottom: 0;
  right: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.splash{
  text-align: center;
  /*margin: 10em 0;*/
}

hr {
  margin: auto;
  width: 40%;
}








*{
  padding:0;
  margin:0;
}
 
html{
  background-color: #eaf0f2;
}
 
body{
  font:16px/1.6 Arial,  sans-serif;
}
 
header{
  text-align: center;
  padding-top: 100px;
  margin-bottom:190px;
}
 
header h1{
  font: normal 32px/1.5 'Open Sans', sans-serif;
  color: #3F71AE;
  padding-bottom: 16px;
}
 
header h2{
  color: #F05283;
}
 
header span{
  color: #3F71EA;
}
 
 
/* The footer is fixed to the bottom of the page */
 
footer{
  /*
  position: fixed;
  bottom: 0;
  */
}
 
@media (max-height:800px){
  footer { position: static; }
  header { padding-top:40px; }
}
 
 
.footer-distributed{
  background-color: #1e272d;
  font: bold 16px sans-serif;
  padding: 50px 50px 60px 50px;

}
 
/* Footer left */
 
.footer-distributed h3{
  color:  #ffffff;
  font: normal 36px 'Cookie', cursive;
  margin: 0;
}
 
/* The company logo */
 
.footer-distributed h3 span{
  color:  #2e88c8;
}
 
/* Footer links */
 
.footer-distributed .footer-links{
  color:  #ffffff;
  margin: 20px 0 12px;
}
 
.footer-distributed .footer-links a{
  display:inline-block;
  line-height: 1.8;
  text-decoration: none;
  color:  inherit;
}
 
.footer-distributed .footer-company-name{
  color:  #8f9296;
  font-size: 14px;
  font-weight: normal;
  margin: 0;
}
 
/* Footer Center */

.footer-distributed .footer-center i{
  background-color:  #33383b;
  color: #ffffff;
  font-size: 25px;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  text-align: center;
  line-height: 42px;
  margin: 10px 15px;
  vertical-align: middle;
}
 
.footer-distributed .footer-center i.fa-envelope{
  font-size: 17px;
  line-height: 38px;
}
 
.footer-distributed .footer-center p{
  display: inline-block;
  color: #ffffff;
  vertical-align: middle;
  margin:0;
}
 
.footer-distributed .footer-center p span{
  display:block;
  font-weight: normal;
  font-size:14px;
  line-height:2;
}
 
.footer-distributed .footer-center p a{
  color:  #2e88c8;
  text-decoration: none;;
}
 
 
/* Footer Right */

.footer-distributed .footer-company-about{
  line-height: 20px;
  color:  #92999f;
  font-size: 13px;
  font-weight: normal;
}
 
.footer-distributed .footer-company-about span{
  display: block;
  color:  #ffffff;
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 20px;
}
 
.footer-distributed .footer-icons{
  margin-top: 25px;
}
 
.footer-distributed .footer-icons a{
  display: inline-block;
  width: 35px;
  height: 35px;
  background-color:  #33383b;
  border-radius: 2px;
  font-size: 20px;
  color: #ffffff;
  text-align: center;
  line-height: 35px;

}

/* Here is the code for Responsive Footer */
/* You can remove below code if you don't want Footer to be responsive */
 
 
@media (max-width: 991px) {
 
  .footer-distributed .footer-left1,
  .footer-distributed .footer-center1,
  .footer-distributed .footer-right1{
    display: block;
    width: 100%;
    margin-bottom: 40px;
    text-align: center;
  }
 
  .footer-distributed .footer-center1 i{
    margin-left: 0;
  }
 
}


</style>
</head>