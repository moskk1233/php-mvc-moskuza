# Prerequisites
- composer
- php

# How to use
`git clone https://github.com/moskk1233/php-mvc-moskuza.git`  
`cd src/public`  
`php -S localhost:{YOUR_SERVER_PORT}`

# How to development
Important part is in `src/public/index.php` file, then Controller can use in `src/controllers` folder, views file store in `src/views` and any view must have layout so don't try to remove `src/views/layouts/main.php`, then you can create middleware in `src/middlewares`