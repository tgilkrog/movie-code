<!-- app/views/home.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="movie-collection-preview">
        <img src="https://image.tmdb.org/t/p/original/<?php echo $hero['backdrop_path'] ?>" />
        <div class="movie-collection-preview-content">
            <h2><?php echo $hero['title']; ?></h2>
            <div>
                <p class="movie-tagline"><?php echo substr($hero['overview'], 0, 150 - 3) . '...'; ?></p>
                <p class="movie-score"><?php echo 'Userscore: ' . round($hero['vote_average'], 2); ?> / 10</p>
                <a class="movie-details" href="/Wexo-code/movie/<?php echo $hero['id']; ?>">More Details</a>
            </div>
        </div>
    </div>

    <div class="movie-collection-wrapper">
        <?php foreach ($movies as $key => $mov) { ?>
            <div class="movie-collection-section">
                <h3><?php echo $key; ?></h3>
                <div class="scroll-container">
                    <button class="scroll-arrow left-arrow">&lt;</button>
                    <ul class="movie-collection-list">
                        <?php foreach ($mov['results'] as $movie): ?>
                            <li class="movie-collection-list-item" data-movie_id="<?php echo $movie['id']; ?>">
                                <img src="https://image.tmdb.org/t/p/original/<?php echo $movie['backdrop_path'] ?>">
                                <h4><?php echo $movie['title']; ?></h4>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <button class="scroll-arrow right-arrow">&gt;</button>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="./public/js/script.js"></script>
</body>

</html>