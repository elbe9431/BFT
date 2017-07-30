<?php

 // THE BELOW LINE STATES THAT IF THE SUBMIT BUTTON
 // WAS PUSHED, EXECUTE THE PHP CODE BELOW TO SEND THE 
 // MAIL. IF THE BUTTON WAS NOT PRESSED, SKIP TO THE CODE
 // BELOW THE "else" STATEMENT (WHICH SHOWS THE FORM INSTEAD).
if ( isset ( $_POST [ 'buttonPressed' ] )){

 // REPLACE THE LINE BELOW WITH YOUR E-MAIL ADDRESS.
 $to = $_POST [ 'to' ] ;
 $subject = 'From PHP contact page' ;

 // NOT SUGGESTED TO CHANGE THESE VALUES
 $message = $_POST [ "message" ] ;
 $headers = 'From: ' . $_POST[ "from" ] . PHP_EOL ;
 mail ( $to, $subject, $message, $headers ) ;

 // THE TEXT IN QUOTES BELOW IS WHAT WILL BE 
 // DISPLAYED TO USERS AFTER SUBMITTING THE FORM.
 echo "Your e-mail has been sent! You should receive a reply within 24 hours!" ;}

 else{
 ?>
 <form method= "post" action= "../paartherapietest/<?php echo $_SERVER [ 'PHP_SELF' ] ;?>" />
   <table>
    <tr>
       <td>To: </td>
       <td><input name= "to" type= "text"/></td>
     </tr>
     <tr>
       <td>From: </td>
       <td><input name= "from" type= "text"/></td>
     </tr>
     <tr>
       <td>Your message: </td>
       <td><textarea name= "message" cols= "20" rows= "6"></textarea></td>
     </tr>
     <tr>
       <td></td>
       <td><input name= "buttonPressed" type= "submit" value= "Send E-mail!" /></td>
     </tr>
  </table>
 </form>

 <?php } ?>