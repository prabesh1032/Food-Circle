<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        p {
            margin: 10px 0;
        }
        .details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .details strong {
            display: inline-block;
            width: 150px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <p>Thank you for your order, <strong>{{ $name }}</strong>! Here are your order details:</p>

        <div class="details">
            <h3>Order Details</h3>
            <p><strong>Order ID:</strong> {{ $order_id }}</p>
            <p><strong>Order Date:</strong> {{ $order_date }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
        </div>

        <div class="details">
            <h3>Menu Details</h3>
            <p><strong>Item Name:</strong> {{ $menu_name }}</p>
            <p><strong>Item Price:</strong> Rs. {{ $menu_price }}</p>
            <p><strong>Quantity:</strong> {{ $quantity }}</p>
            <p><strong>Total Price:</strong> Rs. {{ $total_price }}</p>
        </div>

        <div class="details">
            <h3>Payment Information</h3>
            <p><strong>Payment Method:</strong> {{ $payment_method }}</p>
        </div>

        <div class="details">
            <h3>Customer Details</h3>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Phone:</strong> {{ $phone }}</p>
            <p><strong>Address:</strong> {{ $address }}</p>
        </div>

        <p>If you have any questions or concerns about your order, please contact us. We are here to help!</p>

        <p>Thank you for choosing FoodCircle. We look forward to serving you again!</p>

        <footer>
            &copy; {{ date('Y') }} FoodCircle. All rights reserved.
        </footer>
    </div>
</body>
</html>
