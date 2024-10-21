<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /Wexo-code/
    RewriteRule ^movie/([0-9]+)$ index.php?path=movie&id=$1 [L]  # Capture numeric ID
    RewriteRule ^ajax/movieajax$ app/ajax/MovieAjax.php [L]
</IfModule>
