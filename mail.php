<?php 

if(isset($_POST['submit'])){
    $name = htmlspecialchars(stripslashes(trim($_POST['name'])));
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    $subject = htmlspecialchars(stripslashes(trim($_POST['subject'])));
    $message = htmlspecialchars(stripslashes(trim($_POST['message'])));
    
    $errorEmpty = false;
    $errorEmail = false;
    
    if(empty($name) || empty($email) || empty($message)) {
       echo "<span class='form-error'>Fill in all fields!</span>";  
        $errorEmpty = true;
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       echo "<span class='form-error'>Write a valid e-mail adress!</span>"; 
         $errorEmail = true;
    }
    else {
        $mailTo = "info@swannjulien.com";
        $header = "From: ".$email;
        $txt = "You have received an e-mail from ".$name.".\n\n".$message;
    
        mail($mailTo, $subject, $txt, $header);
        echo "<span class='form-succes'>Your email has been sent successfully, I will contact you soon!</span>"; 
    }
}

else { 
    echo "There was an error!";
}

?>



<script> 
    $("#mail-name, #mail-email, #mail-subject, #mail-message").removeClass("input-error");    
    
    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorEmail = "<?php echo $errorEmail; ?>";
    
    if (errorEmpty == true){
        $("#mail-name, #mail-email, #mail-subject, #mail-message").addClass("input-error");
    }
    if (errorEmail == true){
        $("#mail-email").addClass("input-error");     
    }
    if (errorEmpty == false && errorEmail == false){
        $("#mail-name, #mail-email, #mail-subject, #mail-message").val("");
    }
</script>
