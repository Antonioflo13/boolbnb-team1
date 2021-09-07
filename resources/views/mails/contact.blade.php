<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
</head>
<body>
    <h2>You have received a new message:</h2>
    <div>
        <h3>Name:</h3>
        <p> {{ $email->name }}</p>
        <h3>Email:</h3>
        <p> {{ $email->email }}</p>
        <h3 >Message:</h3>
        <p> {{ $email->message }}</p>
    </div>
    
</body>
</html>