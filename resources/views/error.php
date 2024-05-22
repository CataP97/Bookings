<?php

declare(strict_types=1);

/** @var string $errorMessage */
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <title>Error</title>
</head>

<body>
<a href='/'>Home</a>

<h1>An error occurred</h1>
<p><?= htmlspecialchars($errorMessage) ?></p>
</body>
</html>
