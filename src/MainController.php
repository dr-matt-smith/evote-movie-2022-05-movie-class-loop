<?php

namespace Tudublin;

class MainController
{
    public function index()
    {
        require_once __DIR__ . '/../templates/index.php';
    }

    public function about()
    {
        require_once __DIR__ . '/../templates/about.php';
    }

    public function contact()
    {
        require_once __DIR__ . '/../templates/contact.php';
    }
    
    public function sitemap()
    {
        require_once __DIR__ . '/../templates/sitemap.php';
    }

        public function list()
        {
            $movies = [];

            $m1 = new Movie();
            $m1->setId(1);
            $m1->setTitle('Jaws');
            $m1->setPrice(10.00);
            $m1->setCategory('horror');
            $m1->setNumVotes(5);
            $m1->setVoteTotal(300);
            $movies[] = $m1;

            $m2 = new Movie();
            $m2->setId(2);
            $m2->setTitle('Aliens');
            $m2->setPrice(19.99);
            $m2->setCategory('scifi');
            $m2->setNumVotes(1);
            $m2->setVoteTotal(75);
            $movies[] = $m2;

            $m3 = new Movie();
            $m3->setId(3);
            $m3->setTitle('Shrek');
            $m3->setPrice(5.99);
            $m3->setCategory('cartoon');
            $m3->setNumVotes(2);
            $m3->setVoteTotal(100);
            $movies[] = $m3;

            require_once __DIR__ . '/../templates/list.php';
        }

}