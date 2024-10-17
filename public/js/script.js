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
            data: { movie_id: movieId }, // Send movie ID to the server
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
    })
});