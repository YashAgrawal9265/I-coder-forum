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
        #quesDiv {
            line-height: 0.5rem;
        }
    </style>
</head>

<body>
    <?php

  include 'partials/_nav.php';
  
 
  
  ?>
    <?php 

//php for inserting the questions--------------

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $quesResult = false;
    $id = $_GET['id'];
    $quesTitle=$_POST['quesTitle'];
    $quesDesc=$_POST['quesDesc'];
    $user_Email = $_SESSION['user_id'];
    $sql = "INSERT INTO `questions` ( `ques_title`, `ques_desc`, `ques_category_id`, `user_id`, `date`) VALUES ( '$quesTitle', '$quesDesc', '$id', '$user_Email', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        $quesResult = true;
        if(($quesResult))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your question has been submittes. Wait for the resoponse.
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

        // php for displaying the thread--------

            $id = $_GET['id'];
            $sql="SELECT * FROM `categories` WHERE category_id = $id";
            $result= mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $name=$row['category_name'];
            $desc = $row['category_desc'];
            echo '<div class="jumbotron py-4">
            <h1 class="display-4">'.$name.'</h1>
            <p class="lead">'.$desc.'</p>
            <hr class="my-4">
            <p> This is peer to peer forum.
                Spam / Advertising / Self-promote in the forums are not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
            <p>
            

            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>';
        ?>
    </div>


    <?php
    
    if(isset($_SESSION['loggedin'])&&($_SESSION['loggedin']))
    {
        echo '<div class="container mb-3">
        <form action="'.$_SERVER["REQUEST_URI"] .'" method="post">
            <h1>Ask you Questions</h1>
            <div class="form-group">
                <label for="quesTitle">Question Title</label>
                <input type="text" class="form-control" id="quesTitle" name="quesTitle" aria-describedby="emailHelp">

            </div>
            <div class="form-group">
                <label for="quesDesc">Elaborate your problem</label>
                <textarea class="form-control" id="quesDesc" name="quesDesc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    else
    {
        echo"<div class='container'><h5 class='font-weight-normal'>Please login to ask the questions.</h5></div>";
    }
    
    ?>
    
    

    <div class="container mb-4">
        <h1>Browse Questions</h1>

        <?php

        //php for displaying jumbotron whem no question is there-------------

            $id = $_GET['id'];
            $sql = "SELECT * FROM `questions` WHERE ques_category_id=$id";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
        
            if ($num == 0)
            {
                echo'<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Threads Found</h1>
                  <p class="lead">Be the first one to ask the questions.</p>
                </div>
              </div>';
            }
        
            //Displaying the quetions asked by the users---------- 
           
            while( $row =mysqli_fetch_assoc($result))
            {
                $title=$row['ques_title'];
                $desc = $row['ques_desc'];
                $quesId = $row['ques_id'];
                $userId=$row['user_id'];
                $time=$row['date'];
                 $date= date("F j, Y", strtotime($time));
                $sql2="SELECT * FROM `user` WHERE `Sr No`='$userId'";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $user=$row2['user_email'];
                echo '<div class="media my-2">  
                <img height=50px src="images/default_user.jfif" class="mr-3" alt="..."><div class="media-body"> <div class="d-flex justify-content-between align-items-center w-100" id="quesDiv">
                <strong class="text-gray-dark">'.$user.'</strong>  <p class="font-weight-bolder" > ' .$date.'</p>
                </div>
                <h5 class="mt-0 mb-0"><a href="\forum\question.php?quesId='.$quesId.'" class="text-dark">'.$title.'</a></h5>
                '.$desc.'
                </div></div>';
            }
            
            ?>

    </div>
    <!-- <p class="mb-0 font-weight-normal">'.$user.'</p> -->

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