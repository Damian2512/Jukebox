
<?php

require_once 'Api.class.php';
require_once 'Youtube.class.php';


if( isset( $_REQUEST['zoekresultaat']) ) {
	$youtube = new Youtube();
	$results = $youtube->search( $_REQUEST['zoekresultaat'] );
	foreach( $results as $result ) {

		echo ' <div>
		  <iframe width="420" height="345" src="' . $result['playerUrl'] . '"></iframe>
		  <form method="post" action="">
		  <input type="hidden" name="trackID" value="' . $result['id'] . '">
		  <input type="submit" value="Add to playlist">
		  </form>
		 </div>
		 ';
	}
}   


function preprint_r( $arr = array() ) {
  echo '<pre>';
  print_r( $arr );
  echo '</pre>';
}
?>

        