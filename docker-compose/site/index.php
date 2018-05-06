<html>
    <head>
        <title>My Model Shop</title>
    </head>


    <body>
        <h1>Welcome to my model shop</h1>

        <ul>
        <!-- docker-compose will create a virtual network for the containers, so they can access each other. And the service name in the docker compose file will be the host name here -->
            <?php 
                $json = file_get_contents('http://product-service');
                $obj = json_decode($json);
                $products = $obj -> products;
                foreach ($products as $product){
                    echo "<li> $product </li>";
                }
            ?>
        </ul>
    </body>

</html>