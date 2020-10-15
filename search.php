

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>I-Discuss</title>
    <style>
        #main {
            min-height: 84vh;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/_dbconnect.php';
    include 'partials/_nav.php';
    ?>

        <div class="container my-4" id="main">
            
            <?php

            //php for displaying jumbotron whem no question is there-------------
    
                $search = $_GET['search'];
                $sql = "SELECT * FROM `questions` WHERE MATCH (`ques_title`,`ques_desc`) against ('$search')";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                
                echo'<h1>Search results for "<em>'. $search .'</em>"</h1>';
            
                if ($num == 0)
                {
                    echo'<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-4">No Reasults found</h1>
                      <p class="lead">Suggestions:
                            <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                            <ul>
                      </p>
                    </div>
                  </div>';
                }
            
             
               
                while( $row =mysqli_fetch_assoc($result))
                {
                    $title=$row['ques_title'];
                    $desc = $row['ques_desc'];
                    $quesId = $row['ques_id'];
              
                    
                    echo '
                    <h5><a href="\forum\question.php?quesId='.$quesId.'" class="text-dark">'. $title .'</a></h5>
                    <p>'. $desc .'</p>';
                    
                }
                
                ?>
    
        </div>




        <?php
  include 'partials/_footer.php';
  ?>




            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
            </script>
</body>

</html>