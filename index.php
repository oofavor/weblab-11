<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Лабораторная 11 - Глушков</title>
    <style>
    </style>
</head>

<body>

    <?php
    $type = "none";
    if (isset($_GET['type'])) {
        if ($_GET['type'] == 'block')
            $type = 'block';
        else
            $type = 'table';
    }

    $number = "none";
    if (isset($_GET['number'])) {
        if ($_GET['number'] == "all")
            $number = 'all';
        else
            $number = (int) $_GET['number'];
    }

    function generate($type, $number)
    {
        if ($type == "none") {
            $type = "table";
        }
        if ($number == "none") {
            $number = "all";
        }
        if ($number == "all") {
            for ($i = 2; $i < 10; $i++) {
                if ($type == "table")
                    generateTable($i);
                else
                    generateBlock($i);
            }
            return;
        }
        if ($type == "table")
            generateTable($number);
        else
            generateBlock($number);
    }
    function extractLink(int $num): string
    {
        $numstr = (string) $num;
        if (strlen($numstr) == 1) {
            if ($num < 2 || $num > 9)
                return $num;
            return "<a href='?number=$num'>$num</a>";
        }

        if (strlen($numstr) == 2) {
            $num1 = (int) $numstr[0];
            $num2 = (int) $numstr[1];

            $link1 = "<a href='?number=$num1'>$num1</a>";
            $link2 = "<a href='?number=$num2'>$num2</a>";

            if ($num1 < 2 || $num1 > 9)
                $link1 = $num1;
            if ($num2 < 2 || $num2 > 9)
                $link2 = $num2;

            return $link1 . $link2;
        }

        return $numstr;
    }
    function generateTable($number)
    {
        echo '<table>';
        for ($i = 1; $i <= 9; $i++) {
            $link1 = extractLink($number);
            $link2 = extractLink($i);
            $link3 = extractLink($i * $number);

            echo '<tr>';
            echo "<td>$link1 * $link2</td>";
            echo '<td>' . $link3 . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    function generateBlock($number)
    {
        echo '<div class="block">';
        for ($i = 1; $i <= 9; $i++) {
            $link1 = extractLink($number);
            $link2 = extractLink($i);
            $link3 = extractLink($i * $number);

            echo '<div class="line">';
            echo "<p>$link1 * $link2 = $link3</p>";
            echo '</div>';
        }
        echo '</div>';
    }

    ?>

    <header class="header">
        <div>
            <h1>Глушков Андрей</h1>
            <p>Group: 221-362</p>
            <p>Lab: 10 (Variant 4)</p>
        </div>
        <a href="?type=table<?php echo $number != "none" ? "&number=$number" : "" ?>" <?php echo ($type == 'table') ? 'class="active"' : ''; ?>>Табличная верстка</a>
        <a href="?type=block<?php echo $number != "none" ? "&number=$number" : "" ?>" <?php echo ($type == 'block') ? 'class="active"' : ''; ?>>Блочная верстка</a>
        <img class="header-logo" src="static/img/logo.png" alt="University Logo" />
    </header>

    <nav class="nav-nums">
        <?php
        for ($i = 1; $i <= 9; $i++) {
            $class = (($number == $i) ? 'class="active"' : '');
            if ($i == 1) {
                $class = (($number == "all") ? 'class="active"' : '');
            }
            $link = "?number=$i";
            if ($i == 1) {
                $link = "?number=all";
            }
            if ($type != "none") {
                $link .= "&type=$type";
            }
            echo "<a href='$link' $class >" . ($i == 1 ? "Все" : $i) . '</a>';
        }
        ?>
    </nav>

    <main>
        <?php generate($type, $number); ?>
    </main>

    <footer class="footer-container">
        <div class="footer-icon-container">
            <a class="footer-social-icon" href="https://github.com/oofavor">
                <img src="static/icon/social-github.svg" alt="github" />
            </a>
            <a class="footer-social-icon" href="#">
                <img src="static/icon/social-reddit.svg" alt="reddit" />
            </a>
            <a class="footer-social-icon" href="#">
                <img src="static/icon/social-twitter.svg" alt="twitter" />
            </a>
            <a class="footer-social-icon" href="#">
                <img src="static/icon/social-facebook.svg" alt="facebook" />
            </a>
        </div>
        <p>Тип верстки:
            <?php echo $type == 'block' ? 'Блочная верстка' : 'Табличная верстка'; ?> |
            Название таблицы:
            <?php echo $number == "all" ? 'Полная таблица' : 'Таблица на ' . $number; ?> |
            Дата и время:
            <?php echo date('Y-m-d H:i:s'); ?>
        </p>
        <div>
            Phone:
            <a href="tel:+79999999999" class="footer-link">+79999999999</a>
            | Email:
            <a href="mailto:favorxog@gmail.com" class="footer-link">favorxog@gmail.com</a>
        </div>
        <div>© 2023 Andrey Glushkov | All Rights Reserved</div>
    </footer>
</body>

</html>