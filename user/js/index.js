const openForm =()=> document.getElementById("chatbot").style.display = "block";   
const closeForm =()=> document.getElementById("chatbot").style.display = "none";


document.getElementById("startChat").addEventListener("click",
  function(e){
    e.preventDefault();
    document.getElementById("proceedform").style.display = "none";
    document.getElementById("chatmain").style.display = "block";
  }
);
const errorText = document.querySelector(".errorText");
const chatform = document.querySelector(".chatsection form");
const render = document.getElementById("render");
document.getElementById("send").addEventListener("click",
  function(e){
        e.preventDefault();
        var msg=document.getElementById("msgInput").value;
        if(msg !=''){
            render.innerHTML += "<div class='question' id='right'>"+msg+"</div>";            
            window.setTimeout(postChat, 1000);
            render.scrollTop = render.scrollHeight;
        }
        
  });



  const getresponses =()=>{
      let xhr = new XMLHttpRequest();
      xhr.open("GET","./php/processing.php",true);
      xhr.onload = () =>{
          if(xhr.readyState === XMLHttpRequest.DONE){
              if(xhr.status ===200){
                  let data = xhr.response;
                  
              }
          }
      }
      xhr.send();
  }

// ajax
    const postChat= ()=>{
            $value = $("#msgInput").val().trim();
            $("#msgInput").val('');
            // start ajax code
            $.ajax({
                url: "../user/php/processing.php",
                type: 'POST',
                data: 'msg='+$value,
                success: function(result){
                    document.getElementById('render').innerHTML += "<div class='question' id='left'>"+result+"</div>";                 
                    render.scrollTop = render.scrollHeight;
                }
            });
        }