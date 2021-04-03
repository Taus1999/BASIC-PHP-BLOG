<?php 
    //REQUIRE CONFIG FILES
    require('config/config.php');
    require('config/db.php');
    
    if(isset($_POST['delete'])) {
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']); 
        
        //delete img from folder
        $delete_image = $_POST['delete_img_name'];
        $imgpath = "image/{$delete_image}";
        unlink($imgpath);
        
        $query = "DELETE FROM posts WHERE id={$delete_id}";
        
        if(mysqli_query($conn, $query)) {
            header('Location: '. ROOT_URL. '');
        } else {
            echo 'Error: '. mysqli_error($conn);
        }


    }

    //get id
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //create Query
    $query = "SELECT * FROM posts WHERE id = {$id}";
    /* $query = 'SELECT * FROM posts WHERE id = '. $id; */

    //Get Result
    $result = mysqli_query($conn, $query);

    //Fetch Data
    $post = mysqli_fetch_assoc($result);
    /* var_dump($posts); */

    //FREE RESULT
    mysqli_free_result($result);

    //Close Connection
    mysqli_close($conn);

?>

<?php include('components/header.php'); ?>
    
<!--     <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
        <div class="container">
            <h1>Posts</h1>
        </div>
    </nav> -->
    <?php include('components/navbar.php'); ?>
    <div class="container">
    
        <a class="btn btn-info my-3" href="<?php echo ROOT_URL; ?>">Go Back</a>
        <div class="jumbotron bg-secondary">
            <img class= "img-responsive img-thumbnail" src="image/<?php echo $post['photo']; ?>" alt="feature image">
            <hr class="my-4">
            <h2 class="display-3"><?php echo $post['title']; ?></h2>               
            <small>Created on <?php echo $post['created_at']; ?>, by <?php echo $post['author']; ?></small>
            <hr class="my-4">
            <p><?php echo $post['body']; ?></p>
        </div>
        <form class="float-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="delete_img_name" value="<?php echo $post['photo']; ?>">
            <input type="submit" class="btn btn-danger px-3" name="delete" value="Delete">
        </form>
        <a class="btn btn-success px-4" href="<?php ROOT_URL; ?>editpost.php?id=<?php echo $post['id'] ?>">Edit</a>
        
    </div>
    
<?php include('components/footer.php'); ?>