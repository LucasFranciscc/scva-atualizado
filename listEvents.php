<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'scva2');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);


$query_events = "SELECT id_events, title, fk_group, color, start, status FROM events";
$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();

$eventos = [];

while($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)){
    $id_events = $row_events['id_events'];
    $title = $row_events['title'];
    $fk_group = $row_events['fk_group'];
    $color = $row_events['color'];
    $start = $row_events['start'];
    $status = $row_events['status'];

    $eventos[] = [
        'id_events' => $id_events,
        'title' => $title,
        'fk_group' => $fk_group,
        'color' => $color,
        'start' => $start,
        'status' => $status,
    ];
}

echo json_encode($eventos);
