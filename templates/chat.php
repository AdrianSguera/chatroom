<?php
include("session.php");
include('connection.php');
isSession();
if (isset($_FILES['image'])) {
    editImage($_FILES['image']['name'], $_SESSION['username']);
    move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $_FILES['image']['name']);
    header('Location: chat.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/chat.css">
    <title>ChatRoom</title>
</head>

<body>
    <div class="container content">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div id='userSection' class="user-card">
                    <?php
                    $image = getImageById(getIdByUsername($_SESSION['username']));
                    ?>
                    <img src="../assets/img/<?php echo $image; ?>" alt="avatar">
                    <form action="" method="post" id="editForm" enctype="multipart/form-data">
                        <label>Change profile picture:</label>
                        <input type="file" name="image" accept="image/*">
                        <input type="submit" value="Apply">
                    </form>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">Chat</div>
                    <div class="card-body height3">
                        <ul id="messageList" class="chat-list">
                            <!-- chat room -->
                        </ul>
                    </div>
                    <form action="" id="messageForm">
                        <input type="text" name="content" id="textinput" placeholder="Write here...">
                        <button type="submit"><img src="../assets/img/send-icon.png" alt="send"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/chat.js"></script>
</body>

</html>