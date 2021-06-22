
let envoyer = document.querySelector('#envoyer');



function send(){
        let id_user =  document.getElementById("id_user");
       let id_post = document.getElementById("id_post");
       let message = document.getElementById("commentaire");

        formData = new FormData()
        formData.append('id_user', id_user.value)
        formData.append('id_post', id_post.value)
        formData.append('message', message.value)
       
        fetch('/recuperation-donnees/commentaire.php', {
            method: "post",
            body: formData,
        }).then(()=>{
            message.value=""; 
            load_sms();
        })
}

function load_sms(){
    let formData2 = new FormData()
    formData2.append('id_post', id_post.value)
    fetch('/load/commentaire.php', {
        method:'post',
        body:formData2
    }).then((response)=>{
        console.log(response);
        return response.text();
    }).then((data)=>{
        document.querySelector('.commentaire-list').innerHTML = data
    })
}