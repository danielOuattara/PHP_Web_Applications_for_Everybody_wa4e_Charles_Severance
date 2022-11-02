<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hello from Dr. Chuck's HTML Page</h1>
    <p>
        <?php
        $x = 5;
        $y = array("x" => "Hello");
        # print $y["x"];
        # print $y[x]; // Error
        # print $y[$x]; // Error
        
        ?>
    </p>
    <p>Yes another paragraph.</p>

    <?php
    echo "this is a simple string \n";
    
    echo "Lorem ipsum dolor sit amet consectetur adipisicing elit. 
    Animi beatae nam amet pariatur reiciendis minima laborum 
    nobis sit possimus dicta perferendis dignissimos, illo";
    
    echo "this is a simple string \n on a newline again";
    ?>

</body>

</html>