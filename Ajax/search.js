  let search = $('#search');
    let result = $('#result');
    
    $(document).ready(function(){
    $('#search').focus()
  
    $('#search').on('keyup', function(){
      var search = $('#search').val()
      $.ajax({
        type: 'POST',
        url: '/recuperation-donnees/search.php',
        data: {'search': search}
      })
      .done(function(result){
        if(search === ""){
          result.html("")
        }else{ 
          $('#result').html(result)
        }
        
      })
      .fail(function(){
        alert('Il y a eu une erreur')
      })
    })
  })

  if(search === "" && !result === ""){
    result.html("")

  }
  

