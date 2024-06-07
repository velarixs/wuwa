<?php

include '../components/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/user_style.css">

</head>
<body>

<?php include 'user_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>welcome!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <div class="box">
      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ?");
         $select_posts->execute([$user_id]);
         $numbers_of_posts = $select_posts->rowCount();
      ?>
      <h3><?= $numbers_of_posts; ?></h3>
      <p>posts added</p>
      <a href="add_posts.php" class="btn">add new post</a>
   </div>

   <div class="box">
      <?php
         $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ? AND status = ?");
         $select_active_posts->execute([$user_id, 'active']);
         $numbers_of_active_posts = $select_active_posts->rowCount();
      ?>
      <h3><?= $numbers_of_active_posts; ?></h3>
      <p>active posts</p>
      <a href="view_posts.php" class="btn">see posts</a>
   </div>

   <div class="box">
      <?php
         $select_inactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ? AND status = ?");
         $select_inactive_posts->execute([$user_id, 'inactive']);
         $numbers_of_inactive_posts = $select_inactive_posts->rowCount();
      ?>
      <h3><?= $numbers_of_inactive_posts; ?></h3>
      <p>deactive posts</p>
      <a href="view_posts.php" class="btn">see posts</a>
   </div>
   
   <div class="box">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
         $select_comments->execute([$user_id]);
         $select_comments->execute();
         $numbers_of_comments = $select_comments->rowCount();
      ?>
      <h3><?= $numbers_of_comments; ?></h3>
      <p>comments added</p>
      <a href="comments.php" class="btn">see comments</a>
   </div>

   <div class="box">
      <?php
         $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
         $select_likes->execute([$user_id]);
         $select_likes->execute();
         $numbers_of_likes = $select_likes->rowCount();
      ?>
      <h3><?= $numbers_of_likes; ?></h3>
      <p>total likes</p>
      <a href="view_posts.php" class="btn">see posts</a>
   </div>

   </div>

</section>

<!-- user dashboard section ends -->










<!-- custom js file link  -->
<script src="../js/user_script.js"></script>

</body>
</html>