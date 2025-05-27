<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation - FoodCircle</title>
</head>
<body>
    <h2>Hello {{ $name }},</h2>

    <p>Thank you for ordering from FoodCircle! Here are your order details:</p>

    <ul>
        <li><strong>Menu Item:</strong> {{ $menuName }}</li>
        <li><strong>Quantity:</strong> {{ $quantity }}</li>
        <li><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</li>
        <li><strong>Payment Method:</strong> {{ $paymentMethod }}</li>
        <li><strong>Order Status:</strong> {{ $status }}</li>
    </ul>

    <p>Delivery Address:</p>
    <p>{{ $address }}</p>

    <p>If you have any questions, feel free to reply to this email or contact our support.</p>

    <br>
    <p>Best regards,</p>
    <p><strong>FoodCircle Team</strong></p>
</body>
</html>
