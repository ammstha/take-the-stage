

        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Studio Detail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Studio <b>"{{ ucfirst($studio->name) }}"</b> Information</h1>
    <table class="table table-striped">

        <tbody>
        <tr>
            <td><b>Studio Name</b></td>
            <td>{{$studio->name}}</td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td>{{$studio->email}}</td>
        </tr>
        <tr>
            <td><b>Register IP</b></td>
            <td>{{$studio->ip}}</td>
        </tr>
        <tr>
            <td><b>Faculty</b></td>
            <td>{{$studio->studio->faculty}}</td>
        </tr>
        <tr>
            <td><b>Title</b></td>
            <td>{{$studio->studio->title}}</td>
        </tr>
        <tr>
            <td><b>Director Name</b></td>
            <td>{{$studio->studio->director_name}}</td>
        </tr>

        <tr>
            <td><b>Studio Phone Number</b></td>
            <td>{{$studio->studio->studio_phone}}</td>
        </tr>
        <tr>
            <td><b>Cell Phone Number</b></td>
            <td>{{$studio->studio->cell_phone}}</td>
        </tr>
        <tr>
            <td><b>Address</b></td>
            <td>{{$studio->studio->address}}</td>
        </tr>
        <tr>
            <td><b>City</b></td>
            <td>{{$studio->studio->city}}</td>
        </tr>
        <tr>
            <td><b>State</b></td>
            <td>{{$studio->studio->state}}</td>
        </tr>
        <tr>
            <td><b>Zip</b></td>
            <td>{{$studio->studio->zip}}</td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>
