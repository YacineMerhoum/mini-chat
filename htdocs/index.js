const messageForm = document.querySelector('#messageForm')

messageForm.addEventListener('submit', function (event) {
  
    event.preventDefault(); 
    
    const ipUser = document.querySelector('#ipUser').value
    const pseudo = document.querySelector('#pseudo').value
    const message = document.querySelector('#content').value
    
    let formData = new FormData()
    

    formData.append('ipUser', ipUser )
    formData.append('pseudo', pseudo)
    formData.append('content', message)
    
    
    fetch("message.php", {
        method: "POST",
        body: formData
    
    
    }).then((response) => {
        return response.text()
    }).then((data)=>{

        
        document.querySelector("#pseudo").value = ""
        document.querySelector("#content").value = ""
      
        
      getMessage();
    })

})


async function getMessage(){
    const response = await fetch("./process/process_ajax.php");
    const data = await response.json();
    

    let div = document.querySelector("#affichageMessage");
    div.innerHTML = "";
    data.forEach(message => {
        

        
        div.innerHTML += `
        
        <div class="col-9 bg-secondary rounded-5 bg-dark">
                <div class="message">
                    <div class="chat">
                        ${message.date_time}
                        ${message.pseudo}
                        
                    </div>
                    <div class="chat2">
                        ${message.content}
                    </div>
                </div>
            </div>
        
        `;
        
    });

}

getMessage();
// setInterval(() => {
//   getMessage() 
// }, 1000);


