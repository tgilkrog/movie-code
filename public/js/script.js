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

jQuery(document).ready(function($){
    $('.movie-collection-list-item').on('click', function(){
        var movieId = $(this).attr('data-movie_id');

        $.ajax({
            url: '/Wexo-code/ajax/fetchMovieById', // Point to the new AJAX route
            type: 'POST',
            data: { 
                action: 'get_movie_by_id',
                movie_id: movieId 
            }, // Send movie ID to the server
            success: function(data) {
                const movie = JSON.parse(data); // Parse JSON response
                if (movie.error) {
                    alert(movie.error); // Show error message
                } else {
                    $('.movie-collection-preview h2').fadeOut(200, function() {
                        $(this).text(movie.title).fadeIn(200);
                    });
                    
                    $('.movie-collection-preview .movie-tagline').fadeOut(200, function() {
                        $(this).text(movie.overview.substring(0, 150 - 3) + '...').fadeIn(200);
                    });
                    
                    $('.movie-collection-preview .movie-score').fadeOut(200, function() {
                        $(this).text('Userscore: ' + (movie.vote_average).toFixed(2) + ' / 10').fadeIn(200);
                    });
                    
                    $('.movie-collection-preview img').fadeOut(200, function() {
                        $(this).attr('src', 'https://image.tmdb.org/t/p/original/' + movie.backdrop_path).fadeIn(200);
                    });

                    $('.movie-collection-preview .movie-details').fadeOut(200, function() {
                        $(this).attr('href', '/Wexo-code/movie/' + movie.id).fadeIn(200);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
            }
        });
    });

    $('.movie-heart').on('click', function(){
        var movieId = $(this).parent().attr('data-movie_id');
        var $heartIcon = $(this);

        $heartIcon.fadeOut(200, function() {
            // Send the AJAX request while the icon is faded out
            $.ajax({
                url: '/Wexo-code/ajax/fetchMovieById', 
                type: 'POST',
                data: { 
                    action: 'save_to_favorites',
                    movie_id: movieId 
                }, 
                success: function(data) {
                    // Toggle the icon class when the AJAX call is successful
                    if ($heartIcon.hasClass('fa-solid')) {
                        // If it's already liked, remove it from the favorites
                        $heartIcon.removeClass('fa-solid fa-heart liked').addClass('fa-regular fa-heart not-liked');
                    } else {
                        // If it's not liked, add it to the favorites
                        $heartIcon.removeClass('fa-regular fa-heart not-liked').addClass('fa-solid fa-heart liked');
                    }
                    
                    // Fade the icon back in after changing the class
                    $heartIcon.fadeIn(200);
                }
            });
        });
    });

});