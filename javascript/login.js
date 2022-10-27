const form = document.querySelector(".login form"),
errorText = document.querySelector(".error-txt"),
continueBtn = form.querySelector(".button input");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                // console.log(data);
                let json_data = JSON.parse(data);
                console.log(json_data);
                if(json_data["result"] == "success"){
                    console.log(json_data);
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display='block';
                } 

                 
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}