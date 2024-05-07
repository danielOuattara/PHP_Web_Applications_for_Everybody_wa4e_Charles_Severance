<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p>Many field types...</p>
    <form method="post" action="more.php">
        <p>
            <label for="account">Account:</label>
            <input type="text" name="account" id="account" size="40">
        </p>

        <p>
            <label for="password">Password:</label>
            <input type="password" name="pw" id="password" size="40">
        </p>

        <p>
            <label for="nick">Nick Name:</label>
            <input type="text" name="nick" id="inp03" size="40">
        </p>

        <p>radio: preferred Time:<br />
            <input type="radio" name="when" value="am">AM<br>
            <input type="radio" name="when" value="pm" checked>PM
        </p>

        <p>radio: preferred Time 2:<br />
            <input type="radio" name="when_2" value="am">AM<br>
            <input type="radio" name="when_2" value="pm">PM
        </p>

        <p>checkbox: class(es) taken:<br />
            <input type="checkbox" name="class1" value="si502" checked>
            SI502 - Networked Tech<br>
            <input type="checkbox" name="class2" value="si539">
            SI539 - App Engine<br>
            <input type="checkbox" name="class3">
            SI543 - Java<br>
        </p>

        <p>
            <label for="drinks">drop down select: which drinks:
                <select name="drinks" id="drinks">
                    <option value="null">-- Please Select --</option>
                    <option value="1">Coke</option>
                    <option value="2">Pepsi</option>
                    <option value="3">Mountain Dew</option>
                    <option value="4">Orange Juice</option>
                    <option value="5">Lemonade</option>
                </select>
            </label>
        </p>

        <p>
            <label for="snack">Which snack:
                <select name="snack" id="snack">
                    <option value="">-- Please Select --</option>
                    <option value="chips">Chips</option>
                    <option value="peanuts" selected>Peanuts</option>
                    <option value="cookie">Cookie</option>
                </select>
            </label>
        </p>

        <p>
            <label for="about">Tell us about yourself:<br />
                <textarea rows="10" cols="40" id="about" name="about">
                    I love building web sites in PHP and MySQL.
                </textarea>
            </label>
        </p>

        <p>
            <label for="code">Which are awesome?<br />
                <select multiple="multiple" name="code" id="code">
                    <option value="python">Python</option>
                    <option value="css">CSS</option>
                    <option value="html">HTML</option>
                    <option value="php">PHP</option>
                </select>
            </label>
        </p>

        <p>
            <input type="submit" name="submit" value="Submit" />
            <input type="button" onclick="location.href='http://www.wa4e.com/'; return false;" value="Escape">
        </p>

    </form>


    <pre>
    $_POST:
    <?php
    print_r($_POST);
    ?>
    </pre>

</body>

</html>