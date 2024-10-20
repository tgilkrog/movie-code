<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Single Movie</title>
    <link rel="stylesheet" type="text/css" href="/Wexo-code/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
<div class="favorite-list-wrapper">
        <p class="favorite-button">Favorites <i class="fa-solid fa-heart"></i></p>
            <ul class="favorite-list">
                <?php 
                if($favorites){ 
                    foreach ($favorites as $favorite) {
                        if(is_array($favorite)){ ?>
                            <li class="favorite-list-item">
                                <img src="https://image.tmdb.org/t/p/original<?php echo $favorite['movie_poster']; ?>" />
                                <p><?php echo $favorite['movie_title'];?></p>
                            </li>
               <?php    } 
                    }
                } 
                else{ ?>
                    <p>You have no favorites yet</p>
                <?php }
                ?>
            </ul>
    </div>
    <a class="go-back" href="/Wexo-code/">Go Back</a>
    <div class="movie-collection-single-wrapper">
        <img class="single-movie-hero" src="https://image.tmdb.org/t/p/original/<?php echo $movie['backdrop_path'] ?>" />
        <div><img class="single-movie-poster" src="https://image.tmdb.org/t/p/original/<?php echo $movie['poster_path'] ?>"></div>

        <div class="single-movie-content">
            <div class="single-movie-info-wrapper">
                <div class="single-movie-info-left">
                    <h1><?php echo $movie['title']; ?></h1>
                    <div>
                        <p>
                            <?php
                            foreach ($movie['genres'] as $genre) {
                                echo $genre['name'] . ', ';
                            }  ?>
                        </p>
                    </div>
                    <h3>Release Date: <?php echo $movie['release_date']; ?></h3>
                    <p class="single-movie-desc"><?php echo $movie['overview']; ?></p>
                </div>

                <div class="single-movie-info-right">
                    <div class="video-container">
                        <iframe
                            src="https://www.youtube.com/embed/<?php echo $firstTrailer['key']; ?>"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>


            <h4>Cast</h4>
            <div>
                <ul class="cast-list">
                    <?php foreach ($people['cast'] as $key => $person) {
                        echo '<li class="list-item">';
                        echo '<img src="https://image.tmdb.org/t/p/original/' . $person['profile_path'] . '" />';
                        echo '<p>' . $person['name'] . '</p>';
                        echo '</li>';

                        if ($key === 9) {
                            break;
                        }
                    } ?>
                </ul>
            </div>


        </div>
    </div>
    <script src="../public/js/script.js"></script>
</body>

</html>