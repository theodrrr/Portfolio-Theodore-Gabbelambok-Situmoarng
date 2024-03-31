<?php
$name = isset($_POST["nama"]) ? $_POST["nama"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$number = isset($_POST["nomor"]) ? $_POST["nomor"] : "";
$message = isset($_POST["pesan"]) ? $_POST["pesan"] : "";

// Database Connection
$conn = mysqli_connect('localhost', 'root', '', 'portfolio');
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error());
} else {
    $stmt = $conn->prepare("insert into contact_me(nama, email, nomor, pesan)
        values(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $number, $message);
    $stmt->execute();
    
    // Check if the data was successfully inserted
    if ($stmt->affected_rows > 0) {
        // Redirect to message.php
        header("Location: contact_me.php");
        exit();
    } else {
        echo "Gagal mengirim pesan.";
    }

    $stmt->close();
    $conn->close();
}
?>