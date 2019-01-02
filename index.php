<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appart</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://d3js.org/d3.v3.min.js"></script>
</head>
<body>



<?php
 // load settings
  include("settings.php");

?>
<form>
<group class="inline-radio">
  <div><input type="radio" name="user" class="<?php echo $settings['users'][0]; ?>" checked value="<?php echo $settings['users'][0]; ?>"><label><?php echo $settings['users'][0]; ?></label></div>
  <div><input type="radio" name="user"  class="<?php echo $settings['users'][1]; ?>" value="<?php echo $settings['users'][1]; ?>"><label><?php echo $settings['users'][1]; ?></label></div>
</group>

 <div id="status"></div>

  


  <?php 
    // Get the database and sort the data
// Get all the data to know what's the last time a specific task was done
  require "fllat.php";
    $data = new Fllat("data"); 
    $allData = $data -> select(array());




// All this  code here is to get all the data from the database and get when is the last time an action was perform, and retreive the date and the user
   $today= date_create(date("Y-m-d",time()));
    $tasks = array();
    $lastTasks  = array();
    end($allData);
    $max = key($allData);

    for($i = $max; $i>=0; $i--) {
      if(!isset($allData[$i])) {
              continue;
      }
      $row = $allData[$i];
    if(!in_array($row["type"],$tasks)) {
      $date2=date_create($row["date"]);
      $diff=date_diff($today,$date2)->days;
       array_push($tasks,$row["type"]);
       $row["diff"] = $diff;
     $lastTasks[$row["type"]] = $row;
    }
  }

  function displayDate($task) {
    if($task["diff"] == 0) return " <em> aujourd'hui (" . $task["user"] . ")</em>";
    else if($task["diff"] == 1) return " <em> hier (" . $task["user"] . ")</em>";
    else return " <em> ".$task["diff"]." jours (" . $task["user"] . ")</em>";
  }
  





  // That's the main loop that goes around every task in settings
foreach ($settings["tasks"] as $singleTask) {
    echo   
       $singleTask->displayTast(displayDate($lastTasks[$singleTask->getId()]));
    }
?>


<!-- One item looks like that, but it can change
<div class="button" data-task="Courses" style="background:#1abc9c;">
  <i class="fas fa-shopping-cart"></i>
<span>Courses<?php echo displayDate($lastTasks["Courses"]); ?></span>
  <i class="arrow fas fa-chevron-right"></i>
</div>
-->

</div>


<!-- Extra elements -->
  <input id="datePicker"  style="background:#ecf0f1" type="date" name="date">

  <a href="stats.php" class="stats" style="background:#2c3e50; color:white;"><i class="fas fa-chart-bar "></i><span>Stats</span><i class="arrow fas fa-chevron-right"></i></a>

  <a href="debug.php" style="background:#7f8c8d; color:#666;" class="stats"><i class="fas fa-cog "></i><span>Debug</span><i class="arrow fas fa-chevron-right"></i></a>



</form>

   
<script type="text/javascript">

  /// If the page ends with "#Marc" (index.php#Marc),  it will select by default Marc as active user
var hash = window.location.hash.substr(1);;
if(hash) {
    console.log(hash);
     $("."+hash).prop("checked", true);
}


  document.getElementById('datePicker').valueAsDate = new Date();



  // When you click on a button, it sends the request as Ajax :
  // ex: /send.php?type=Lessives&user=Marc&date=02-01-2019
   $(".button").click(function(el){
    var active = $(el.target);

        if(active.hasClass("active")) {
          // remove
           $.get("send.php",   {
                type: $(el.target).data("task"),
                remove: true,
                user: $("input[name='user']:checked").val(),
                date: $('#datePicker').val()
            }, function(data, status){
              if(data == " remove") {
                    active.removeClass("active");
                    active.find(".progress").remove();
              } else {
                console.log(data);
              }
            });
        } else {
             $.get("send.php",   {
                type: $(el.target).data("task"),
                user: $("input[name='user']:checked").val(),
                date: $('#datePicker').val()
            }, function(data, status){
              if(data == " add") {
                // Here we display the task bar
                    active.addClass("active");
                    var el = active.append( "<div class =\"progress\"></div>" );
                    setTimeout(function() {
                      active.find(".progress").remove();
                      active.removeClass("active");
                    }, 5000);
              } else {
                console.log(data);
              }
            });
        }


 
}); 

</script>

</body>
</html>