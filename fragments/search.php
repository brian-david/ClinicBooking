<?php require_once __DIR__.'/../fragments/loginCheck.php';?>
<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<?php
    $db->connect();

	if(isset($_POST["passed"])){
		$q = $_POST["passed"];
		$results = $db->pdo->prepare("SELECT * FROM patients WHERE medical_aid LIKE '" . $q . "%'");
	}else{
		$results = $db->pdo->prepare("SELECT * FROM patients");
	}
	$results->execute();

	while($row = $results->fetch(PDO::FETCH_ASSOC)){
		echo '<tr >' .
			'<td style="padding: 10px 20px 10px;">' . $row['medical_aid'] . '</td>' .
            '<td>' . $row['name'] . '</td>' .
            '<td>' . $row['phone_no'] . '</td>' .
		'</tr>';
	}
?>