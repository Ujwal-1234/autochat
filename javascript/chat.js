const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
chatBox = document.querySelector(".chat-box"),
mode = document.querySelector(".automode"),
sendBtn = form.querySelector("button");
const form2 = document.querySelector(".autochat"),
btn_automode = form2.querySelector(".automode");

form.onsubmit = (e)=>{
    e.preventDefault();
}
form2.onsubmit = (e)=>{
    e.preventDefault();
}


sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
btn_automode.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    console.log('automode clicked');
    xhr.open("POST", "php/_changemode.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
            }
        }
    }
    let formData = new FormData(form2);
    xhr.send(formData);
}




chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                json_data = JSON.parse(data);
                console.log(json_data);
                chatBox.innerHTML=json_data['msg_data'];
                // chatBox.innerHTML=data;
                set_mode(json_data['automode']);
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
                
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
},500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

function set_mode(automode){
    switch(automode){
        case '0' : mode.style.color='red'; break;
        case '1' : mode.style.color='green'; break;
    }
}