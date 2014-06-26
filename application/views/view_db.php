<h1>This is view db</h1>

<?php
     foreach($results as $row){
         echo $row->id;
         echo $row->name;
         echo "<br />";
     }
 ?>