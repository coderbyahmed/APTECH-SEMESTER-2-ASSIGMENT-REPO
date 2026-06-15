<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php include("component/header.php"); ?>

<!-- Products Banner -->

<section style="background:linear-gradient(135deg,#0d6efd,#4facfe); color:white; text-align:center; padding:70px 20px;">

    <h1 style="font-size:45px; margin-bottom:15px;">
        Our Products
    </h1>

    <p style="font-size:18px;">
        Browse our latest collection of premium quality products.
    </p>

</section>

<!-- Categories -->

<section style="width:90%; margin:40px auto; text-align:center;">

    <button style="padding:12px 25px; margin:10px; border:none; background:#0d6efd; color:white; border-radius:5px; cursor:pointer;">All</button>

    <button style="padding:12px 25px; margin:10px; border:1px solid #0d6efd; background:white; color:#0d6efd; border-radius:5px; cursor:pointer;">Electronics</button>

    <button style="padding:12px 25px; margin:10px; border:1px solid #0d6efd; background:white; color:#0d6efd; border-radius:5px; cursor:pointer;">Fashion</button>

    <button style="padding:12px 25px; margin:10px; border:1px solid #0d6efd; background:white; color:#0d6efd; border-radius:5px; cursor:pointer;">Shoes</button>

    <button style="padding:12px 25px; margin:10px; border:1px solid #0d6efd; background:white; color:#0d6efd; border-radius:5px; cursor:pointer;">Accessories</button>

</section>

<!-- Products -->

<section style="width:90%; margin:40px auto; display:flex; justify-content:center; flex-wrap:wrap; gap:30px;">

    <!-- Product Card -->

    <?php
    $products = [
        ["Smart Watch", "$120"],
        ["Wireless Headphones", "$150"],
        ["Running Shoes", "$90"],
        ["Bluetooth Speaker", "$75"],
        ["Leather Bag", "$65"],
        ["Gaming Mouse", "$45"],
        ["Laptop Backpack", "$55"],
        ["Sports Shoes", "$110"]
    ];

    foreach($products as $product){
    ?>

    <div style="background:white; width:260px; border-radius:10px; overflow:hidden; box-shadow:0 3px 12px rgba(0,0,0,.1); transition:.3s;">

        <img src="https://login.com.pk/cdn/shop/files/L-109BlazeBrown5.webp?v=1769782185&width=533" style="width:100%;">


        <div style="padding:20px;">

            <h3><?php echo $product[0]; ?></h3>

            <p style="margin:10px 0; color:#666;">
                High quality product with modern design and premium build quality.
            </p>

            <p style="color:#f39c12; font-size:18px;">
                ★★★★★
            </p>

            <h2 style="margin:15px 0; color:#0d6efd;">
                <?php echo $product[1]; ?>
            </h2>

            <button style="width:100%; padding:12px; border:none; background:#0d6efd; color:white; border-radius:5px; cursor:pointer;">
                Add To Cart
            </button>

        </div>

    </div>

    <?php } ?>

</section>

<!-- Features -->

<section style="width:90%; margin:70px auto; display:flex; justify-content:center; gap:25px; flex-wrap:wrap;">

    <div style="background:white; width:260px; padding:30px; text-align:center; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">

        <h2>🚚</h2>

        <h3 style="margin:15px 0;">Free Shipping</h3>

        <p>Free delivery on orders above $100.</p>

    </div>

    <div style="background:white; width:260px; padding:30px; text-align:center; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">

        <h2>🔒</h2>

        <h3 style="margin:15px 0;">Secure Payment</h3>

        <p>100% secure online payment methods.</p>

    </div>

    <div style="background:white; width:260px; padding:30px; text-align:center; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">

        <h2>↩️</h2>

        <h3 style="margin:15px 0;">Easy Returns</h3>

        <p>7-day easy return and exchange policy.</p>

    </div>

</section>

<?php include("component/footer.php"); ?>
</body>
</html>