<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Single Movie</title>
    <link rel="stylesheet" type="text/css" href="/Wexo-code/public/css/style.css">
</head>

<body>
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
</body>

</html>