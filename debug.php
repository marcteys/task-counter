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
</head>
<body>
  <?php  require "fllat.php";
    $data = new Fllat("data");
    $alldata = $data -> select(array());
    foreach ($alldata as $row) {
      echo '  <div class="table">';
      echo "<span>" . $row["user"] . "</span>";
      echo "<span>" . $row["type"] . "</span>";
      echo "<span>" . $row["date"] . "</span>";
      echo '<div class="remove" data-user="'.$row["user"].'" data-type="'.$row["type"].'" data-date="'.$row["date"].'"> Remove </div>';
     echo '  </div>';
  }
    ?>
   </div>
<script type="text/javascript">


   $(".remove").click(function(el){
    var active = $(el.target);
    console.log(active);
   $.get("send.php",   {
        type: $(el.target).data("type"),
        remove: true,
        user: $(el.target).data("user"),
        date: $(el.target).data("date")
    }, function(data, status){
      if(data == " remove") {
         $(el.target).parent().hide();
      } else {
        console.log(data);
      }
    });
 
}); 

</script>

</body>
</html>