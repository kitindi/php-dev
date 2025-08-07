<?php

$uploadDir = "uploads/";
$contactsFile = "contacts.json";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
//    sanitize the input values
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);

//    check if there is a value entered
    if ($username && $email && $phone && isset($_FILES["profile_photo"])){

        // CHECK OF DIR EXISTS
        if (!is_dir($uploadDir)){
            mkdir($uploadDir,0777, true);
        }
         $imageName = time()."_".basename($_FILES["profile_photo"]["name"]);
        $imagePath = $uploadDir.$imageName;

        // move file from temp_dir to uploads dir

        if(move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $imagePath)){
            $contacts = file_exists($contactsFile) ? json_decode(file_get_contents($contactsFile), true):[];
            $contacts[] = [
                    "username"=>$username,
                "email" => $email,
                "phone" => $phone,
                "image" => $imagePath];

            file_put_contents($contactsFile, json_encode($contacts, JSON_PRETTY_PRINT));
            echo "Contact added";
        }else{
            echo "Image upload failed";
        }

    }else{
        echo "Provide valid input";
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

<form action="" style="width: 100%; max-width: 20%" method="post" enctype="multipart/form-data">
    <div style="display: flex; flex-direction: column;margin-bottom: 4px">
        <label for="username" style="font-size: 18px;margin-bottom: 3px">Username</label>
        <input type="text" name="username" style="padding:8px 20px "/>
    </div>
    <div style="display: flex; flex-direction: column;margin-bottom: 4px">
        <label for="email" style="font-size: 18px;margin-bottom: 3px">Email</label>
        <input type="email" name="email" style="padding:8px 20px " />
    </div>
    <div style="display: flex; flex-direction: column;margin-bottom: 4px">
        <label for="phone" style="font-size: 18px;margin-bottom: 3px">Phone number</label>
        <input type="text" name="phone" style="padding:8px 20px " />
    </div>
    <div style="display: flex; flex-direction: column;margin-bottom: 4px">
        <label for="profile_photo" style="font-size: 18px;margin-bottom: 3px">Upload Profile Avatar</label>
        <input type="file" name="profile_photo" style="padding:8px 20px " />
    </div>
    <div style="display: flex; flex-direction: column;padding: 8px 0px">
        <button type="submit" style="padding: 8px 12px;background-color: black;color: bisque;font-weight: 700;font-size: 20px;cursor: pointer">Send</button>
    </div>
</form>
</body>
</html>
