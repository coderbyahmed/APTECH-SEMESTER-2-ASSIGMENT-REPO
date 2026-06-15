<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php include("component/header.php"); ?>

<!-- Hero Section -->

<section style="width:90%; margin:40px auto; background:linear-gradient(135deg,#0d6efd,#4facfe); color:white; border-radius:12px; padding:70px 50px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap;">

    <div style="max-width:500px;">

        <h1 style="font-size:45px; margin-bottom:20px;">
            Welcome To ShopEase
        </h1>

        <p style="font-size:18px; line-height:30px; margin-bottom:25px;">
            Discover the latest fashion, electronics, shoes, watches and many
            more premium products at the best prices.
        </p>

        <a href="products.php"
        style="display:inline-block;
        background:white;
        color:#0d6efd;
        padding:14px 30px;
        text-decoration:none;
        border-radius:6px;
        font-weight:bold;">
            Shop Now
        </a>

    </div>

    <div>

        <img src="https://static.vecteezy.com/system/resources/thumbnails/002/294/859/small/flash-sale-web-banner-design-e-commerce-online-shopping-header-or-footer-banner-free-vector.jpg"
        alt="Banner"
        style="width:100%; max-width:450px; border-radius:10px;">

    </div>

</section>

<!-- Categories -->

<section style="width:90%; margin:60px auto;">

    <h2 style="text-align:center; margin-bottom:35px;">
        Shop By Categories
    </h2>

    <div style="display:flex; gap:25px; justify-content:center; flex-wrap:wrap;">

        <div style="background:white; width:220px; text-align:center; padding:25px; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">

            <!-- <img src="https://via.placeholder.com/150"
            style="width:100%; border-radius:10px;"> -->

            <h3 style="margin-top:15px;">Electronics</h3>

        </div>

        <div style="background:white; width:220px; text-align:center; padding:25px; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">

            <!-- <img src="https://via.placeholder.com/150"
            style="width:100%; border-radius:10px;"> -->

            <h3 style="margin-top:15px;">Fashion</h3>

        </div>

        <div style="background:white; width:200px; text-align:center; padding:25px; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">
<!-- 
            <img src="https://via.placeholder.com/150"
            style="width:100%; border-radius:10px;"> -->

            <h3 style="margin-top:15px;">Shoes</h3>

        </div>

        <div style="background:white; width:220px; text-align:center; padding:25px; border-radius:10px; box-shadow:0 3px 12px rgba(0,0,0,.1);">

            <!-- <img src="https://via.placeholder.com/150"
            style="width:100%; border-radius:10px;"> -->

            <h3 style="margin-top:15px;">Accessories</h3>

        </div>

    </div>

</section>

<!-- Featured Products -->

<section style="width:90%; margin:60px auto;">

    <h2 style="text-align:center; margin-bottom:35px;">
        Featured Products
    </h2>

    <div style="display:flex; justify-content:center; gap:25px; flex-wrap:wrap;">

        <!-- Product -->

        <div style="background:white; width:260px; border-radius:10px; overflow:hidden; box-shadow:0 3px 10px rgba(0,0,0,.1);">

            <img src="https://login.com.pk/cdn/shop/files/L-109BlazeBrown5.webp?v=1769782185&width=533" style="width:100%;">

            <div style="padding:20px;">

                <h3>Smart Watch</h3>

                <p style="margin:10px 0; color:#555;">
                    Premium quality smart watch with modern features.
                </p>

                <h2 style="color:#0d6efd;">
                    $120
                </h2>

                <button style="width:100%; margin-top:15px; padding:12px; border:none; background:#0d6efd; color:white; cursor:pointer; border-radius:5px;">
                    Add To Cart
                </button>

            </div>

        </div>

        <!-- Product -->

        <div style="background:white; width:260px; border-radius:10px; overflow:hidden; box-shadow:0 3px 10px rgba(0,0,0,.1);">

            <img src="https://nobinshop.com/wp-content/uploads/2025/03/Joyroom-JR-OH1-Wireless-Bluetooth-Headset-%E2%80%93-Black.webp" style="width:100%;">

            <div style="padding:20px;">

                <h3>Wireless Headphones</h3>

                <p style="margin:10px 0; color:#555;">
                    High quality sound with noise cancellation.
                </p>

                <h2 style="color:#0d6efd;">
                    $150
                </h2>

                <button style="width:100%; margin-top:15px; padding:12px; border:none; background:#0d6efd; color:white; cursor:pointer; border-radius:5px;">
                    Add To Cart
                </button>

            </div>

        </div>

        <!-- Product -->

        <div style="background:white; width:260px; border-radius:10px; overflow:hidden; box-shadow:0 3px 10px rgba(0,0,0,.1);">

            <img src="https://www.omnisend.com/blog/wp-content/uploads/2024/08/Allbirds-tree-dasher-collection.jpg" style="width:100%;">

            <div style="padding:20px;">

                <h3>Running Shoes</h3>

                <p style="margin:10px 0; color:#555;">
                    Comfortable and stylish shoes for everyday use.
                </p>

                <h2 style="color:#0d6efd;">
                    $95
                </h2>

                <button style="width:100%; margin-top:78px; padding:12px; border:none; background:#0d6efd; color:white; cursor:pointer; border-radius:5px;">
                    Add To Cart
                </button>

            </div>

        </div>

    </div>

</section>

<?php include("component/footer.php"); ?>
</body>
</html>