
          <?php include 'inc/navb.php'; ?>
          <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-white d-block text-center">
                <h6 class="display-4 font-weight-bold">Search</h6>
                <p class="text-black-50 mb-0">Use the form below to search for files</p>
            </div>
            <div class="modal-body bg-light">
                <div class="p-5">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search terms here...">
                        <div class="input-group-append">
                            <button class="btn btn-primary border-0" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-block text-center">
                <button type="button" class="btn btn-link btn-link-dark" data-dismiss="modal">Close search box</button>
            </div>
        </div>
    </div>
</div>
            <div class="app-content">
<div class="app-content--inner">
                <div class="page-title">
    <div>
        <h5 class="display-4 mt-1 mb-2 font-weight-bold">Create Support Ticket</h5>
       
    </div>
</div>


                <div class="container">
                    <div class="card card-box mb-5">
                        <div class="row">
               <div class="mb-3">
                    <form action="create.php" method="post">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="text" class="form-control" id="title"  name="title" Placeholder="Enter subject Title">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="email" Value="<?php echo $fetch_info['email']; ?>">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" name="msg" id="exampleFormControlTextarea1" id="msg" required></textarea>
</div>
               <input type="submit" value="Create">    
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
                    
	</div>

</div>
   
</div>

                </div>
            </div>
       </div>
       </div>
          <?php include 'inc/footerb.php'; ?>
