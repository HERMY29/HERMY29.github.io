<?php
include 'db.php'; // Cambia el path si está en otra carpeta

$sql = "SELECT player_name, score FROM scores ORDER BY score DESC LIMIT 10";
$result = $conn->query($sql);

$scores = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $scores[] = $row;
    }
}

echo json_encode($scores);
?>
