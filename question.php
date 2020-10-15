<?php
include 'partials/_dbconnect.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>I-Discuss</title>
    <style>
        #commentDiv {
            line-height: 0.5rem;
        }
    </style>
</head>

<body>
    <?php
  include 'partials/_nav.php';
  ?>

    <!-- php for inserting the comments -->

    <?php
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $commAlert=false;
        $quesId=$_GET['quesId'];
        
        $comments = $_POST['comments'];
        $user_Email = $_SESSION['user_id'];
        $sql = "INSERT INTO `comments` ( `comment_desc`, `ques_id`, `date`,`user_id`) VALUES ( '$comments', '$quesId', current_timestamp(),' $user_Email')";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            $commAlert=true;
            if($commAlert)
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been posted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            }
        }
    }
    ?>
    <div class="container my-3">
        <?php
            $quesId = $_GET['quesId'];
            $sql="SELECT * FROM `questions` WHERE ques_id = $quesId";
            $result= mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $title=$row['ques_title'];
            $desc = $row['ques_desc'];
            $user_id=$row['user_id'];
            $sql2="SELECT * FROM `user` WHERE `Sr No`='$user_id'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $user=$row2['user_email'];

            echo '<div class="jumbotron py-4">
            <h1 class="display-4">'.$title.'</h1>
            <p class="lead">'.$desc.'</p>
            <hr class="my-4">
            <p> This is peer to peer forum.
                Spam / Advertising / Self-promote in the forums are not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
            <p>
            

            <p class = "font-weight-bold">Posted by: '. $user .'</b></p>
        </div>';
        ?>
    </div>

    <!-- Posting the comments -->
    <?php
    if(isset($_SESSION['loggedin'])&&($_SESSION['loggedin']))
    {
        echo'
        <div class="container">
            <h1>Post yor Comment</h1>
            <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your Comment</label>
                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                </div>
    
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>';
    }
    else
    {
        echo"<div class='container'><h5 class='font-weight-normal'>Please login to post the comments.</h5></div>";
    }
    ?>


    <!-- php for displaying the comments -->

    <div class="container mb-4">
        <h1>Discussions</h1>
        <?php
            $id = $_GET['quesId'];
            $sql = "SELECT * FROM `comments`where ques_id=$id";
            $result= mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num==0)
            {
                echo'<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Comments Found</h1>
                  <p class="lead">Be the first one to make a comment.</p>
                </div>
              </div>';
            }
            else 
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $commDesc = $row['comment_desc'];
                    $user = $row['user_id'];
                    $sql2="SELECT user_email FROM `user` WHERE `Sr No`='$user'";
                    $result2=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($result2);
                    $user_email=$row2['user_email'];
                    $time = $row['date'];
                    $date= date("F j, Y", strtotime($time));
                    echo ' <div class="media my-2">
                        <img height=50px src="images/default_user.jfif" class="mr-3" alt="..."><div class="media-body">
                        <div class="d-flex justify-content-between align-items-center w-100" id="commentDiv">
                        <strong class="text-gray-dark">'.$user_email.'</strong>  <p class="font-weight-bolder" > ' .$date.'</p>
                        </div>
                        '.$commDesc.'
                        </div></div>';
                }
            }
        ?>




    </div>

    <?php
  include 'partials/_footer.php';
  ?>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
</body>

</html>