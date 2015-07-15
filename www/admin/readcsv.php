<html>
<body>
<?php

$date = new DateTime();

if (date("D")=="Mon"){
$date->modify("-3 day");
}
else {
$date->modify("-1 day");
}

if ($date->format("H")<11) {
print "Время для просмотра изменений на коммутаторах еще не пришло. Попробуйте зайти снова после 11 часов.";
exit();
}



//Read all files in directory
$TrackDir=opendir("k:\\diff-".date('j-'.$date->format("d").'-m'.$date->format("m").'-Y'));
while ($file = readdir($TrackDir)) { 
      if ($file == "." || $file == "..") { } 
         elseif (stripos($file,"csv")==true) {
             //print "<tr><td><font face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=$file target=_blank>$file</a></font> </td>";
             //print "<td>  ".filetype($file)."</td></tr><br>";
             print "<h1> k:\\diff-".date('j-'.$date->format("d").'-m'.$date->format("m").'-Y')."\\".$file."</h1><br>";
             // Open the CSV file

             $fh = fopen("k:\\diff-".date('j-'.$date->format("d").'-m'.$date->format("m").'-Y')."\\".$file,'rb');
             if (! $fh) {
                print "Error opening file.";
             } else {
             for ($info = fgetcsv($fh, 1024,","); ! feof($fh); $info = fgetcsv($fh, 1024)) {
                // $info[0] is the dish name    (the  first field in a line of dishes.csv)
                // $info[1] is the price        (the second field)
                // $info[2] is the spicy status (the  third field)
                // Insert a row into the database table
                //$db->query("INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?, ?, ?)",$info);
                //print "Inserted $info[0]\n";
                print $info[0]."<br>";
             }
             // Close the file
             fclose($fh);
             }

          }
     } 

//Close dir by
closedir($TrackDir);
?>
</body>
</html>
