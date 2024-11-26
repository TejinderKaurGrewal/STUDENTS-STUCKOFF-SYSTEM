<?php
session_start();
include 'db.php';

// Check if user is logged in and has the correct role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Dean Academics') {
    header("Location: login.php");
    exit();
}

// Fetch remarks that need to be reviewed by the Dean
$result = $conn->query("SELECT * FROM remarks WHERE dean_remark IS NULL AND dr_remark IS NOT NULL");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>Roll No: " . $row['roll_no'] . "</h3>";
        echo "<p><strong>Dealing Hand Remark:</strong> " . $row['dealing_hand_remark'] . "</p>";
        echo "<p><strong>Incharge Remark:</strong> " . $row['incharge_remark'] . "</p>";
        echo "<p><strong>DR Academics Remark:</strong> " . $row['dr_remark'] . "</p>";

        // Form to add Dean Academics remark
        echo '<form method="POST" action="submit_dean_remark.php">
                <input type="hidden" name="remark_id" value="' . $row['id'] . '">
                Remarks: <textarea name="dean_remark" required></textarea>
                <button type="submit">Submit Remark</button>
              </form>';
    }
} else {
    echo "<p>No remarks available for review.</p>";
}
?>