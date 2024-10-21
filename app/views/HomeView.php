<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">
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
    <div class="movie-collection-preview">
        <img src="https://image.tmdb.org/t/p/original/<?php echo $hero['backdrop_path'] ?>" />
        <div class="movie-collection-preview-content">
            <h2><?php echo $hero['title']; ?></h2>
            <div>
                <p class="movie-tagline"><?php echo substr($hero['overview'], 0, 150 - 3) . '...'; ?></p>
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
                        <?php foreach ($mov['results'] as $movie) { ?>
                            <?php
                            if (isset($favorites)) {
                                $movie_id = $movie['id'];
                                // Use strict comparison to check if array_search returns a valid index (0 or greater)
                                $heart_to_show = array_search($movie_id, array_column($favorites, 'movie_id')) !== false
                                    ? 'fa-solid fa-heart movie-heart liked'
                                    : 'fa-regular fa-heart movie-heart not-liked';
                            } else {
                                $heart_to_show = 'fa-regular fa-heart movie-heart not-liked';
                            }
                            ?>
                            <li class="movie-collection-list-item" data-movie_id="<?php echo $movie['id']; ?>" data-movie_title="<?php echo $movie['title']; ?>" data-movie_poster="<?php echo $movie['backdrop_path']; ?>">
                                <img src="https://image.tmdb.org/t/p/original/<?php echo $movie['backdrop_path'] ?>">
                                <h4><?php echo $movie['title']; ?></h4>
                                <i class="<?php echo $heart_to_show; ?>"></i>
                            </li>
                        <?php } ?>
                    </ul>
                    <button class="scroll-arrow right-arrow">&gt;</button>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="./public/js/script.js"></script>
</body>

</html>