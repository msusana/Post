<h5>Create New Post</h5>
  <form class="form" action="../treatment/create.php" method="post" enctype="multipart/form-data">
    <div class='row '>

      <div class="col-4">
        <input type="hidden" name="id_user" value='<?= $user->getId() ?>'>
        <label for="pseudo" class="form-label"></label>
        <input type="text" class="form-control" id="name" placeholder="name_post" name="name_post">
        <label for="link" class="form-label">Link</label>
        <input type="text" class="form-control" id="link" name="link" placeholder="Exemple : www.site.com">
      </div>
     
      <div class="col-7">
        <label for="description">Example textarea</label>
        <textarea class="form-control" id="description" name='description' rows="3"></textarea>
      </div>
      <div class="col-10 m-1">
      <label for="photo_link1">Choose file to upload</label>
        <input type="file" id="photo_link1" name="photo_link1"
          accept=".jpg, .jpeg, .png">
      </div> 
      <button type="button" class="btn btn-secondary photoLink2">Add another image </button>
      <div class="col-10 m-1" id='photoLink2'>
      <label for="photo_link2">Choose file to upload</label>
        <input type="file" id="photo_link2" name="photo_link2"
          accept=".jpg, .jpeg, .png">
      </div>
      <button type="button" class="btn btn-secondary photoLink3">Add another image </button>
      <div class="col-10 m-1" id='photoLink3'>
      <label for="photo_link3">Choose file to upload</label>
        <input type="file" id="photo_link3" name="photo_link3"
          accept=".jpg, .jpeg, .png">
      </div>
      <div class="col col-sm-12 col-md-2">
        <button type="submit" class="btn btn-primary" >Submit</button>
      </div>

    </div>
  </form>