<?php
$relative = "";
include $relative . "../src/crutchphp/config.php";
$link = mysqli_connect($DB_MYSQL["host"], $DB_MYSQL["user"], $DB_MYSQL["pass"], $DB_MYSQL["database"]) or die("Database Error: Invalid Username or Password ");



$query="SELECT * FROM customers WHERE id='".$_GET['client_ID']."';";
   	$result=mysqli_query( $link,$query);

    $row=mysqli_fetch_row($result);
    $name = $row['name'];



                  $color1 = "";
                  $color2 = "";
                  $color3 = "";
                  $headertext = "";
                  $subheadertext = "";
                  $bodytext = "";
                  $question = "";
                  $yesbutton = "";
                  $nobutton = "";
                  $tagline = "";

?>
<h1>Email Dashboard</h1>

<div class="dashboard card bg-light">
  <div class="card-body">
    Choose from the options below:
    <form src="?" method="GET">
    	<!--<select name="Lang">
    		<option value="0">Lang</option>
    		<option value="en">English</option>
    		<option value="sp">Spanish</option>
    	</select>
        -->

    	<?php
    	    if( $_SESSION[admin] ) {
                $query="SELECT * FROM customers WHERE id = ".$_SESSION[client_ID].";";
            
            }else{
                
                $query="SELECT * FROM customers";
            }
    	      
    	      $result= mysqli_query( $link,$query);
    	     
    	      echo "<select id='client_select' name='client_ID' class='form-control'>";
    	        echo "<option value='0'>Select Client</option>";
    	      while ($row=mysqli_fetch_array($result)) {
    	        echo "<option value='".$row[id]."'>".$row[name]." (".$row[email].")</option>";
    	      }
    	      echo "</select>";
    	    ?>

    	<?php
    	    if( $_SESSION[admin] ) {
    	          // $query="SELECT * FROM Templates WHERE CompanyID = ".$_SESSION[CompanyID].";";

    	          $query="SELECT * FROM Templates";
    	      }else{
    	          
    	          $query="SELECT * FROM Templates";
    	      }
    	      
    	      $result= mysqli_query( $link,$query);
    	     
    	      echo "<select id='template_select' name='TemplateID' class='form-control'>";
    	        echo "<option value='0'>Select Template</option>";
    	      while ($row=mysqli_fetch_array($result)) {
    	        echo "<option value='".$row[ID]."'>".$row[TemplateName]."</option>";
    	      }
    	      echo "</select>";
    	    ?>

    	<select id="type_select" name="FormType" class="form-control">
    		<option value="0">Form Type</option>
    		<option value="std">Standard</option>
    		<option value="safe">Safe Form</option>
    	</select>

      <?php
        $query4="SELECT * FROM Forms";
         
          
          $result4= mysqli_query( $link,$query4);
         
          echo "<select id='template_select' name='FormID' class='form-control'>";
            echo "<option value='0'>Feedback Form</option>";
          while ($row4=mysqli_fetch_array($result4)) {
            echo "<option value='".$row4[ID]."'>".$row4[Name]."</option>";
          }
          echo "</select>";
        ?>

    	<select name="cus_sendemail">
    		<option value="0">Generate</option>
    		<option value="0">Edit</option>
    		<option value="1">Send</option>
    	</select>


    	<input type="submit" class="btn btn-primary" value="Submit">
    </form>
  </div>
</div>
<br>
<?php

