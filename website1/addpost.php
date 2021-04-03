<?php 
    //REQUIRE CONFIG FILES
    require('config/config.php');
    require('config/db.php');

    if(isset($_POST['submit'])) {
        

        $title = mysqli_real_escape_string($conn, $_POST['title']); 
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);


        $photoname = $_FILES['photo']['name'];
        $tempname = $_FILES['photo']['tmp_name'];
        $folder = "image/".$photoname;

        $query = "INSERT INTO posts(title, author, body, photo) VALUES('$title', '$author', '$body', '$photoname')";

        /* move_uploaded_file($tempname, $folder); */

        if(mysqli_query($conn, $query) && move_uploaded_file($tempname, $folder)) {
            header('Location: '. ROOT_URL. '');
        } else {
            echo 'Error: '. mysqli_error($conn);
        }


    }
?>


<?php include('components/header.php'); ?>

    <?php include('components/navbar.php'); ?>


    <div class="container">
        
        <div class="jumbotron bg-secondary my-4">
            <h2 class="display-3">Add Post</h2>
            <hr class="my-4">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Upload Photo:</label>
                <input type="file" name="photo" required>
            </div>
            <input type="submit" class="btn btn-info btn-lg" name="submit" value="submit">
            
            </form>
                
        </div>
        
    </div>

<?php include('components/footer.php'); ?>
    
