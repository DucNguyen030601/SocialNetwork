window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});
function ActionUser(user_id,ac_status){
    type ='';
    if(ac_status==0) type = 'Verify';
    if(ac_status==1) type = 'Active';
    if(ac_status==2) type = 'Block';
    $.ajax({
        url: '/pictogram/admin/home/actionuser',
        method: 'post',
        datatype: 'json',
        data: { user_id: user_id,
                ac_status:ac_status },
        success: function (response) {
          response = $.parseJSON(response);
          if (response.status) {
            location.reload();
          }
        }
      });
    
}
function LoginUser(user_id){     
  $.ajax({
    url: '/pictogram/admin/home/loginuser',
    method: 'post',
    datatype: 'json',
    data: { user_id: user_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
         alert('Hi '+response.first_name+' '+response.last_name+'!');  
         window.location.href ='/pictogram';
      }
    }
  });
}

//for delete the post
function DeletePost(post_id) {
  if (!confirm('Do you want to delete this post?')) { return 0; }
  $.ajax({
    url: '/pictogram/admin/post/deletepost',
    method: 'post',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        location.reload();
      }
    }
  });
};
//for delete comment the post
function DeleteComment(comment_id) {
  if (!confirm('Do you want to delete this comment?')) { return 0; }
  $.ajax({
    url: '/pictogram/admin/post/deletecomment',
    method: 'post',
    datatype: 'json',
    data: { comment_id: comment_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        location.reload();
      }
    }
  });
};


$(document).ready(function(e) {   
//for show the post modal
$(".show-post-modal").click(function () {
  var post_id = $(this).data('postId');
  var comment_id = $(this).data('commentId');
  var body_modal = $('#postModal');
  $('#postModal').find('modal-content').text('loading');
  $.ajax({
    url: '/pictogram/admin/post/postmodal',
    method: 'get',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      body_modal.html(response);
      if(comment_id){
        $('#comment_show_id_'+comment_id).css('background-color','beige');
      }
    }
  });
});
$(".show-reporter-modal").click(function () {
  var type = $(this).data('type');
  var type_id = $(this).data('typeId');

  var body_modal = $('#reporterModal');
  $.ajax({
    url: '/pictogram/admin/report/reporter',
    method: 'get',
    datatype: 'json',
    data: { type: type,
            type_id:type_id },
    success: function (response) {
      body_modal.html(response);
      if(comment_id){
        $('#comment_show_id_'+comment_id).css('background-color','beige');
      }
    }
  });
});
})

