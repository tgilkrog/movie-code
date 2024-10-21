<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Genre</title>
    <link rel="stylesheet" type="text/css" href="/Wexo-code/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
<div class="favorite-list-wrapper">
        <p class="favorite-button">Favorites <i class="fa-solid fa-heart"></i></p>
        <ul class="favorite-list">
            <?php
            if ($favorites) {
                foreach ($favorites as $favorite) {
                    if (is_array($favorite)) { ?>
                        <li class="favorite-list-item">
                            <img src="https://image.tmdb.org/t/p/original<?php echo $favorite['movie_poster']; ?>" />
                            <p><?php echo $favorite['movie_title']; ?></p>
                        </li>
                <?php    }
                }
            } else { ?>
                <p>You have no favorites yet</p>
            <?php }
            ?>
        </ul>
    </div>
    <div class="genre-movie-wrapper">
        <a class="go-back" href="/Wexo-code/">Go Back</a>
        <h1><?php echo $genre; ?></h1>
        <ul class="genre-movie-list">
            <?php foreach ($movies['results'] as $movie) { ?>
                <?php
                if (isset($favorites)) {
                    $movie_id = $movie['id'];
                    $heart_to_show = array_search($movie_id, array_column($favorites, 'movie_id')) !== false
                        ? 'fa-solid fa-heart movie-heart liked'
                        : 'fa-regular fa-heart movie-heart not-liked';
                } else {
                    $heart_to_show = 'fa-regular fa-heart movie-heart not-liked';
                }
                ?>
                <li class="genre-movie-list-item" data-movie_id="<?php echo $movie['id']; ?>" data-movie_title="<?php echo $movie['title']; ?>" data-movie_poster="<?php echo $movie['backdrop_path']; ?>">
                    <a class="movie-details" href="/Wexo-code/movie/<?php echo $movie['id']; ?>"><img src="https://image.tmdb.org/t/p/original/<?php echo $movie['backdrop_path'] ?>">
                        <h4><?php echo $movie['title']; ?></h4>
                        <i class="<?php echo $heart_to_show; ?>"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <script src="../public/js/script.js"></script>
</body>

</html>