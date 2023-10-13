<?php
// Dummy Data drawn from files
        $titles = file('configs/dummyData/titles.txt');
        $texts = file("configs/dummyData/texts.txt");
        $categories = file("configs/dummyData/categories.txt");
        $names = file("configs/dummyData/names.txt");
        $sentences = file("configs/dummyData/sentences.txt");
        $phones = file("configs/dummyData/phones.txt");

// Dummy data passed by url
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else $page='';

// Dummy data created on the spot
        function rand_date($format = 'd M Y')
        {
            $min_epoch = strtotime("-1 year");
            $max_epoch = strtotime("now");
            $rand_epoch = rand($min_epoch, $max_epoch);
            return date($format, $rand_epoch);
        }

// Missing variables
        if (!isset($i)) {
            $i = 0;
        }
        if (!isset($number_of_posts)) {
            $number_of_posts = 0;
        }