<?php
session_start();
include 'atm_logic.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>ATM System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>ATM Transaction System</h2>
    
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
