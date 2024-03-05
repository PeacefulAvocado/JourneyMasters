<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body{
            height: 100vh;
            margin:0;
            background: linear-gradient(#fff6d7, #FFDD66);
            background-repeat: no-repeat;
            background-size: cover;
        }
        h1{
            text-align: center;
            font-size: 6vw;
            font-family: "Roboto", sans-serif;
            font-style: normal;
            padding-top: 2vw;
        }
        h2{
            text-align: center;
            font-size: 4vw;
            font-family: "Roboto", sans-serif;
            font-style: normal;
        }
        button{
            display: block;
            margin:auto;
            width: 30vw;
            font-size: 2.5vw;
            padding: 1vw 1vw;
            border:none;
            color: white;
            background-color: #FFB800;
            border-radius: 1vw;
            cursor: pointer;
        }
    </style>
    <title>404 - Az oldal nem található</title>
</head>
<body>
    <h1>404</h1>
    <h2>Az oldal nem található</h2>
    <button onclick="location.href = 'index.php'">Visszalépés a főoldalra</button>
</body>
</html>