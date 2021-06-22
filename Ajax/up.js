$(document).ready(function() {
    $(".like").on("click", function(){
        var id = this.id;
        let like = this

        $.ajax({                
            type : 'POST',
            url  : '/treatment/up.php',
            data : {id:id},
            success : function(data){
                getUp(like)
                return data;
             }
        })
    })
});

function getUp(like){

         formData = new FormData()
         formData.append('id_post', like.getAttribute('id'))
         
     
         fetch('/load/up2.php', {
             method: "post",
             body: formData,
         }).then((response)=>{
             return response.text();  
         }).then((data)=>{
             console.log(data);
             like.innerHTML = data
    
         })
}



