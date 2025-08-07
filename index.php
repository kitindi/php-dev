<?php
$contactsFile = "contacts.json";
$contacts = file_exists($contactsFile) ? json_decode(file_get_contents($contactsFile), true):[];


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

<ul>
    <?php  foreach ($contacts as $contact): ?>
    <li>
        <img src="<?php echo $contact["image"];?>" alt="profile" height="50">
        <?php echo "{$contact["username"]} - {$contact["email"]}"; ?>
    </li>
    <?php endforeach;?>
</ul>
</body>
</html>