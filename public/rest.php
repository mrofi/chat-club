<?php
session_start();

header('Content-Type:application/json');
if (isset($_SESSION['user'])) {
	$data = array(
        'username' => $_SESSION['user']['username'],
        'color' => $_SESSION['user']['color'],
		'initial' => $_SESSION['user']['initial'],
		// 'department' => $_SESSION['user']['department']
	);
	echo json_encode($data);
}
exit;