<?php
    require_once './functions.php';

    $airports = require './airports.php';
    $currentPage = 1;
    $startPage = 0;
    $endPage = 10;

// Filtering
/**
 * Тут вам потрібно перевірити $ _GET запит, якщо він має якусь фільтрацію
 * застосовуйте фільтрацію за першою літереєю за назвою аеропорту та / або штатом аеропорту
 * (див. завдання фільтрації 1 і 2 нижче)
 */

// Sorting
/**
 * Тут вам потрібно перевірити $ _GET запит, якщо він має ключ сортування 
 * та застосувати сортування
 * (див. завдання сортування нижче)
 */

    $urlFilter_by_first_letter = '';
    $urlFilter_by_state = '';
    $urlSort = '';

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if(isset($_GET['filter_by_first_letter'])){ 
            $filter = $_GET['filter_by_first_letter'];
            $urlFilter_by_first_letter .= '&filter_by_first_letter=' . $_GET['filter_by_first_letter'];
            $airports = array_filter($airports, function($item) use($filter){
                return $item['name'][0] == $filter;
            });
        }
        if(isset($_GET['sort'])){
            $urlSort .= '&sort='. $_GET['sort'];
            $sortContent = $_GET['sort'];
            usort($airports, function($a, $b) use($sortContent){
                return strnatcmp($a[$sortContent], $b[$sortContent]);
            });
        }
        if(isset($_GET['filter_by_state'])){
            $filterValue = $_GET['filter_by_state'];
            $urlFilter_by_state .= '&filter_by_state=' . $_GET['filter_by_state'];
            $airports = array_filter($airports, function($item) use($filterValue){
                return $item['state'] == $filterValue;
            });
        }
        if(isset($_GET['page'])){
            $currentPage = $_GET['page'];
        }else {
            $currentPage = 1;
        }
        $airports = array_chunk($airports, 5, true);
    }

// Pagination
/**
 * Тут вам потрібно перевірити $ _GET запит, якщо він має ключ пагінації
 * та застосувати логіку пагінації
 * (див. завдання з нумерації сторінок нижче)
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Завдання фільтрації No1
         Замініть # в атрибуті HREF так, щоб посилання йшло на ту саму сторінку клавішею filter_by_first_letter
         тобто /?filter_by_first_letter=A або /?filter_by_first_letter=B
         Переконайтеся, що логіка нижче також працює:
          - коли ви застосовуєте filter_by_first_letter, сторінка повинна дорівнювати 1
          - коли ви застосовуєте filter_by_first_letter, тоді filter_by_state (див. Завдання фільтрації №2) не скидається
            тобто якщо ви встановили filter_by_state, ви можете додатково використовувати filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="index.php?filter_by_first_letter=<?= $letter . $urlFilter_by_state . $urlSort?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="index.php?" class="float-right">Reset all filters</a>
    </div>

    <!--
    Завдання сортування
         Замініть # у HREF, щоб посилання переходило на ту саму сторінку клавішею сортування з належним значенням сортування
         тобто /?sort=name або /?sort=code тощо
         Переконайтеся, що логіка нижче також працює:
          - при застосуванні сортування пагінація та фільтрація не скидаються
            тобто якщо у вас вже є /?page=2&filter_by_first_letter=A після застосування сортування URL-адреса повинна виглядати так
            /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="index.php?sort=name&page=<?=$currentPage . $urlFilter_by_first_letter . $urlFilter_by_state ?>">Name</a></th>
            <th scope="col"><a href="index.php?sort=code&page=<?=$currentPage . $urlFilter_by_first_letter . $urlFilter_by_state ?>">Code</a></th>
            <th scope="col"><a href="index.php?sort=state&page=<?=$currentPage . $urlFilter_by_first_letter . $urlFilter_by_state ?>">State</a></th>
            <th scope="col"><a href="index.php?sort=city&page=<?=$currentPage . $urlFilter_by_first_letter . $urlFilter_by_state ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Завдання фільтрації No2
             Замініть # у HREF, щоб посилання йшло на ту саму сторінку за допомогою ключа filter_by_state
             тобто /?filter_by_state=A або /?filter_by_state=B
             Переконайтеся, що логіка нижче також працює:
              - коли ви застосовуєте filter_by_state, сторінка повинна дорівнювати 1
              - коли ви застосовуєте filter_by_state, тоді filter_by_first_letter (див. завдання фільтрації №1) не скидається
                тобто, якщо ви встановили filter_by_first_letter, ви можете додатково використовувати filter_by_state
        -->
        <?php
            if($airports):
                foreach ($airports[$currentPage-1] as $airport): ?>
                    <tr>
                        <td><?= $airport['name'] ?></td>
                        <td><?= $airport['code'] ?></td>
                        <td><a href="index.php?&filter_by_state=<?=$airport['state'] . $urlFilter_by_first_letter . $urlSort?>"><?= $airport['state'] ?></a></td>
                        <td><?= $airport['city'] ?></td>
                        <td><?= $airport['address'] ?></td>
                        <td><?= $airport['timezone'] ?></td>
                    </tr>
        <?php 
                endforeach;
            endif;
        ?>
        </tbody>
    </table>

    <!--
        Завдання пагінації
        Замініть HTML нижче, щоб він відображав реальні сторінки залежно від кількості аеропортів після всіх застосованих фільтрів
        Переконайтеся, що логіка нижче також працює:
          - показати 5 аеропортів на сторінці
          - використовувати ключ сторінки (тобто /? page = 1)
          - при застосуванні пагінації - усі фільтри та сортування не скидаються
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php
                if($startPage + 5 < $currentPage ){
                    $startPage = $currentPage - 4;
                    $endPage = $currentPage + 7;
                }
                for ($i = $startPage + 1; $i < count($airports) + 1 && $i < $endPage; $i++){
                    if($i == $currentPage){
            ?>  
                        <li class="page-item active"><a class="page-link" href="index.php?page=<?=$i . $urlFilter_by_first_letter . $urlFilter_by_state?>"><?= $i?></a></li>
            <?php
                    } else {
            ?>
                        <li class="page-item"><a class="page-link" href="index.php?page=<?=$i . $urlFilter_by_first_letter . $urlFilter_by_state?>"><?= $i?></a></li>
            <?php 
                    }
                }
            ?>
        </ul>
    </nav>
</main>
</html>