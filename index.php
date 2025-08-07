<?php
$contactsFile = "contacts.json";
$contacts = [];

if (file_exists($contactsFile)) {
    $json = file_get_contents($contactsFile);
    $decoded = json_decode($json, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $contacts = $decoded;
    } else {
        echo "<p>Error reading contacts. Invalid JSON format.</p>";
    }
}


?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<a href="create.php">Create new contact</a>

<?php if (!empty($contacts)): ?>
    <ul>
        <?php foreach ($contacts as $contact): ?>
            <li style="margin-bottom: 10px;">
                <img src="<?= htmlspecialchars($contact["image"]) ?>" alt="profile" height="50">
                <strong><?= htmlspecialchars($contact["username"]) ?></strong> - <?= htmlspecialchars($contact["email"]) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No contacts found.</p>
<?php endif; ?>
</body>
</html>