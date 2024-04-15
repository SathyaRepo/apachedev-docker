<?php

$file_name = $_FILES['file']['name'];
$file = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];

include('/var/www/html/get_data_variable.php');

function fname2nr($f_name){
$f_nr=explode("_", $f_name);
$y=$f_nr[0];
$x=number_format($f_nr[0],0,"",""); 
return $x;
}
$vor_igate_id = fname2nr($file_name);
$file_log_dir = "/var/log/apache2";

$pattern1 = "/_ALL_/i";
$pattern2 = "/.bz2/i";
$pattern3 = "/.gz$/i";
$pattern4 = "/.gz/i";
$pattern5 = "/.csv/i";

$datum_heute = date('dmy');
$date_string = date('Y-m-d');
$tmp = "/data/pack";
if (!is_dir($tmp)) {
    mkdir($tmp, 0777);
}

if (!is_dir($tmp . "/" . $vor_igate_id)) {
    mkdir($tmp . "/" . $vor_igate_id, 0777);
}

$command = "echo \"" . date("Y-m-d_H-i-s") . " received file: >" . $file_name . "< id: " . $vor_igate_id . "\" >> " . $file_log_dir . "/incoming_data.log";
system($command);
if ($file_name == "" || is_null($file_name)) {
    $command = "echo \"No file_name size: ".$file_size." type:".$file_type."\" >> " . $file_log_dir . "/incoming_data.log";
    system($command);
    return;
}
$tmp_file = $tmp . "/" . $vor_igate_id . "/" . $file_name;

