<?php
if($_POST["submit"]=="query") 
{
    $recipient="salahghannouch@gmail.com";
    $subject="Query from bookstore Bibliothéque | Lycée Prince Moulay Rachid";
    $sender=$_POST['sender'];
    $senderEmail=$_POST["senderEmail"];
    $message=$_POST["message"];
    $mailBody="Name: $sender\nEmail: $senderEmail\n\n$message";
    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

    $resSub = "Confirmation of receiving your query";
    $resBody= "Dear ". $sender ."\n\nThanks for reaching us.\nThis is to inform you that we have received your query. We will get back to you asap.";
    $note="\n\nNote : This is an auto-generated mail do not reply to this.\nFrom: https://covid2019-api.herokuapp.com/v2/total";
    $resBody=$resBody . $note;
    mail($senderEmail , $resSub , $resBody);   
    header("location: index.php?response="."Votre message a été envoyé avec succès! Notre responsable client répondrait sous peu."); 
}
?>	