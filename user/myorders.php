<!DOCTYPE html>
<?php 
include'../includes/Role.php';
include'../includes/auth.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css"/>
        <link rel="stylesheet" href="css/index.css"/>
        <title>Chatbot</title>
    </head>
    <body>
    
        <nav class="navbar navbar-expand-lg navbar-light" style="background:brown;">
            <div class="container-fluid">
              <a class="navbar-brand text-light" href="#"> User Dashboard</a>
              <a class="navbar-brand text-light" href="./php/Shopping.php"> Your Shopping</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <span class="right">
                    <a style="text-decoration: none;color:white;font-size:20px;" href="../logout.php">logout</a>
                </span>
            </div>
          </nav>
   <div id="home">
     <p>Welcome to Quickmart Supermarket</P>
   </div>
        <button class="open-button" onclick="openForm()">Chat</button>

        <div class="chat-popup" id="chatbot">
            <div class="form-container">
                <div class="ChatPanel">
                  <div class="row">
                    <div class="col-6">
                      <h1>Chat</h1>
                    </div>
                    <div class="col-6">
                      <button type="button" class="btn cancel"  aria-label="Close" onclick="closeForm()">Close</button>
                    </div>
                  </div>
                </div>
                
                <div class="errorText"></div>
                <div class="chat-container" id="chatmain">
                  <div class="inner-box">
                    <h6>Welcome <?php echo $_SESSION['Username'];?> to Our Contact service</h6>
                    <div class="render" id="render"></div>
                    <div class="chatsection">
                    <hr/>
                        <form class="typing-area"name="chatform" method ="POST">
                            <textarea placeholder="Type message here.." name="msg" id="msgInput"required></textarea>
                            <button type="submit" id="send" class="btn">Send<i class="fab fa-telegram-plane"></i></button>
                         </form>
                    </div>                    
                  </div>
                </div>
                <div class="startChatform"id="proceedform">
                  <form >
                      <label><b> proceed as <?php echo $_SESSION['Username'];?></b></label>
                      <br/><br/>
                      <button type="submit" id ="startChat"class="btn">Yes</button>
                  </form>
                </div>       
                
            </div>
        
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="js/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>
