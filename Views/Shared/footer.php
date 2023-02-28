<!-- Modal -->
<div class="modal fade" id="addPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div id="preview_post">
          </div>
          <form method="POST" action="/pictogram/post/addpost" enctype="multipart/form-data">
            <div class="my-3">
              <input class="form-control" name="doc[]" type="file" accept="video/mp4,image/png,image/jpeg,image/jpg" multiple id="upload_file_post">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
              <textarea class="form-control" name="post_text" id="post_text" rows="3"></textarea>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="post" onclick=" return isPostFile()" class="btn btn-primary">Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- this is show post modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
    loading...
    </div>
  </div>
</div>
<!-- this is for like list -->
<div class="modal fade" id="likeModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Likes</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-2 bg-white border rounded text-center">No Sugesstions For You</p>
      </div>
    </div>
  </div>
</div>
<!-- off canvas notification -->
<div class="offcanvas offcanvas-end"  tabindex="-1" id="notification_sidebar"  aria-labelledby="notification_sidebar" style="border-radius:30px;border: 1px solid black;margin:50px 0">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Notifications</h5>
    <div class="dropdown">
      <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li onclick="AllNotifications()"><a class="dropdown-item"> All</a></li>
        <li onclick="UnreadNotifications()"><a class="dropdown-item"> Unread</a></li>
        <li onclick="MarkAllAsRead()"><a class="dropdown-item"> Mark all as read</a></li>
        <li><a class="dropdown-item" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"> Close</a></li>
      </ul>
    </div>
  </div>
  <div class="offcanvas-body" id="body-notification-canvas">

  </div>
</div>
<!-- off canvas message -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"  id="message_sidebar" aria-labelledby="chat_sidebar" style="border-radius:30px;border: 1px solid black;margin:50px 0">
  <div class="offcanvas-header offcanvas-header-mess">
    <div class="header-mess-title">        
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" onclick="StopActiveChat()"></button>          
      <h5 id="offcanvasRightLabel" >Messages</h5>
      <div class="dropdown">
        <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></span>
        <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="unread-request-title"></span> 
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li onclick="ActiveChatUsers()"><a class="dropdown-item" >Messages</a></li>
          <li onclick="ActiveChatUsersRequest()"><a class="dropdown-item" id="unread-request"> Message requests </a></li>
        </ul>
      </div>
    </div>
    <div class="header-mess-search">
      <input type="text" class="form-control" placeholder="Search Messager" id="search_messenger" />
      <div class="bg-white text-end rounded border shadow py-3 px-4 mt-3" style="display:none;" id="search_result_messenger"  data-bs-auto-close="true">
                    <button type="button" class="btn-close" aria-label="Close" id="close_search_messenger"></button>
                    <div id="sra_messenger" class="text-start">
                        <p class="text-center text-muted">enter name or username</p>
                    </div>
                </div>
    </div>
  </div>
  <div class="offcanvas-body" id="body-message-canvas">

  </div>
</div>
<!-- this is for popup chat -->
<div class="modal fade" id="popupChat"  tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Chat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body">
        <p class="p-2 bg-white border rounded text-center">loading...</p>
      </div>
  </div>
</div>
</div>

<script src="/pictogram/public/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/pictogram/public/js/jquery-3.6.0.min.js"></script>
<script src="/pictogram/public/js/custom.js?v=<?= time() ?>"></script>
</body>

</html>