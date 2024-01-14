const display = document.querySelector('#displayid')

display.addEventListener('submit', function (event) {
  
    event.preventDefault(); 
    
    
    const pseudo = document.querySelector('#pseudo').value
    
    
    let formData = new FormData()
    

    
    formData.append('pseudo', pseudo)
    
    
    
    fetch("message.php", {
        method: "POST",
        body: formData
    
    
    }).then((response) => {
        return response.text()
    }).then((data)=>{

        
        document.querySelector("#pseudo").value = ""
        
      
        
      getMessage();
    })

})


async function getMessage(){
    const response = await fetch("./process/process_ajax2.php");
    const data = await response.json();
    

    let div = document.querySelector(".displaypseudo");
    div.innerHTML = "";
    data.forEach(user => {
        

        
        div.innerHTML += `
        
        <div class="col-1">
        <!-- colone invisible -->
      </div>
      <div class="col-2 bg-white rounded-5  scroll" id="displayid" >
        
          <div class="displaypseudo">
          ${user.pseudo}
          </div>

        
        `;
        
    });

}

getMessage();
// setInterval(() => {
//   getMessage() 
// }, 1000);
