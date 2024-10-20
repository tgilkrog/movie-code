document.addEventListener("DOMContentLoaded", function () {
    const scrollArrows = document.querySelectorAll('.scroll-arrow');

    scrollArrows.forEach(arrow => {
        arrow.addEventListener('click', () => {
            const scrollContainer = arrow.closest('.scroll-container');
            const movieList = scrollContainer.querySelector('.movie-collection-list');
            const itemWidth = 260;
            let scrollAmount = parseInt(movieList.dataset.scrollAmount) || 0;

            if (arrow.classList.contains('right-arrow')) {
                const maxScrollLeft = movieList.scrollWidth - scrollContainer.clientWidth;
                if (scrollAmount < maxScrollLeft) {
                    scrollAmount += itemWidth;
                    movieList.style.transform = `translateX(-${scrollAmount}px)`;
                    movieList.dataset.scrollAmount = scrollAmount;
                }
            }

            if (arrow.classList.contains('left-arrow')) {
                if (scrollAmount > 0) {
                    scrollAmount -= itemWidth;
                    movieList.style.transform = `translateX(-${scrollAmount}px)`;
                    movieList.dataset.scrollAmount = scrollAmount;
                }
            }
        });
    });
});

jQuery(document).ready(function ($) {

    $('.favorite-button').on('click', function () {
        $('.favorite-list').slideToggle();
    });

    function get_favorite_list() {
        $.ajax({
            url: '/Wexo-code/ajax/movieajax',
            type: 'POST',
            data: {
                action: 'get_favorite_list',
            },
            success: function (response) {
                console.log('success');

                try {
                    let cleanResponse = response.match(/^\[.*\]/s);
                    if (!cleanResponse) {
                        console.error('Error: Invalid JSON format received');
                        return;
                    }

                    let data = JSON.parse(cleanResponse[0]);

                    if (Array.isArray(data)) {
                        let $output = '';
                        $.each(data, function (index, movie) {
                            $output += '<li class="favorite-list-item">';
                            $output += '<img height="100" width="100" src="https://image.tmdb.org/t/p/original' + movie.movie_poster + '" />';
                            $output += '<p>' + movie.movie_title + '</p>';
                            $output += '</li>';
                        });

                        $('.favorite-list').html($output);
                    } else {
                        console.error('Error: Data is not an array');
                    }
                } catch (e) {
                    console.error('Error parsing JSON response: ' + e.message);
                }
            }

        });
    }

    $('.movie-collection-list-item').on('click', function () {
        var movieId = $(this).attr('data-movie_id');

        $.ajax({
            url: '/Wexo-code/ajax/movieajax',
            type: 'POST',
            data: {
                action: 'get_movie_by_id',
                movie_id: movieId
            },
            success: function (data) {
                const movie = JSON.parse(data);
                if (movie.error) {
                    alert(movie.error);
                } else {
                    $('.movie-collection-preview h2').fadeOut(200, function () {
                        $(this).text(movie.title).fadeIn(200);
                    });

                    $('.movie-collection-preview .movie-tagline').fadeOut(200, function () {
                        $(this).text(movie.overview.substring(0, 150 - 3) + '...').fadeIn(200);
                    });

                    $('.movie-collection-preview .movie-score').fadeOut(200, function () {
                        $(this).text('Userscore: ' + (movie.vote_average).toFixed(2) + ' / 10').fadeIn(200);
                    });

                    $('.movie-collection-preview img').fadeOut(200, function () {
                        $(this).attr('src', 'https://image.tmdb.org/t/p/original/' + movie.backdrop_path).fadeIn(200);
                    });

                    $('.movie-collection-preview .movie-details').fadeOut(200, function () {
                        $(this).attr('href', '/Wexo-code/movie/' + movie.id).fadeIn(200);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + error);
            }
        });
    });

    $('.movie-heart').on('click', function () {
        var $heartIcon = $(this);
        var parent = $heartIcon.parent();
        var movie_id = parent.attr('data-movie_id');
        var movie_title = parent.attr('data-movie_title');
        var movie_poster = parent.attr('data-movie_poster');

        $heartIcon.fadeOut(200, function () {
            $.ajax({
                url: '/Wexo-code/ajax/movieajax',
                type: 'POST',
                data: {
                    action: 'save_to_favorites',
                    movie_id: movie_id,
                    movie_title: movie_title,
                    movie_poster: movie_poster
                },
                success: function (data) {
                    if ($heartIcon.hasClass('fa-solid')) {
                        $heartIcon.removeClass('fa-solid fa-heart liked').addClass('fa-regular fa-heart not-liked');
                    } else {
                        $heartIcon.removeClass('fa-regular fa-heart not-liked').addClass('fa-solid fa-heart liked');
                    }

                    $heartIcon.fadeIn(200);
                    get_favorite_list();
                }
            });
        });
    });

});