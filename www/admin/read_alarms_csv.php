<html>
<body>
<?php
//берем в переменную текущую дату
$date = new DateTime();

//Read all files in directory
$TrackDir=opendir("c:\\work");
$file="c:\\work\\alarms.csv";
print "<h1>".$file."</h1><br>";
$default_value=0;
$default_value1="U";

//Connect to oracle
if ($c=OCILogon("system", "manager","msknckpidwh","WE8ISO8859P15")) {
   $strout = "msknckpidwh connection=OK </br>";
   $stid = oci_parse($c, "DELETE FROM QIDW.ALARMS_INFO");
   $retval=OCIExecute($stid,OCI_COMMIT_ON_SUCCESS);
   OCICommit($c);
   OCIFreeStatement($stid);
   if ($retval==1) {
      print "qidw.alrms_info was deleted sucsessfull.</br>";
   } else {
      print "qidw.alrms_info was deleted broken.</br>";
   } 
   $stmt = OCIParse($c, "INSERT INTO QIDW.ALARMS_INFO (ACR1,ACR2,\"TRANSIT OPERATOR\",\"DESTINATION OPERATOR\",COUNTRY,\"PREFIX TYPE\",\"ALARM TYPE\",TIME1,TIME2,INSTANCE,\"INSTANCE DESCRIPTION\",INSERT_DATE) VALUES (TO_NUMBER(:acr1),TO_NUMBER(:acr2),:transit_operator,:destination_operator,:country,:prefix_type,:alarm_type,TO_DATE('01-01-1970 '||:time1,'DD-MM-YYYY HH24:MI'),TO_DATE('01-01-1970 '||:time2,'DD-MM-YYYY HH24:MI'),TO_NUMBER(:instance),:instance_description,TO_DATE(:insert_date,'DD-MM-YYYY HH24:MI'))");   
   // Open the CSV file
   $fh = fopen($file,'rb');
   if (! $fh) {
      print "Error opening file.";
   } else {
           For ($info = fgetcsv($fh, 1024,";"); ! feof($fh); $info = fgetcsv($fh, 1024,";")) {

           // Insert a row into the database table

           If (!empty($info[0])) {
              OCIBindByName($stmt, ":acr1", $info[0],10);
           }
           else {
              OCIBindByName($stmt, ":acr1",$default_value,10);
           }
           If (!empty($info[1])) {
              OCIBindByName($stmt, ":acr2", $info[1],10);
           }
           else {
              OCIBindByName($stmt, ":acr2",$default_value,10);
           }
           OCIBindByName($stmt, ":transit_operator", $info[2],255);            
           If (!empty($info[3])) {
              OCIBindByName($stmt, ":destination_operator",$info[3],255);
           }
           else {
              OCIBindByName($stmt, ":destination_operator",$default_value1,255);
           }
           OCIBindByName($stmt, ":country", $info[4],255);
           If (!empty($info[5])) {
              OCIBindByName($stmt, ":prefix_type", $info[5],1);
           }
           else { 
              OCIBindByName($stmt, ":prefix_type",$default_value1,1);
           }
           OCIBindByName($stmt, ":alarm_type", $info[6],50);
           OCIBindByName($stmt, ":time1", $info[7],5);
           OCIBindByName($stmt, ":time2", $info[8],5);
           OCIBindByName($stmt, ":instance", $info[9],10);
           OCIBindByName($stmt, ":instance_description", $info[10],100);
           OCIBindByName($stmt, ":insert_date", date("d-m-Y H:i"));
           $retval=OCIExecute($stmt,OCI_COMMIT_ON_SUCCESS);
           if ($retval==1) {
              print "qidw.alrms_info was added sucsessfull.</br>";
           } else {
              print "qidw.alrms_info was added broken.</br>";
           }
           print "$stmt<br>";
           print $info[0]." ".$info[1]." ".$info[2]." ".$info[3]." ".$info[4]." ".$info[5]." ".$info[6]." ".$info[7]." ".$info[8]." ".$info[9]." ".$info[10].date("d-m-Y H:i")."<br>";
   }
     // Close the file
     fclose($fh);
   }
   OCIFreeStatement($stmt);
   OCICommit($c); 
   OCILogoff($c);    
} else {
   $err = OCIError();
   $strout = "msknckpidwh connection=Error $err[text] </br>";
   OCILogoff($c);
}
print $strout;
?>
</body>
</html>
