<?
    $currentDir = getcwd();
    $uploadDirectory = '/';

    $theerrors = []; // Store all foreseen and unforseen errors here

    $myextens = ['png', 'jpg']; // Set your desired file extensions

    $fname = $_FILES['myfile']['name'];
    $fsize = $_FILES['myfile']['size'];
    $ftemp  = $_FILES['myfile']['tmp_name'];
    $mytype = $_FILES['myfile']['type'];
    $theext = strtolower(end(explode('.',$fname)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fname); 

    if (isset($_POST['submit'])) {

        if (! in_array($theext,$myextens)) {
            $theerrors[] = "This file extension is not allowed. Please upload a PNG or JPG file";
        }

        if ($fsize > 2000000) {
            $theerrors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($theerrors)) {
            $didUpload = move_uploaded_file($ftemp, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fname) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($theerrors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }


?>