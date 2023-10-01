
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    // User is not authenticated, redirect to the sign-in page
    header("Location: signin.php");
    //exit();
}
// Display dashboard content here
?>

<?php

    $insert = false;
    $update = false;
    $delete =false;

    $servername = "localhost";
    $username = "root";
    $password = "bharti";
    $db = "sharethoughts";
    $port = "3306";
    $conn = mysqli_connect($servername,$username,$password,$db,$port);  

    if(!$conn)
    {
        die(" Sorry we are failed to connect " . mysqli_connect_error());
    }

    if(isset($_GET['delete']))
    {
        $sno = $_GET['delete'];
        $sql = "delete from quote where sno = " . $sno . ";";
        //echo $sql;
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $delete = true;
        }
        else{
            echo " not deleted";
        }
    }

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_POST['snoEdit']))
        {
            $sno = $_POST["snoEdit"];
            $title = $_POST["titleEdit"];
            $description = $_POST["descriptionEdit"];
            $sql = "Update quote set title = '". $title . "' , description = '" . $description . "' where sno = " . $sno . ";";
           //echo $sql;
            $result = mysqli_query($conn , $sql);
            if($result)
            {
                $update = true;
            }
            else{
                echo " not updated";
            }
        }
        else{
            $title = $_POST["title"];
            $description = $_POST["description"];
            $insert_query = "insert into quote (title , description) values( '$title' , '$description')";
            $result = mysqli_query($conn , $insert_query);
            if($result)
            {
                $insert = true;
            }
            else
            {
                echo "error in insertion";
                mysqli_error($conn);
            } 
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
          <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
            integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <title>Share Thoughts</title>
  </head>

  <body style= "background-image: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);">



<!--edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit Quote</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/php/Sharethoughts/index.php" method="POST">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
                <label for="title" class="form-label">Quote Title</label>
                <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group my-2">
                <label for="description" class="form-label">Quote description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <div class="modal-footer d-block mr-auto">
                <button type="submit" class="btn btn-primary">Update Quote</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/php/Sharethoughts/PHP-logo.svg.png" height ="34px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/php/Sharethoughts/index.php">Home</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <h3 style = "font-family:georgia,garamond,serif; margin-inline: 45px;">Welcome, <?php echo $_SESSION["username"]; ?>!</h3>
    <?php
        if($insert)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong>your quote are displayed.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
    ?>
    <?php
        if($update)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong>your quote are updated.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
    ?>
    <?php
        if($delete)
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong>your quote are deleted.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
    ?>

    <div class="contanier my-4 mx-5">
        <h2>Add a Quote </h2>
        <form action="/php/Sharethoughts/index.php" method="POST">
            <div class="form-group">
                <label for="title" class="form-label">Quote Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Share your thoughts with us!!!!!.....</div>
            </div>
            <div class="form-group my-2">
                <label for="description" class="form-label">Quote description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Share Quote</button>
        </form>
    </div>

    <div class="contanier">
        <table class="table mx-auto p-2" id = "quoteTable">
            <thead>
                <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $query = "select * from quote";
                $res = mysqli_query($conn,$query);
                $sno = 0;
                while($row = mysqli_fetch_assoc($res))
                {
                    $sno++;
                    echo "<tr>
                    <th scope='row'>". $sno . "</th>
                    <td> " . $row['title'] . "</td>
                    <td> " . $row['description'] . "</td>
                    <td><button class = 'edit btn btn-sm btn-primary' id = " . $row['sno'] . " >edit</button> <button class = 'delete btn btn-sm btn-primary' id = d" . $row['sno'] . " >delete</button>
                    </tr>";
                }
            ?>     
            </tbody>
        </table>
    </div>
    <hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>

      <script
      src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
      integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>

       <script>
         $(document).ready( function () 
         {
            $('#quoteTable').DataTable();
        } );
       </script>
       <script>
            edits = document.getElementsByClassName('edit');
            Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e) => {
            console.log("edit ", );
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            console.log(title,description);
            titleEdit.value = title;
            descriptionEdit.value = description;
            snoEdit.value = e.target.id;
            console.log(e.target.id);
            $('#editModal').modal('toggle')
        })
    })

        deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element)=>{
            element.addEventListener("click", (e) => {
            console.log("edit ", );
            sno = e.target.id.substr(1,);

            if(confirm("Are sure you want to delete?"))
            {
                console.log("yes");
                window.location = `/php/Sharethoughts/index.php?delete=${sno}`;
                //to redirect the page again in the main page.
            }
            else{
                console.log("no");
            }
        })
    })
       </script>
       <a href="signout.php"><button class = 'edit btn btn-sm btn-primary' style = "font-family:georgia,garamond,serif; margin-inline: 45px;">Sign Out</button></a>
</body>
</html>