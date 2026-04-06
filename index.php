<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Account</title>
    <style>
        #myheader{ 
        background-color: blue;
        color:white;
        padding:4px;
        font-family:'Time New Roman'
        font-weight: bold;
        font-size:100px;
        text-align:center;
        }
        #myNav{
            color:blue;
            text-align:center;
        }
        a{
            text-decoration:none;
            margin-left:15px;
            font-size:50px;
            color:pink;
        }
        a:hover{
            backaground-color:steelblue;
            color:whitesmoke;
            padding:4px
        }
        .myMain{
            background-color: lightblue;
            color: darkblue;
            font-size:40px;
            text-align:justify;
            width:90%;
            height:fit-content;
            padding-left: 10%;
        }

        input{
            width: 50%;
            border: none;
            border-bottom:2px solid red;
        }
        button{
            width: 30%;
            text-align:center;
            padding:4px;
            text-color:white;
        }
        </style>
</head>
<body>
     <header id="myheader">
        user Account
    <form action="insert.php" method="POST">
        <nav id="myNav">
            

        <input type="text"name="name"
        placeholder="Enter name"reguired>
        <input type="email"name="email"
        placeholder="Enter email"require>
        <button type="submit">save</button>
</nav>
        </header>
</form>
</body>
</html>