$query="SELECT * FROM Templates WHERE ID = '$_GET[TemplateID]'";
   	$result=mysqli_query( $link,$query);
    while($row=@mysqli_fetch_array($result)) {

      
      
        $id=$row[ID];
        $logo="";
        /***********************************************************************************/
        $color1="";
        $color2="";
        $color3="";
        $headertext="";
        $subheadertext="";
        $bodytext="";

           
        $query2="SELECT Logo FROM Companies WHERE CompanyID='".$row[CompanyID]."';";
        $result2=mysqli_query( $link,$query2);
        while($row2=@mysqli_fetch_array($result2)) { $logo=$row2[Logo]; }
    }



 $query3="SELECT * FROM Templates WHERE ID = '$_GET[TemplateID]'";
  $result3=mysqli_query( $link, $query3 );
  
  while($row3=@mysqli_fetch_assoc($result3)) {

      
              
      $color1 = $row3["Color1"];
      $color2 = $row3["Color2"];
      $color3 = $row3["Color3"];
      $headertext = $row3["Header"];
      $subheadertext = $row3["Subheader"];
      $bodytext = $row3["Body"];
      $question = $row3["Question"];
      $yesbutton = $row3["YesButton"];
      $nobutton = $row3["NoButton"];
      $tagline = $row3["Tagline"];


      $query4="SELECT * FROM customers WHERE id='".$_GET[client_ID]."';";
          $result4=mysqli_query( $link,$query4);
          while($row4=@mysqli_fetch_array($result2)) { $name=$row4[name]; }
    
  }




