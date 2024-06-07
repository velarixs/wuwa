<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>author</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->


<section class="authors">

   <h1 class="heading">authors</h1>

   <div class="box-container">

   <?php
      $select_author = $conn->prepare("SELECT * FROM `user`");
      $select_author->execute();
      if($select_author->rowCount() > 0){
         while($fetch_authors = $select_author->fetch(PDO::FETCH_ASSOC)){ 

            $count_user_posts = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ? AND status = ?");
            $count_user_posts->execute([$fetch_authors['id'], 'active']);
            $total_user_posts = $count_user_posts->rowCount();

            $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $count_user_likes->execute([$fetch_authors['id']]);
            $total_user_likes = $count_user_likes->rowCount();

            $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
            $count_user_comments->execute([$fetch_authors['id']]);
            $total_user_comments = $count_user_comments->rowCount();

   ?>
   <div class="box">
      <p>author : <span><?= $fetch_authors['first_name']; ?></span></p>
      <p>total posts : <span><?= $total_user_posts; ?></span></p>
      <p>posts likes : <span><?= $total_user_likes; ?></span></p>
      <p>posts comments : <span><?= $total_user_comments; ?></span></p>
      <a href="author_posts.php?author=<?= $fetch_authors['first_name']; ?>" class="btn">view posts</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no authors found</p>';
   }
   ?>

   </div>
      
</section>











<?php include 'components/footer.php'; ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>