if ($vor_igate_id == 0) {
    echo "Originalname: " . $file_name;
    echo "case 1";
}elseif(preg_match($pattern1, $file_name)) { //TAR Test
    $command = "echo \"" . date("Y-m-d_H-i-s") . " received file: " . $file_name . "\" >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
    system($command);
    copy($file, $tmp_file);
    if (file_exists($tmp_file)) {
        print "Originalname: " . $file_name . "<br>";
        print "case 2";
        if (preg_match($pattern2, $file_name)) {
        print " unzipping... "; 

            $isExcluded = 0;
            foreach ($microgridlakeasia_one as $id1){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id1){
                $isExcluded=1;
                break;
              }
            }
            foreach ($smallutilitylakeasia as $id2){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id2){
                $isExcluded=2;
                break;
              }
            }
            foreach ($largeutilitylakeasia as $id3){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id3){
                $isExcluded=3;
                break;
              }
            }
            foreach ($microgridlakeafrica as $id4){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id4){
                $isExcluded=4;
                break;
              }
            }
            foreach ($microgridlakeamerica as $id5){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id5){
                $isExcluded=5;
                break;
              }
            }
            foreach ($ampluslakeasia as $id6){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id6){
                $isExcluded=6;
                break;
              }
            }
            foreach ($iplonlakeasia as $id7){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id7){
                $isExcluded=7;
                break;
              }
            }
            foreach ($arraymeter as $id8){
              if (substr( "".$vor_igate_id, 0, 8 ) === $id8){
                $isExcluded=8;
                break;
              }
            }
            foreach ($microgridlakeasia_two as $id9){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id9){
                $isExcluded=9;
                break;
              }
            }
            foreach ($microgridlakeasia_three as $id10){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id10){
                $isExcluded=10;
                break;
              }
            }
            foreach ($microgridlakeasia_four as $id11){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id11){
                $isExcluded=11;
                break;
              }
            }
            foreach ($microgridlakeasia_five as $id12){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id12){
                $isExcluded=12;
                break;
              }
            }
            foreach ($microgridlakeasia_six as $id13){
              if (substr( "".$vor_igate_id, 0, 4 ) === $id13){
                $isExcluded=13;
                break;
              }
            }

            if ($isExcluded == 1){
                if (!is_dir("/data/storage/microgridlakeasiaone/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeasiaone/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeasiaone/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeasiaone/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiaone/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiaone/csv-to-microgridlakeasiaone/";
                system($command);
            }elseif ($isExcluded == 2){
                if (!is_dir("/data/storage/smallutilitylakeasia/logs/" . $date_string)) {
                    mkdir("/data/storage/smallutilitylakeasia/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/smallutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/smallutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/smallutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/sulasia/csv-to-smallutilitylakeasia/";
                system($command);
        }elseif ($isExcluded == 3){
                if (!is_dir("/data/storage/largeutilitylakeasia/logs/" . $date_string)) {
                    mkdir("/data/storage/largeutilitylakeasia/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/largeutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/largeutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/largeutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/lulasia/csv-to-largeutilitylakeasia/";
                system($command);
            }elseif ($isExcluded == 4){
                if (!is_dir("/data/storage/microgridlakeafrica/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeafrica/logs/" . $date_string, 0777);
                }
  
                if (!is_dir("/data/storage/microgridlakeafrica/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeafrica/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeafrica/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglafrica/csv-to-microgridlakeafrica/";
                system($command);
            }elseif ($isExcluded == 5){
                if (!is_dir("/data/storage/microgridlakeamerica/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeamerica/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeamerica/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeamerica/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeamerica/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglamerica/csv-to-microgridlakeamerica/";
                system($command);
            }elseif ($isExcluded == 6){
                if (!is_dir("/data/storage/ampluslakeasia/logs/" . $date_string)) {
                    mkdir("/data/storage/ampluslakeasia/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/ampluslakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/ampluslakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/ampluslakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/amplasia/csv-to-ampluslakeasia/";
                system($command);
            }elseif ($isExcluded == 7){
                if (!is_dir("/data/storage/iplonlakeasia/logs/" . $date_string)) {
                    mkdir("/data/storage/iplonlakeasia/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/iplonlakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/iplonlakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/iplonlakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/iplasia/csv-to-iplonlakeasia/";
                system($command);
            }elseif ($isExcluded == 8){
                if (!is_dir("/data/storage/arraymeter/logs/" . $date_string)) {
                    mkdir("/data/storage/arraymeter/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/arraymeter/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/arraymeter/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/arraymeter/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglamerica/csv-to-microgridlakeamerica/";
                system($command);
            }elseif ($isExcluded == 9){
                if (!is_dir("/data/storage/microgridlakeasiatwo/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeasiatwo/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeasiatwo/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeasiatwo/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiatwo/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiatwo/csv-to-microgridlakeasiatwo/";
                system($command);
            }elseif ($isExcluded == 10){
                if (!is_dir("/data/storage/microgridlakeasiathree/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeasiathree/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeasiathree/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeasiathree/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiathree/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiathree/csv-to-microgridlakeasiathree/";
                system($command);
            }elseif ($isExcluded == 11){
                if (!is_dir("/data/storage/microgridlakeasiafour/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeasiafour/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeasiafour/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeasiafour/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiafour/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiafour/csv-to-microgridlakeasiafour/";
                system($command);
            }elseif ($isExcluded == 12){
                if (!is_dir("/data/storage/microgridlakeasiafive/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeasiafive/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeasiafive/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeasiafive/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiafive/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiafive/csv-to-microgridlakeasiafive/";
                system($command);
            }elseif ($isExcluded == 13){
                if (!is_dir("/data/storage/microgridlakeasiasix/logs/" . $date_string)) {
                    mkdir("/data/storage/microgridlakeasiasix/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/microgridlakeasiasix/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/microgridlakeasiasix/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiasix/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiasix/csv-to-microgridlakeasiasix/";
                system($command);
            }else {
                if (!is_dir("/data/storage/other/logs/" . $date_string)) {
                    mkdir("/data/storage/other/logs/" . $date_string, 0777);
                }

                if (!is_dir("/data/storage/other/logs/" . $date_string . "/" . $vor_igate_id)) {
                    mkdir("/data/storage/other/logs/" . $date_string . "/" . $vor_igate_id, 0777);
                }

                $command = "cd /data/pack/" . $vor_igate_id . " && tar -vxjf " . $file_name . " >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
                system($command);
                unlink($tmp_file);

                $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../storage/other/logs/" . $date_string . "/" . $vor_igate_id . "/";
                system($command);
            }
        }
    }
}elseif(preg_match($pattern5, $file_name)) { //csv Test
    $command = "echo \"" . date("Y-m-d_H-i-s") . " received file: " . $file_name . "\" >> " . $file_log_dir . "/" . $vor_igate_id . ".log";
    system($command);
    copy($file, $tmp_file);
    if (file_exists($tmp_file)) {
        print "Originalname: " . $file_name . "<br>";
        print "case 3";
        print " csv file received... ";

        $isExcluded = 0;
        foreach ($microgridlakeasia_one as $id1){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id1){
            $isExcluded=1;
            break;
          }
        }
        foreach ($smallutilitylakeasia as $id2){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id2){
            $isExcluded=2;
            break;
          }
        }
        foreach ($largeutilitylakeasia as $id3){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id3){
            $isExcluded=3;
            break;
          }
        }
        foreach ($microgridlakeafrica as $id4){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id4){
            $isExcluded=4;
            break;
          }
        }
        foreach ($microgridlakeamerica as $id5){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id5){
            $isExcluded=5;
            break;
          }
        }
        foreach ($ampluslakeasia as $id6){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id6){
            $isExcluded=6;
            break;
          }
        }
        foreach ($iplonlakeasia as $id7){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id7){
            $isExcluded=7;
            break;
          }
        }
        foreach ($arraymeter as $id8){
          if (substr( "".$vor_igate_id, 0, 8 ) === $id8){
            $isExcluded=8;
            break;
          }
        }
        foreach ($microgridlakeasia_two as $id9){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id9){
            $isExcluded=9;
            break;
          }
        }
        foreach ($microgridlakeasia_three as $id10){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id10){
            $isExcluded=10;
            break;
          }
        }
        foreach ($microgridlakeasia_four as $id11){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id11){
            $isExcluded=11;
            break;
          }
        }
        foreach ($microgridlakeasia_five as $id12){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id12){
            $isExcluded=12;
            break;
          }
        }
        foreach ($microgridlakeasia_six as $id13){
          if (substr( "".$vor_igate_id, 0, 4 ) === $id13){
            $isExcluded=13;
            break;
          }
        }

        if ($isExcluded == 1){
            if (!is_dir("/data/storage/microgridlakeasiaone/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeasiaone/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeasiaone/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeasiaone/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiaone/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiaone/csv-to-microgridlakeasiaone/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 2){
            if (!is_dir("/data/storage/smallutilitylakeasia/logs/" . $date_string)) {
                mkdir("/data/storage/smallutilitylakeasia/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/smallutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/smallutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/smallutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/sulasia/csv-to-smallutilitylakeasia/";
            system($command);

            unlink($tmp_file);
    }elseif ($isExcluded == 3){
            if (!is_dir("/data/storage/largeutilitylakeasia/logs/" . $date_string)) {
                mkdir("/data/storage/largeutilitylakeasia/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/largeutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/largeutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/largeutilitylakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/lulasia/csv-to-largeutilitylakeasia/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 4){
            if (!is_dir("/data/storage/microgridlakeafrica/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeafrica/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeafrica/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeafrica/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeafrica/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglafrica/csv-to-microgridlakeafrica/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 5){
            if (!is_dir("/data/storage/microgridlakeamerica/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeamerica/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeamerica/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeamerica/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeamerica/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglamerica/csv-to-microgridlakeamerica/";
            system($command);
          
            unlink($tmp_file);
        }elseif ($isExcluded == 6){
            if (!is_dir("/data/storage/ampluslakeasia/logs/" . $date_string)) {
                mkdir("/data/storage/ampluslakeasia/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/ampluslakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/ampluslakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/ampluslakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/amplasia/csv-to-ampluslakeasia/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 7){
            if (!is_dir("/data/storage/iplonlakeasia/logs/" . $date_string)) {
                mkdir("/data/storage/iplonlakeasia/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/iplonlakeasia/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/iplonlakeasia/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/iplonlakeasia/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/iplasia/csv-to-iplonlakeasia/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 8){
            if (!is_dir("/data/storage/arraymeter/logs/" . $date_string)) {
                mkdir("/data/storage/arraymeter/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/arraymeter/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/arraymeter/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/arraymeter/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglamerica/csv-to-microgridlakeamerica/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 9){
            if (!is_dir("/data/storage/microgridlakeasiatwo/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeasiatwo/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeasiatwo/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeasiatwo/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiatwo/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiatwo/csv-to-microgridlakeasiatwo/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 10){
            if (!is_dir("/data/storage/microgridlakeasiathree/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeasiathree/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeasiathree/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeasiathree/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiathree/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiathree/csv-to-microgridlakeasiathree/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 11){
            if (!is_dir("/data/storage/microgridlakeasiafour/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeasiafour/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeasiafour/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeasiafour/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiafour/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiafour/csv-to-microgridlakeasiafour/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 12){
            if (!is_dir("/data/storage/microgridlakeasiafive/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeasiafive/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeasiafive/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeasiafive/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiafive/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiafive/csv-to-microgridlakeasiafive/";
            system($command);

            unlink($tmp_file);
        }elseif ($isExcluded == 13){
            if (!is_dir("/data/storage/microgridlakeasiasix/logs/" . $date_string)) {
                mkdir("/data/storage/microgridlakeasiasix/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/microgridlakeasiasix/logs/" . $date_string . "/" . $vor_igate_id)) {
                mkdir("/data/storage/microgridlakeasiasix/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && cp *.csv* ../../storage/microgridlakeasiasix/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../iporting/mglasiasix/csv-to-microgridlakeasiasix/";
            system($command);

            unlink($tmp_file);
        }else {
            if (!is_dir("/data/storage/other/logs/" . $date_string)) {
               mkdir("/data/storage/other/logs/" . $date_string, 0777);
            }

            if (!is_dir("/data/storage/other/logs/" . $date_string . "/" . $vor_igate_id)) {
               mkdir("/data/storage/other/logs/" . $date_string . "/" . $vor_igate_id, 0777);
            }

            $command = "cd /data/pack/" . $vor_igate_id . " && mv *.csv* ../../storage/other/logs/" . $date_string . "/" . $vor_igate_id . "/";
            system($command);

            unlink($tmp_file);
        }
    }
}else {//Datei 
    copy($file, $tmp_file);
    if (file_exists($tmp_file)) {
        print "Originalname: " . $file_name;
        if(preg_match($pattern3, $tmp_file)) {
            print " unzipping... ";
            print "case 4";
            $command = "/usr/bin/gunzip " . $tmp_file;
            system($command);
        }
        $curl_filename=preg_replace($pattern4,"", $tmp_file );
    } else {
        echo "�bertragung fehlgeschlagen";
    }
}//Datei

?>
