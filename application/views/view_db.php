<h1>This is view db</h1>

<?php
     foreach($results as $row){
         echo $row->id;
         echo $row->username;
		 echo $row->password;
         echo "<br />";
     }
 ?>