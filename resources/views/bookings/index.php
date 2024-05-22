<?php

declare(strict_types=1);

/** @var array $bookings */
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bookings</title>

    <link rel="stylesheet" href="css/table.css" type="text/css">
</head>

<body>

<h1>Bookings</h1>

<p>Number of records: <?= count($bookings) ?></p>

<table>
    <thead>
    <tr>
        <th>Booking ID</th>
        <th>Patient ID</th>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Comment</th>
    </tr>
    </thead>
    <tbody>
	<?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?= htmlspecialchars((string)$booking['id']) ?></td>
            <td><?= htmlspecialchars((string)$booking['patient_id']) ?></td>
            <td><?= htmlspecialchars($booking['date']) ?></td>
            <td><?= htmlspecialchars($booking['start_time']) ?></td>
            <td><?= htmlspecialchars($booking['end_time']) ?></td>
            <td><?= htmlspecialchars($booking['comment'] ?? '') ?></td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>

<form action='/conflicting-bookings' method='get'>
    <label for='date'>Select Date:</label>
    <input type='date' id='date' name='date' required>
    <button type='submit'>Check overlapping Bookings</button>
</form>

</body>
</html>