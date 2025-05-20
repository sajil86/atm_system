<?php
session_start();

$pinMessage = '';
$transactionMessage = '';

// Only initialize balance if not set and if a transaction is being performed
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 10000;
}

$enteredPin = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredPin = $_POST['pin'] ?? '';
    $choice = $_POST['choice'] ?? '';

    // PIN Validation
    if ($enteredPin === '1010') {
        $pinMessage = '✅ PIN Matching';

        // Process transaction choice
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
                    $transactionMessage = "Insufficient funds!";
                }
                break;
            case '3':
                $transactionMessage = "Current balance: ₹" . number_format($_SESSION['balance']);
                break;
            default:
                $transactionMessage = "Invalid transaction choice";
        }
    } else {
        $pinMessage = '❌ PIN Not Matching';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ATM System</title>
    
</head>
<body>
    <h2>ATM Transaction System</h2>
    <link rel="stylesheet" href="style.css">
    <form method="POST">
        <label for="pin">Enter PIN:</label><br>
        <input type="password" id="pin" name="pin" required><br><br>
        
        <label for="choice">Select Transaction:</label><br>
        <select id="choice" name="choice" required>
            <option value="">-- Select Transaction --</option>
            <option value="1">1. Deposit ₹1,000</option>
            <option value="2">2. Withdraw ₹1,000</option>
            <option value="3">3. Check Balance</option>
        </select><br><br>
        
        <input type="submit" value="Process Transaction">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="message <?php echo ($enteredPin === '1010') ? 'success' : 'error'; ?>">
            <p><strong>PIN Status:</strong> <?php echo $pinMessage; ?></p>
            <?php if (!empty($transactionMessage)): ?>
                <p><strong>Transaction Result:</strong><br><?php echo $transactionMessage; ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>