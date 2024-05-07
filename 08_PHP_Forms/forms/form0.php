<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starting</title>
</head>
<body>
    <h1>Content of $_GET array</h1>
    <p>complete the url: ~/?x=2&y=5&guess=John%20Doe&country=China</p>
    <h3>Using print_r: </h3>
    <pre>
        <?php 
            print_r($_GET); 
        ?>
    </pre>

    <h3>Using var_dump: </h3>
    <pre>
        <?php 
            var_dump($_GET); 
        ?>
    </pre>
    
</body>
</html>