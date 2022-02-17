# evote-movie-2022-05-movie-class-loop


part of the evote-2022 project sequence

- [https://github.com/dr-matt-smith/evote-movie-2022](https://github.com/dr-matt-smith/evote-movie-2022)


## NOTES for this project step

List details from array of `Movie` objects

- declare a PHP class `/src/Movie.php` for data about movie objects

    ```php
    <?php
    namespace Tudublin;
    
    class Movie
    {
        private int $id;
        private string $title;
        private string $category;
        private float $price;
        private int $voteTotal;
        private int $numVotes;
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function setId(int $id): void
        {
            $this->id = $id;
        }
    
        public function getTitle(): string
        {
            return $this->title;
        }
    
        ... and so on - getters/setters for all properties ...
    ```

    - note we store number of  votes `numVotes` and `voteTotal` making it easy to calculate the average vote

        - and also it will be easy to ADD a new vote, by adding to the total and incrementing `numVotes` ...

- add to class `Movie` method `getVoteAverage()`, which returns an integer average (total votes / num votes):

    ```php
    /**
     * integer average vote percentage (0..100)
     */
    public function getVoteAverage(): int
    {
        // avoid divide by zero problem ...
        if($this->numVotes < 1){
            return 0;
        }
        return intval($this->voteTotal / $this->numVotes);
    }
    ```

- add to class `Movie` a method `getStarImage()` which returns a star image name, based on the vote averge:

    ```php
    public function getStarImage(): string
    {
        if($this->getVoteAverage() > 85){
            return 'stars5.png';
        }
        if($this->getVoteAverage() > 70){
            return 'stars4.png';
        }
        if($this->getVoteAverage() >= 50){
            return 'stars3.png';
        }
        if($this->getVoteAverage() > 40){
            return 'stars2.png';
        }
        if($this->getVoteAverage() > 15){
            return 'stars1.png';
        }
    
        // if get here, less than 16%, so a half-star
        return 'starsHalf.png';
    }
    ```

- create a new class `/src/MovieFixtures.php` that declares a single method `getObjectArray()`. This method creates some `Movie` objects, and returns an array containing these objects. These objects will become the intial data to be displayed for out movie list page:

  ```php
        namespace Tudublin;
        
        class MovieFixtures
        {
            // return an array of objects, to become initial data in the database
            public function getObjectArray()
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
                
                return $movies;
            }
        }
  ```

- update the `list()` method of class `MainController` to get the array of objects from a `MovieFixtures` instance, and pass that array of `Movie` objects to the movie list template

    ```php
        public function list()
        {
            $movieFixtures = new MovieFixtures();
            $movies = $movieFixtures->getObjectArray();

            require_once __DIR__ . '/../templates/list.php';
        }  
    ```

- refactor the movie list template `/templates/list.php` to loop through the array `movies`, using the getter values, and star image method, to populate each table row:

    ```php
        <table>
            <tr>
                <th> ID </th>
                <th> title </th>
                <th> category </th>
                <th> price </th>
                <th> vote average </th>
                <th> num votes </th>
                <th> stars </th>
            </tr>

            <?php foreach($movies as $movie): ?>
            <tr>
                <td><?= $movie->getId() ?></td>
                <td><?= $movie->getTitle() ?></td>
                <td><?= $movie->getCategory() ?></td>
                <td>&euro; <?= $movie->getPrice() ?></td>
                <td><?= $movie->getVoteAverage() ?> %</td>
                <td><?= $movie->getNumVotes() ?></td>
                <td>
                    <?php if($movie->getNumVotes() > 0): ?>
                    <img src="images/<?= $movie->getStarImage() ?>" alt="star image for percentage">
                    <?php else: ?>
                    (no votes yet)
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    ```
