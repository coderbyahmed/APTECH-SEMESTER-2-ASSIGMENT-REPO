<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Commerce Website</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#f5f5f5;
}

/* Header */

header{
    width:100%;
    background:#ffffff;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.top-header{
    width:90%;
    margin:auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 0;
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#2c3e50;
}

.search-box{
    display:flex;
    width:420px;
}

.search-box input{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    outline:none;
    border-radius:5px 0 0 5px;
}

.search-box button{
    padding:10px 18px;
    border:none;
    background:#0d6efd;
    color:white;
    cursor:pointer;
    border-radius:0 5px 5px 0;
}

.search-box button:hover{
    background:#0b5ed7;
}

.icons{
    display:flex;
    gap:20px;
}

.icons a{
    text-decoration:none;
    color:#333;
    font-weight:600;
}

.icons a:hover{
    color:#0d6efd;
}

nav{
    background:#0d6efd;
}

nav ul{
    list-style:none;
    display:flex;
    justify-content:center;
}

nav ul li{
    margin:0 10px;
}

nav ul li a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 20px;
    transition:.3s;
}

nav ul li a:hover{
    background:white;
    color:#0d6efd;
}

</style>

</head>

<body>

<header>

    <div class="top-header">

        <div class="logo">
            ShopEase
        </div>

        <div class="search-box">
            <input type="text" placeholder="Search Products...">
            <button>Search</button>
        </div>

        <div class="icons">
            <a href="products.php">Cart 🛒</a>
            <a href="#">Login</a>
        </div>

    </div>

    <nav>

        <ul>

            <li><a href="index.php">Home</a></li>

            <li><a href="about.php">About</a></li>

            <li><a href="products.php">Products</a></li>



        </ul>

    </nav>

</header>
