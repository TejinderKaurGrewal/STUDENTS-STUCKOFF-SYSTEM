<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome, " . $_SESSION['role'];
// Provide links to different functionalities based on user role
if ($_SESSION['role'] == 'Dealing Hand') {
    echo '<a href="dealing_hand.php">Submit Remark</a>';
} elseif ($_SESSION['role'] == 'Incharge') {
    echo '<a href="incharge.php">View Remarks</a>';
} elseif ($_SESSION['role'] == 'DR Academics') {
    echo '<a href="dr_academics.php">Review Remarks</a>';
} elseif ($_SESSION['role'] == 'Dean Academics') {
    echo '<a href="dean_academics.php">Approve Remarks</a>';
}
?>