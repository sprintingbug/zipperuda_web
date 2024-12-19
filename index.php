<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website ni Peruda</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/styles.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/nav.php'; ?>
    
        <div class="content">
        <?php include 'inc/info-col.php'; ?>
                <h2 class="white-text">Homepage</h2>
                
                <div class="gallery">
                <img src="sl3.jpg" class="main-image" alt="homepage image" id="main-image">
                </div>

        </div>

    <?php include 'inc/footer.php'; ?>

    <script>
        // JavaScript to handle the gallery thumbnail clicks
        document.querySelectorAll('.thumbnail').forEach(img => {
            img.addEventListener('click', function() {
                const mainImage = document.getElementById('main-image');
                const newSrc = this.getAttribute('data-src');
                mainImage.src = newSrc;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

