<?php 
    //REQUIRE CONFIG FILES
    require('config/config.php');
    require('config/db.php');
    
    //create Query
    $query = 'SELECT * FROM posts ORDER BY created_at DESC';

    //Get Result
    $result = mysqli_query($conn, $query);

    //Fetch Data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    /* var_dump($posts); */

    //FREE RESULT
    mysqli_free_result($result);

    //Close Connection
    mysqli_close($conn);

?>


<?php include('components/header.php'); ?>

    <?php include('components/navbar.php'); ?>


    <div class="container">
        <?php foreach($posts as $post) : ?>
            <div class="jumbotron bg-secondary my-4">
                <div class="row">
                    <div class="col">
                        <h3 class="display-3"><?php echo $post['title']; ?></h3>
                        <small>Created on <?php echo $post['created_at']; ?>, by <?php echo $post['author']; ?></small>
                    </div>
                    <div class="col">
                       <img class= "img-responsive img-thumbnail" src="image/<?php echo $post['photo']; ?>" alt="feature image">
                    
                    </div>
                </div>


                <hr class="my-4">
                <p><?php echo $post['body']; ?></p>
                <a class="btn btn-primary"  href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </div>
        <?php endforeach; ?>
    </div>

<?php include('components/footer.php'); ?>
    
