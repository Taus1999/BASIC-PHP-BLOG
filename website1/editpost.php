<?php 
    //REQUIRE CONFIG FILES
    require('config/config.php');
    require('config/db.php');

    if(isset($_POST['submit'])) {
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']); 
        $title = mysqli_real_escape_string($conn, $_POST['title']); 
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);

        $query = "UPDATE posts SET
                    title ='$title',
                    author = '$author',
                    body = '$body'
                        WHERE id = {$update_id}";

        if(mysqli_query($conn, $query)) {
            header('Location: '. ROOT_URL. '');
        } else {
            echo 'Error: '. mysqli_error($conn);
        }


    }
        //get id
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        //create Query
        $query = 'SELECT * FROM posts WHERE id = '. $id;

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

    <?php include('components/navbar.php'); ?>


    <div class="container">
        
        <div class="jumbotron bg-secondary my-4">
            <h2 class="display-3">Add Post</h2>
            <hr class="my-4">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"><?php echo $post['body']; ?></textarea>
            </div>
            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
            <input type="submit" class="btn btn-info btn-lg" name="submit" value="submit">
            
            </form>
                
        </div>
        
    </div>

<?php include('components/footer.php'); ?>
    