if ( !empty( $_GET ) ) {
  /*$emailcontent=generateEmail($name,$client_ID,$logo,$color1,$color2,$color3,$headertext,$subheadertext,$bodytext); */

  $emailcontent=generateEmail($name,$color1,$color2,$color3,$headertext,$subheadertext,$bodytext);

  print_r($emailcontent);
}
/*
foreach( $_GET as $key => $value ){

	echo $key . ' = ' . $value;

	echo "<br>";

}
*/
$emailsubject="We want your feedback!";
  $headers="Content-type: text/html; charset=iso-8859-1\r\n";
  
  /*function generateEmail($name,$client_ID,$logo,$color1,$color2,$color3,$header,$subheader,$body) {*/
    function generateEmail($name,$color1,$color2,$color3,$header,$subheader,$body) {
      $greeting = "Dear";
      $form = "Y";

      if( $_GET[FormType] == 'std' ){

      	$form = "Yes";

      }
      if( $_GET[FormType] == 'safe' ){

      	$form = "Y";

      }
      if( !empty( $_GET[FormID] ) ){

        $formID = $_GET[FormID];

      }

      
      	
      $query6="SELECT * FROM Templates WHERE ID = '$_GET[TemplateID]'";

                $result6=mysqli_query( $link, $query6);
                
                while($row6=@mysqli_fetch_array($result6)) {
                            
                 
                  
                  
                  $color1 = $row6['Color1'];
                  $color2 = $row6['Color2'];
                  $color3 = $row6['Color3'];
                  $headertext = $row6['Header'];
                  $subheadertext = $row6['Subheader'];
                  $bodytext = $row6['Body'];
                  $question = $row6['Question'];
                  $yesbutton = $row6['YesButton'];
                  $nobutton = $row6['NoButton'];
                  $tagline = $row6['Tagline'];
                
              }


     
      echo "<br>C1 - " . $color1;
      echo "<br>C2 - " . $color2;
      echo "<br>C3 - " . $color3;
      echo "<br>Header - " . $headertext;
      echo "<br>Subheader - " . $subheadertext;
      echo "<br>Body - " . $bodytext;
      echo "<br>Question - " . $question;
      echo "<br>YesButton - " . $yesbutton;
      echo "<br>NoButton - " . $nobutton;
      echo "<br>Tagline - " . $tagline;
     


    return "
<!doctype html>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:Adding Customer
v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head>
    <!--[if gte mso 15]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Welcome To The Philly Reviews</title>
    
  <style type='text/css'>
    p{
      margin:10px 0;
      padding:0;
      color:".$color3.";
    }
    table{
      border-collapse:collapse;
      color:".$color3." !important;
    }
    h1,h2,h3,h4,h5,h6{
      display:block;
      margin:0;
      padding:0;
      color:".$color3.";
    }
    img,a img{
      border:0;
      height:auto;
      outline:none;
      text-decoration:none;
    }
    body,#bodyTable,#bodyCell{
      height:100%;
      margin:0;
      padding:0;
      width:100%;
      color:".$color3.";

      font-family:Helvetica;
    }
    .mcnPreviewText{
      display:none !important;
    }
    #outlook a{
      padding:0;
    }
    img{
      -ms-interpolation-mode:bicubic;
    }
    table{
      mso-table-lspace:0pt;
      mso-table-rspace:0pt;
    }
    .ReadMsgBody{
      width:100%;
    }
    .ExternalClass{
      width:100%;
    }
    p,a,li,td,blockquote{
      mso-line-height-rule:exactly;
    }
    a[href^=tel],a[href^=sms]{
      color:inherit;
      cursor:default;
      text-decoration:none;
    }
    p,a,li,td,body,table,blockquote{
      -ms-text-size-adjust:100%;
      -webkit-text-size-adjust:100%;
    }
    .ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
      line-height:100%;
    }
    a[x-apple-data-detectors]{
      color:inherit !important;
      text-decoration:none !important;
      font-size:inherit !important;
      font-family:inherit !important;
      font-weight:inherit !important;
      line-height:inherit !important;
    }
    a.mcnButton{
      display:block;
    }
    .mcnImage,.mcnRetinaImage{
      vertical-align:bottom;
    }
    .mcnTextContent{
      word-break:break-word;
    }
    .mcnTextContent img{
      height:auto !important;
    }
    .mcnDividerBlock{
      table-layout:fixed !important;
    }
    #templatePreheader,#templateHeader,#templateBody,#templateFooter{
      padding-right:5px;
      padding-left:5px;
    }
    .templateContainer{
      max-width:600px;
    }
    #bodyCell{
      border-top:0;
    }
    #lowerBody{
      background-color:#697529;
    }
    h1{
      color:".$color3.";
      display:block;
      font-family:Helvetica;
      font-size:26px;
      font-style:normal;
      font-weight:bold;
      line-height:150%;
      letter-spacing:normal;
      text-align:left;
    }
    h2{
      color:".$color3.";
      display:block;
      font-family:Helvetica;
      font-size:20px;
      font-style:normal;
      font-weight:bold;
      line-height:150%;
      letter-spacing:normal;
      text-align:left;
    }
    h3{
      color:#990000;
      display:block;
      font-family:Georgia;
      font-size:20px;
      font-style:normal;
      font-weight:normal;
      line-height:125%;
      letter-spacing:normal;
      text-align:left;
    }
    h4{
      color:#808080;
      display:block;
      font-family:Helvetica;
      font-size:12px;
      font-style:normal;
      font-weight:bold;
      line-height:125%;
      letter-spacing:normal;
      text-align:left;
    }
    #templatePreheader{
      background-color:".$color2.";
      border-top:0;
      border-bottom:0;
    }
    .preheaderContainer .mcnTextContent,.preheaderContainer .mcnTextContent p{
      color:#404040;
      font-family:Helvetica;
      font-size:10px;
      line-height:125%;
      text-align:left;
    }
    .preheaderContainer .mcnTextContent a{
      color:#202020;
      font-weight:normal;
      text-decoration:underline;
    }
    #templateHeader{
      border-top:0;
      border-bottom:0;
    }
    .bodyContainer{
      background-color:#FFFFFF;
      border-top:0;
      border-bottom:0;
    }
    .bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{
      color:#505050;
      font-family:Helvetica;
      font-size:17px;
      line-height:150%;
      text-align:left;
    }
    .bodyContainer .mcnTextContent a{
      color:#990000;
      font-weight:normal;
      text-decoration:underline;
    }
    #templateFooter{
      background-color:#FFFFFF;
      border-top:0;
    }
    .footerContainer{
      padding-bottom:40px;
    }
    .footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{
      color:#808080;
      font-family:Helvetica;
      font-size:10px;
      line-height:150%;
      text-align:center;
    }
    .footerContainer .mcnTextContent a{
      color:#606060;
      font-weight:normal;
      text-decoration:underline;
    }
  @media screen and (min-width:768px){
    .templateContainer{
      width:600px !important;
    }

} @media only screen and (max-width: 480px){
    body,table,td,p,a,li,blockquote{
      -webkit-text-size-adjust:none !important;
    }

} @media only screen and (max-width: 480px){
    body{
      width:100% !important;
      min-width:100% !important;
    }

} @media only screen and (max-width: 480px){
    .templateContainer{
      max-width:600px !important;
      width:100% !important;
    }

} @media only screen and (max-width: 480px){
    .mcnRetinaImage{
      max-width:100% !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImage{
      width:100% !important;
    }

} @media only screen and (max-width: 480px){
    .mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer,.mcnImageCardLeftImageContentContainer,.mcnImageCardRightImageContentContainer{
      max-width:100% !important;
      width:100% !important;
    }

} @media only screen and (max-width: 480px){
    .mcnBoxedTextContentContainer{
      min-width:100% !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImageGroupContent{
      padding:9px !important;
    }

} @media only screen and (max-width: 480px){
    .mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
      padding-top:9px !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImageCardTopImageContent,.mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
      padding-top:18px !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImageCardBottomImageContent{
      padding-bottom:9px !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImageGroupBlockInner{
      padding-top:0 !important;
      padding-bottom:0 !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImageGroupBlockOuter{
      padding-top:9px !important;
      padding-bottom:9px !important;
    }

} @media only screen and (max-width: 480px){
    .mcnTextContent,.mcnBoxedTextContentColumn{
      padding-right:18px !important;
      padding-left:18px !important;
    }

} @media only screen and (max-width: 480px){
    .mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
      padding-right:18px !important;
      padding-bottom:0 !important;
      padding-left:18px !important;
    }

} @media only screen and (max-width: 480px){
    .mcpreview-image-uploader{
      display:none !important;
      width:100% !important;
    }

} @media only screen and (max-width: 480px){
    h1{
      font-size:24px !important;
      line-height:125% !important;
    }

} @media only screen and (max-width: 480px){
    h2{
      font-size:20px !important;
      line-height:125% !important;
    }

} @media only screen and (max-width: 480px){
    h3{
      font-size:18px !important;
      line-height:125% !important;
    }

} @media only screen and (max-width: 480px){
    h4{
      font-size:16px !important;
      line-height:125% !important;
    }

} @media only screen and (max-width: 480px){
    .mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
      font-size:18px !important;
      line-height:125% !important;
    }

} @media only screen and (max-width: 480px){
    #templatePreheader{
      display:block !important;
    }

} @media only screen and (max-width: 480px){
    .preheaderContainer .mcnTextContent,.preheaderContainer .mcnTextContent p{
      font-size:14px !important;
      line-height:115% !important;
    }

} @media only screen and (max-width: 480px){
    .bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{
      font-size:18px !important;
      line-height:125% !important;
    }

} @media only screen and (max-width: 480px){
    .footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{
      font-size:14px !important;
      line-height:115% !important;
    }

}
fieldset a{
    padding: 15px;
    margin: 5px;
    border: 1px solid;

}

</style></head>
  <body style='height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
     <!--*|IF:MC_PREVIEW_TEXT|*-->
        <!--[if !gte mso 9]><!----><span class='mcnPreviewText' style='display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;'>*|KEEPING OUR CLIENTS SATISFIED|*</span><!--<![endif]-->
        <!--*|END:IF|*-->

    <div class='well'>
    <center>
    <table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;'>
        <tr>
          <td align='center' valign='top' id='bodyCell' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;border-top: 0;'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: ".$color1.";'>
                <tr>
                    <td align='center' valign='top' id='templatePreheader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;padding-right: 5px;padding-left: 5px;background-color:".$color2.";border-top: 0;border-bottom: 0;'>
                        <!-- BEGIN PREHEADER // -->
                        <br><br>
                        <!-- // END PREHEADER -->
                    </td>
                </tr>

                <tr>
                    <td align='center' valign='top' id='templateHeader' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;padding-right: 5px;padding-left: 5px;border-top: 0;border-bottom: 0;'>
                        <!-- BEGIN HEADER // -->
                          <!--[if gte mso 9]>
                          <table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
                          <tr>
                          <td align='center' valign='top'>
                          <![endif]-->
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px;'>
                                <tr>
                                    <td valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <br /><br /><br />
                                    </td>
                                </tr>
                            </table>
                          <!--[if gte mso 9]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        <!-- // END HEADER -->
                    </td>
                </tr>
                
                <tr>
                    <td align='center' valign='top' id='templateBody' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;padding-right: 5px;padding-left: 5px;'>
                        <!-- BEGIN BODY // -->
                          <!--[if gte mso 9]>
                          <table align='center' border='0' cellspacing='0' cellpadding='0' width='600'>
                          <tr>
                          <td align='center' valign='top'>
                          <![endif]-->
                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px;'>
                                  <tr>
                                      <td align='center' bgcolor='#FFFFFF' valign='top' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <table border='0' cellpadding='0' cellspacing='0' width='90%' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <tr>
                                              <td valign='top' class='bodyContainer' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;'><table border='0' cellpadding='0' cellspacing='0' width='100%' class='mcnImageBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <tbody class='mcnImageBlockOuter'>
                                                    <tr>
                                                        <td valign='top' style='padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' class='mcnImageBlockInner'>
                                                            <table align='left' width='100%' border='0' cellpadding='0' cellspacing='0' class='mcnImageContentContainer' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class='mcnImageContent' valign='top' style='padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                                            
                                                                            <img src='".$logo."'>
                                            
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <tbody class='mcnTextBlockOuter'>
                                                    <tr>
                                                        <td valign='top' class='mcnTextBlockInner' style='padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            
                                                            <table align='center'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>

                                                                            <h1 style='text-align: center;'>".$headertext."</h1>
                            
                                                                            <h2 style='text-align: center;'>".$subheadertext."</h2>
                                                							
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table border='0' cellpadding='0' cellspacing='0' width='100%' class='mcnTextBlock' style='min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <tbody class='mcnTextBlockOuter'>
                                                    <tr>
                                                        <td valign='top' class='mcnTextBlockInner' style='padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                            <!--[if mso]>
                                                            <table align='left' border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%;'>
                                                            <tr>
                                                            <![endif]-->
                                                              
                                                            <!--[if mso]>
                                                            <td valign='top' width='540' style='width:540px;'>
                                                            <![endif]-->
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;' width='100%' class='mcnTextContentContainer'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='mcnTextContent' style='padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: ".$color3.";font-family: Helvetica;font-size: 17px;line-height: 150%;text-align: left;'>
                                                                            
                                                                            	<br>

                                                                                ".$greeting." ".$name.",
                                                                                
                                                                                <br><br>
                                                                                ".$bodytext."<br>
                                                                                <br>
                                                                                <strong><span style='font-size:18px'>".$question."</span></strong>
                                                                
                                                                                <br><br>
                                                                                
                                                                                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style='background: none; height: 1px; margin: 0;'>
                                                                                            
                                                                                                <table align='center' cellpadding='0' cellspacing='0' height='50'  style='margin: 0 auto; mso-hide:all;'>
                                                                                                  <tbody>
                                                                                                    <tr>
                                                                                                      <td align='center' bgcolor='#ed7014' height='50' style='float: left; margin: 5px; vertical-align:middle;color: #ffffff; display: block;background-color:#bb0000;mso-hide:all;' width='225'>
                                                                                                        <a class='cta_button' href='http://thephillyreviews.com/?JobID=".$jobid."&ans=N' style='font-size:16px;-webkit-text-size-adjust:none; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:50px; width:250px; display:inline;' title='Button'>
                                                                                                          <span style='color:#ffffff'>".$nobutton."</span>
                                                                                                        </a>
                                                                                                      </td>
                                                                            
                                                                                                    </tr>
                                                                                                  </tbody>
                                                                                                </table>
                                                                                            
                                                                                            </td>
                                                                                            <td style='background: none; height: 1px;  margin: 0;'>
                                                                              
                                                                                                <table align='center' cellpadding='0' cellspacing='0' height='50' style='margin: 0 auto; mso-hide:all;'>
                                                                                                  <tbody>
                                                                                                    <tr>
                                                                                                      <td align='center' bgcolor='#ed7014' height='50' style='float: left; margin: 5px; vertical-align:middle;color: #ffffff; display: block;background-color:#209424;mso-hide:all;' width='225'>
                                                                                                        <a class='cta_button' href='http://legal-reviews.com/?JobID=".$jobid."&ans=".$form."&FormID=".$formID."' style='font-size:16px;-webkit-text-size-adjust:none; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:50px; width:250px; display:inline;' title='Button'>
                                                                                                          <span style='color:#ffffff'>".$yesbutton." &rarr;</span>
                                                                                                        </a>
                                                                                                      </td>
                                                                            
                                                                                                    </tr>
                                                                                                  </tbody>
                                                                                                </table>
                                                                        
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                
                                                                                <br>
                                                                                    
                                                                                <center>
                                                                                    <span style='font-size:14px; text-align: center;'><strong>".$tagline."</strong></span>
                                                                                </center>
                                                                    
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            <!--[if mso]>
                                                            </td>
                                                            <![endif]-->
                                                                    
                                                            <!--[if mso]>
                                                            </tr>
                                                            </table>
                                                            <![endif]-->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                      </td>
                                    </tr>
                                </table>
                            </td>
                        </tr> 
                         
                        <tr>
                            <td align='center' valign='bottom'>
                                <br /><br /><br />
                            </td>
                        </tr>
                    </table>
                  <!--[if gte mso 9]>
                  </td>
                  </tr>
                  </table>
                  <![endif]-->
                    <!-- // END BODY -->
                </td>
            </tr>

            
            </table>
            <table border='0' cellpadding='0' cellspacing='0' width='100%' id='lowerBody' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #d3cfc6;'>
            	<tr>
                    <td align='center' valign='top' id='templateFooter' style='mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;padding-right: 5px;padding-left: 5px;background-color:".$color2.";border-top: 0;border-bottom: 0;'>
                        <!-- BEGIN FOOTER // -->
                        <br><br>
                        <!-- // END FOOTER -->
                    </td>
                </tr>
                
     
            </table>
          </td>
        </tr>
      </table>
    </center>
    </div>
  </body>
</html>";




  }




