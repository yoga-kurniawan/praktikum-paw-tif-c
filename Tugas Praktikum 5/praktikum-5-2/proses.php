<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $nim = $_POST["nim"];
    $email = $_POST["email"];
    
    if (empty($name) || empty($email) || empty($nim)) {
        echo "Please fill in all fields.";
    } else {
        $sanitizedName = htmlspecialchars($name);
        $sanitizedNim = htmlspecialchars($nim);
        $sanitizedEmail = htmlspecialchars($email);

        $data = "Name: " . $sanitizedName . "\n" . "NIM: " . $sanitizedNim . "\n" . "Email: " . $sanitizedEmail;
        
        $filename = "form_data.txt";
        
        $file = fopen($filename, "a");

        if ($file) {
            fwrite($file, $data);
            fclose($file);
            echo "Data saved successfully.";
        } else {
            echo "Error saving data to file.";
        }
    }
}
?>