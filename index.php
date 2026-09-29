<?php
$tuitionFee = 2000000;

$amountPaid = "";
$balance = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $amountPaid = (float) $_POST["amount_paid"];

    $balance = $tuitionFee - $amountPaid;

    if ($amountPaid <= 0) {
        $status = "No Payment";
        $balance = $tuitionFee;
    } elseif ($amountPaid < $tuitionFee) {
        $status = "Partial Payment";
    } else {
        $status = "Cleared";
        $balance = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fee Classification System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 40px;
        }

        .container {
            width: 450px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .result {
            margin-top: 25px;
            padding: 15px;
            background: #f5f5f5;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Fee Classification System</h1>

    <p><strong>Total Tuition Fee:</strong> UGX 2,000,000</p>

    <form method="POST">

        <label for="amount_paid">Amount Paid (UGX)</label>

        <input
            type="number"
            name="amount_paid"
            id="amount_paid"
            min="0"
            required
        >

        <button type="submit">Calculate</button>

    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>

        <div class="result">

            <p>
                <strong>Amount Paid:</strong>
                UGX <?php echo number_format($amountPaid); ?>
            </p>

            <p>
                <strong>Balance:</strong>
                UGX <?php echo number_format(max(0, $balance)); ?>
            </p>

            <p>
                <strong>Payment Status:</strong>
                <?php echo $status; ?>
            </p>

        </div>

    <?php endif; ?>

</div>

</body>
</html>