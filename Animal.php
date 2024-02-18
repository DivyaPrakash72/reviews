


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// if ($_SERVER["REQUEST_METHODx"] == "get") {
    if(isset($_GET["name"]) && $_GET["review"]){
    // Retrieve the data from the form
    $name = $_GET["name"];
    $review = $_GET["review"]; // Corrected variable name from $email to $review
    echo $name;
    echo $review;


    // Validate the data (you can add more validation as needed)
    if (empty($name) || empty($review)) {
        echo "All fields are required";
    } else {
        // Check if the review with the given content already exists
        $checkSql = "SELECT * FROM animal WHERE review = '$review'"; // Corrected column name to review_content
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows == 0) { // Corrected condition to check if the review doesn't exist
            // Insert the review into the review table
            $insertSql = "INSERT INTO animal (name, review) VALUES ('$name', '$review')"; // Corrected table name to animal
            if ($conn->query($insertSql) === TRUE) {
                // Insert successful, you can redirect or do other actions here
                // echo "Review added successfully!";
                header("Location: thankyou.html");
            } else {
                echo "Error: " . $insertSql . "<br>" . $conn->error;
            }
        } else {
            echo "Review with the same content already exists";
        }
    }

    // Close the database connection
    $conn->close();
}
?>