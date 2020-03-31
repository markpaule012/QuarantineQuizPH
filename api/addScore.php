<?php
$servername = "sql110.epizy.com";
$username = "epiz_25436611";
$password = "4Sy2rR0DqZZ";
$dbname = "epiz_25436611_scores";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	
$sql = "INSERT INTO scores (name, score) VALUES ('" . $_GET["name"] . "', '" . $_GET["score"] . "')";

if (isset($_GET["name"]) && isset($_GET["score"])) {

	if ($conn->query($sql) === TRUE) {
		if ($stmt = $conn->prepare("select name as Name, score as Score from scores order by score desc Limit 10")) {

	

			 /* execute query */
			 $stmt -> execute();

			 /* call the fetch() function provided by (nieprzeklinaj at gmail dot com) */
			 $rows = fetch($stmt);
			 
			 echo json_encode($rows);
		}
		

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function fetch($result)
{    
    $array = array();

    if($result instanceof mysqli_stmt)
    {
        $result->store_result();

        $variables = array();
        $data = array();
        $meta = $result->result_metadata();

        while($field = $meta->fetch_field())
            $variables[] = &$data[$field->name]; // pass by reference

        call_user_func_array(array($result, 'bind_result'), $variables);

        $i=0;
        while($result->fetch())
        {
            $array[$i] = array();
            foreach($data as $k=>$v)
                $array[$i][$k] = $v;
            $i++;

            // don't know why, but when I tried $array[] = $data, I got the same one result in all rows
        }
    }
    elseif($result instanceof mysqli_result)
    {
        while($row = $result->fetch_assoc())
            $array[] = $row;
    }

    return $array;
}


?>