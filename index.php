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
</head>

<body>
    <?php
  include 'partials/_nav.php';
  if(isset($signup))
  {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are signup successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  ?>

    <!-- Making a Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x800/?coding,apple" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x800/?coding,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x800/?code,apple" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Creating cards and pulling data from the database -->

    <div class="container my-4">
        <h1 class="text-center">I-Discuss - Browse Categories</h1>
        <div class="row d-flex justify-content-center align-items-center">
            <!-- Pulling data from the database -->
            <?php
           $sql = "SELECT * FROM `categories`";
           $result = mysqli_query($conn, $sql);
           
           while($row = mysqli_fetch_assoc($result))
           {
               $id=$row['category_id'];
               $name=$row['category_name'];
            $desc = $row['category_desc'];
               echo ' <div class="co-md-4 my-3 mx-3">
               <div class="card" style="width: 18rem;">
                   <img src="https://source.unsplash.com/500x400/?'.$name.',coding"
                       class="card-img-top" alt="...">
                   <div class="card-body">
                       <h5 class="card-title"><a href="\forum\threadlist.php?id='.$id.'" class="text-dark">'.$name.'</a></h5>
                       <p class="card-text maxlenght="50">'.substr($desc,0,200).'...</p>
                       <a href="\forum\threadlist.php?id='.$id.'" class="btn btn-primary">View thread</a>
                   </div>
               </div>
           </div>';
           }
           
           
           ?>


        </div>
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