<?php

declare(strict_types=1);

/** @var string $date */
/** @var array $conflicts */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Conflicting Bookings</title>

    <link rel='stylesheet' href='css/table.css' type='text/css'>
</head>

<body>
<h1>Conflicting Bookings for <?= htmlspecialchars($date) ?></h1>

<a href="/">Home</a>

<p>Number of conflicts: <?= count($conflicts) ?></p>

<?php foreach ($conflicts as $index => $conflictBookings): ?>
    <h3>Conflict <?= $index + 1 ?></h3>

    <table>
        <thead>
        <tr>
            <th>Time</th>
            <th>Patient</th>
            <th>Mobile phone number</th>
            <th>Comment</th>
        </tr>
        </thead>

        <tbody>
		<?php foreach ($conflictBookings as $booking): ?>
            <tr>
                <td><?= htmlspecialchars("{$booking['start_time']} - {$booking['end_time']}") ?></td>
                <td><?= htmlspecialchars($booking['patient_name']) ?></td>
                <td><?= htmlspecialchars($booking['patient_phone']) ?></td>
                <td><?= htmlspecialchars($booking['comment'] ?? '') ?></td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>
</body>
</html>