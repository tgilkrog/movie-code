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
    <a class="go-back" href="/Wexo-code/">Go Back</a>
    <h1>Genre</h1>
    <div class="genre-movie-wrapper">
        <ul class="genre-movien-list">
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
                    <img src="https://image.tmdb.org/t/p/original/<?php echo $movie['backdrop_path'] ?>">
                    <h4><?php echo $movie['title']; ?></h4>
                    <i class="<?php echo $heart_to_show; ?>"></i>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>