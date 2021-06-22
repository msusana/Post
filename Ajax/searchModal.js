document.addEventListener('DOMContentLoaded',()=>{
    fetch('/treatment/searchModal.php', {
        method: 'GET',
        headers: {
         
        },
        redirect: 'follow',
    })
    .then((response)=>{
        console.log(response)
        return response.json()
    }).then((results)=>{
        console.log(results)
        searchPost(results)        
    })
})
let postIndex = document.querySelector("#postIndex")  
let divPost = document.querySelector("#post-list");
let inputSearch = document.querySelector(".search-post");

function searchPost(results){

    let searchPost = document.querySelector(".search-post");
   
    searchPost.addEventListener("input", (event)=>{
        searchPost = event.target.value
        
        divPost.innerHTML = ''

        if(searchPost != ""){
         
        results.forEach(result => {
            
            if (result.name_post.includes(searchPost) ) {
                resize()
                console.log(result)
                postIndex.style.position = 'relative';
                postIndex.style.zIndex= -1000;
                document.getElementById('overlayModalSearch').style.opacity= '1';
                document.getElementById('modalSearch').style.opacity= '1';
                

            divPost.innerHTML += `<div class=" cardPost mb-3 col-xs-12 col-sm-12 col-md-6 col-lg-4 text-center">
            <a href="/recuperation-donnees/post.php?id=${result.id}">
                <div class="card produit">
                    <p><b>"${result.name_post}"</b></p>
                    <div class="text-truncate">
                    <p>${result.description}</p>
                    </div>
                    <p>${result.created}</p>
                    <p><b>Post by :</b> ${result.nickname}</p>
                </div>
            </a>
            </div>`
            }
        });
    }else{
        divPost.innerHTML = ""
    }
    });
}
          
const buttonCloseSearch = document.getElementById('closeBtnModalSearch')
  
  buttonCloseSearch.addEventListener('click', ()=>{
    document.getElementById('overlayModalSearch').style.opacity= 0;
    document.getElementById('modalSearch').style.opacity= 0;
    postIndex.style.position = 'relative';
    postIndex.style.zIndex= 1000;
    divPost.innerHTML = ""
    inputSearch.value =""
  });

  function resize() {
    $(window).resize(function() {
        sH = $(window).height();
        var porcentage = 25/100*sH;
        sH = sH - porcentage;
        $('.modalSearch').css('height', sH + 'px');
    });
}