if(!empty($_GET['cus_sendemail'])){

    $query="SELECT * FROM customers WHERE id='".$_GET['cientID']."';";
    $result=mysqli_query( $link,$query);
    while($row=@mysqli_fetch_array($result)) {

      $name=$row[Name];
      $jobid=$row[JobID];
      $logo="";

    
      $query2="SELECT Logo FROM Companies WHERE CompanyID='".$row[CompanyID]."';";
      $result2=mysqli_query( $link,$query2);
      while($row2=@mysqli_fetch_array($result2)) { $logo=$row2[Logo]; }
      $emailcontent=generateEmail($name,$color1,$color2,$color3,$headertext,$subheadertext,$bodytext);
      
      //$from = "The Philly Reviews";
      //$headers .= 'From: ' . $from . "\r\n";

      mail($row[Email],$emailsubject,$emailcontent,$headers, '-f feedback@legal-reviews.com -F "Legal Reviews"');
      echo "Sent email to '".$row[Email]."'! <br> ";
      echo "<a href='?customer=1'  class='btn btn-secondary'>Restart page</a>";
      
      
      //print_r($emailcontent);
      
      $query="UPDATE Customers SET EmailSent='".( $email_sent + 1 )."'
                WHERE ID='".$row[ID]."';";
                mysqli_query( $link,$query);
    
    }
  }

?>
<script>

	$(document).ready(function() {
	  // Construct URL object using current browser URL
	  var url = new URL(document.location);

	  // Get query parameters object
	  var params = url.searchParams;

	  // Get value of delivery results
	  var JobID = params.get("client_ID");
	  var TemplateID = params.get("TemplateID");
	  var FormType = params.get("FormType");

	  // Set it as the dropdown value
	  if( JobID ) { $("#client_select").val(JobID); }
	  if( TemplateID ) { $("#template_select").val(TemplateID); }
	  if( FormType ) { $("#type_select").val(FormType); }
	});
</script>
