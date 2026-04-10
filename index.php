<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>eBook Store</title>

<style>
html { scroll-behavior: smooth; }

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6fb;
}

/* NAVBAR */
.navbar {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    padding: 15px 30px;
    color: white;
    display: flex;
    justify-content: space-between;
}

.menu a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

/* HERO */
.hero {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, #8f94fb, #4e54c8);
    color: white;
}

.hero a {
    background: white;
    color: #4e54c8;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
}

/* SECTION */
.section {
    padding: 40px 20px;
}

.section h2 {
    text-align: center;
}

/* GRID */
.row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.col {
    width: 23%;
}

/* CARD */
.book-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* IMAGE */
.img-container {
    height: 470px;
    overflow: hidden;
    border-radius: 8px;
}

.book-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* TITLE */
.book-title {
    font-size: 20px;
    font-weight: bold;
    margin: 10px 0;
    height: 40px;
    overflow: hidden;
}

/* PRICE SYSTEM */
.price-box {
    display: flex;
    align-items: center;
    gap: 8px;
}

.old-price {
    text-decoration: line-through;
    color: gray;
    font-size: 14px;
}

.price {
    font-size: 20px;
    font-weight: bold;
    color: #e84118;
}

.badge {
    background: red;
    color: white;
    font-size: 13px;
    padding: 2px 6px;
    border-radius: 10px;
}

.urgency {
    font-size: 14px;
    color: red;
}

.trust {
    font-size: 14px;
    color: #555;
}

/* BUTTONS */
.btn-buy {
    background: #4e54c8;
    color: white;
    padding: 8px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
}

.btn-wa {
    background: #25d366;
    color: white;
    padding: 6px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 5px;
    font-size: 18px;
}

/* FOOTER */
.footer {
    background: #2d3436;
    color: white;
    padding: 30px;
    margin-top: 40px;
    text-align: center;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .col { width: 48%; }
}

@media (max-width: 480px) {
    .col { width: 100%; }
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>📚 eBookStore</div>
    <div class="menu">
        <a href="#">Home</a>
        <a href="#books">Books</a>
        <a href="">Contact</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Premium eBooks Collection</h1>
    <p>Best Notes for Students</p>
    <br>
    <a href="#books">Explore Now</a>
</div>

<!-- BOOKS -->
<div class="section" id="books">
    <h2>Latest eBooks</h2>

    <div class="row">
        <?php
        $res = $conn->query("SELECT * FROM ebooks ORDER BY id DESC");
        while($row = $res->fetch_assoc()){
            $img = "ebooks/images/".$row['image'];

            if(empty($row['image']) || !file_exists($img)){
                $img = "ebooks/images/default.jpg";
            }
        ?>
        <div class="col">
            <div class="book-card">

                <div class="img-container">
                    <img src="<?php echo $img; ?>" class="book-img">
                </div>

                <div class="book-title">
                    <?php echo htmlspecialchars($row['title']); ?>
                </div>

                <!-- PRICE -->
                <div class="price-box">
                    <span class="old-price">₹<?php echo number_format($row['price'] + 300); ?></span>
                    <span class="price">🔥 ₹<?php echo number_format($row['price']); ?></span>
                    <span class="badge">Limited</span>
                </div>

                <div class="urgency">⏳ Only few left</div>
                <div class="trust">⭐ 500+ students bought</div>

                <a href="buy.php?id=<?php echo $row['id']; ?>" class="btn-buy">
                    Buy Now
                </a>

                <a href="https://wa.me/91XXXXXXXXXX?text=I want ebook: <?php echo urlencode($row['title']); ?>" 
                   class="btn-wa">
                    WhatsApp Buy
                </a>

            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- FOOTER -->
<div class="footer" id="footer">
    <p>© 2026 eBookStore | All Rights Reserved</p>
    <p>Email: schoolsathi12@gmail.com.com | Phone: +91 9999999999</p>
</div>

</body>
</html>