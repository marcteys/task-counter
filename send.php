 <?php 


 // In this file, we read the request, add it to the database and then generate some csv for data visualisation

 require "fllat.php";
$data = new Fllat("data");

 if(isset($_GET["remove"])) {
          $tmpData = array("type" => $_GET["type"],
            "date" => $_GET["date"],
            "user" =>  $_GET["user"] );

          $d = $data-> select(array());
       // $data -> add($tmpData);
          // $a=array("a"=>"red","b"=>"green","c"=>"blue");
		$id = array_search($tmpData,$d);
		if(isset($id)) {
		 	   unset($d[$id]);
		}
	$data -> rw($d);
        echo "remove";
    } else if(isset($_GET["type"])) {
          $tmpData = array("type" => $_GET["type"],
            "date" => $_GET["date"],
            "user" =>  $_GET["user"] );
        $data -> add($tmpData);
        echo "add";
    }


    $allData = $data -> select(array());
//var_dump($allData);
$csvFileName = 'db/all.csv';
//Open file pointer.
$fp = fopen($csvFileName, 'w');
    fputcsv($fp, array("type","date","user" ));

	foreach($allData as $row){
	    fputcsv($fp, $row);
	}

	fclose($fp);    



// get unique tasks
	$tasks = array();
	foreach($allData as $row){
		if(!in_array($row["type"],$tasks)) {
		 array_push($tasks,$row["type"]);
		}
	}

	$users = array("Marc","Marion");
	//print_r($tasks);



	// count tasks

	$tasksCount = array();//tasks;
	$tasksCount2 = array();//tasks;
	foreach($tasks as $task){
		$countMarc = 0;
		$countMarion = 0;

		foreach($allData as $row){
			if($row["type"] == $task) {
				if($row["user"] == "Marion") $countMarion++;
				else 
					$countMarc++;
			}
		}
	//	$tasksCount[$task] = array($task,array("Marion" => $countMarion, "Marc" => $countMarc));
		array_push($tasksCount, array($task,$countMarion,$countMarc));
		array_push($tasksCount2, array($task,"marc",$countMarc));
		array_push($tasksCount2, array($task,"marion",$countMarion));
	}
	//var_dump($tasksCount);
	$csvFileName = 'db/count.csv';
	$fp = fopen($csvFileName, 'w');
    fputcsv($fp, array("type","marion","marc" ));
	foreach($tasksCount as $row)
	    fputcsv($fp, $row);
	fclose($fp);    

$csvFileName = 'db/count2.csv';
	$fp = fopen($csvFileName, 'w');
    fputcsv($fp, array("type","user","count"));
	foreach($tasksCount2 as $row)
	    fputcsv($fp, $row);
	fclose($fp);  

?>