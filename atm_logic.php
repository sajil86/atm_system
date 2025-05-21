<?php
// Set a starting balance if not already set
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000; // Starting balance ₹10,000
}

$pinMessage = '';
$transactionMessage = '';
$enteredPin = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredPin = $_POST['pin'] ?? '';
    $choice = $_POST['choice'] ?? '';

    // Check if PIN is correct
    if ($enteredPin === '1010') {
        $pinMessage = '✅ PIN is correct.';

        switch ($choice) {
            case '1':
                $_SESSION['balance'] += 1000;
                $transactionMessage = "Deposited ₹1,000. New balance: ₹" . number_format($_SESSION['balance']);
                break;
            case '2':
                if ($_SESSION['balance'] >= 1000) {
                    $_SESSION['balance'] -= 1000;
                    $transactionMessage = "Withdrew ₹1,000. New balance: ₹" . number_format($_SESSION['balance']);
                } else {
                    $transactionMessage = "Not enough money to withdraw!";
                }
                break;
            case '3':
                $transactionMessage = "Your balance is: ₹" . number_format($_SESSION['balance']);
                break;
            default:
                $transactionMessage = "Please select a transaction.";
                break;
        }
    } else {
        $pinMessage = '❌ PIN is incorrect.';
    }
}
?>
