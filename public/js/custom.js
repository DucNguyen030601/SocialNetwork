
//for show hover messages,notifications
$(".dropdown-hover").hover(function () {
  $(this).find('.show-dropdown').css("display", "block");
}, function () {
  $(this).find('.show-dropdown').css("display", "none");
});
//for preview the post img,video
$('#upload_file_update').change(function () {
  var checkSize = isCheckSizeFile(this.files, 'update');
  var checkType = isCheckTypeFile(this.files, 'update');
  var src = '/pictogram/upload/' + $('#preview_update').attr('alt');

  if (!this.files || !this.files[0]) {
    $('#preview_update').attr('src', src);
    $(this).val(null);
    alert('Please select the file.');
  }
  else if (checkType) {
    $('#preview_update').attr('src', src);
    $(this).val(null);
    alert(checkType + 'is not in images(.jpg,.jpeg,.png) files! Please select the file again.')
  }
  else if (checkSize) {
    $('#preview_update').attr('src', src);
    $(this).val(null);
    alert(checkSize + 'download capacity has exceeded the allowed quota! Please select the file again.')
  }
  else {
    var reader = new FileReader();
    reader.onload = function () {
      $('#preview_update').attr('src', reader.result);
    };
    reader.readAsDataURL(this.files[0]);
  }

})
$("#upload_file_post").change(function () {
  var checkSize = isCheckSizeFile(this.files, 'post');
  var checkType = isCheckTypeFile(this.files, 'post');

  if (!this.files || !this.files[0]) {
    $('#preview_post').html('');
    $(this).val(null);
    alert('Please select the file.');
  }
  else if (this.files.length > 5) {
    $('#preview_post').html('');
    $(this).val(null);
    alert('Please select up to 5 files.');
  }
  else if (checkType) {
    $('#preview_post').html('');
    $(this).val(null);
    alert(checkType + 'are not in images(.jpg,.jpeg,.png) or videos(.mp4) files! Please select the file again.')
  }
  else if (checkSize) {
    $('#preview_post').html('');
    $(this).val(null);
    alert(checkSize + 'download capacity has exceeded the allowed quota! Please select the file again.')
  }
  else {
    $('#preview_post').html('');
    $('#preview_post').attr("style", "overflow:overlay;height: 450px");
    for (var i = 0; i < this.files.length; i++) {
      var reader = new FileReader();
      var fileName = this.files[i].name;
      var idxSlash = fileName.lastIndexOf(".") + 1;
      var extFile = fileName.substr(idxSlash, fileName.length);
      if (extFile == "mp4") {
        reader.onload = videoIsLoaded;
      }
      if (extFile != "mp4") {
        reader.onload = imageIsLoaded;
      }
      reader.readAsDataURL(this.files[i]);
    }
  }
});
function isPostFile() {
  var file = $("#upload_file_post").val();
  var text = $("#post_text").val().trim();
  if (!file && !text) { alert('Please enter something!'); return false; }
  return true;
}
function imageIsLoaded(e) {
  $('#preview_post').append('<img src=' + e.target.result + ' style="width:-webkit-fill-available" >');
};
function videoIsLoaded(e) {
  $('#preview_post').append(`<video controls style="width:-webkit-fill-available" src='${e.target.result}' >
          <source  type="video/mp4">
        </video>`);
}
function isCheckSizeFile(files, type) {
  var s = '';
  var maxSizeImage = 2097152;
  var maxSizeVideo = 10485760;
  for (var i = 0; i < files.length; i++) {
    var fileSize = files[i].size;
    var fileName = files[i].name;
    var idxSlash = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxSlash, fileName.length);
    if (type == "post") {
      if (extFile == "mp4" && fileSize > maxSizeVideo) {
        s += fileName + `(${Math.round((fileSize / 1048576))}MB), `;
      }
      if ((extFile == "jpeg" || extFile == "jpg" || extFile == "png") && fileSize > maxSizeImage) {
        s += fileName + `(${Math.round((fileSize / 1048576))}MB), `;
      }
    }
    else {
      if ((extFile == "jpeg" || extFile == "jpg" || extFile == "png") && fileSize > maxSizeImage) {
        s += fileName + `(${Math.round((fileSize / 1048576))}MB), `;
      }
    }
  }
  return s;
}
function isCheckTypeFile(files, type) {
  var s = '';
  for (var i = 0; i < files.length; i++) {
    var fileSize = files[i].size;
    var fileName = files[i].name;
    var idxSlash = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxSlash, fileName.length);
    if (type == 'post') {
      if (extFile != "mp4" && extFile != "jpeg" && extFile != "jpg" && extFile != "png") {
        s += fileName + ', ';
      }
    }
    else {
      if (extFile != "jpeg" && extFile != "jpg" && extFile != "png") {
        s += fileName + ', ';
      }
    }
  }
  return s;
}
//for delete the post
function DeletePost(post_id) {
  if (!confirm('Do you want to delete this post?')) { return 0; }
  $.ajax({
    url: '/pictogram/post/deletepost',
    method: 'post',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      debugger
      response = $.parseJSON(response);
      if (response.status) {
        location.reload();
      }
    }
  });
};
//for follow the user
function Follow(button, user_id) {
  $.ajax({
    url: '/pictogram/follow/addfollow',
    method: 'post',
    datatype: 'json',
    data: { user_id: user_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        $(button).attr('disabled', true);
        $(button).html('<i class="bi bi-check-circle-fill"></i> Followed');
      }
    }
  });
}
//for unfollow the user
function Unfollow(button, user_id) {
  $.ajax({
    url: '/pictogram/follow/deletefollow',
    method: 'post',
    datatype: 'json',
    data: { user_id: user_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        $(button).attr('disabled', true);
        $(button).html('<i class="bi bi-check-circle-fill"></i> Unfollowed')
      }
    }
  });
}


//for like the post
$(".like_btn").click(function () {
  var post_id = $(this).data('postId');
  var text_like = $('#number-of-likes-' + post_id);
  var button = this;
  $.ajax({
    url: '/pictogram/like/like',
    method: 'post',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        $(button).attr('class', 'bi bi-heart-fill like_btn');
        $(button).attr('style', 'color:red');
        text_like.text(response.numberOfLikes);
      }
      else {
        $(button).attr('class', 'bi bi-heart like_btn');
        $(button).removeAttr("style");
        text_like.text(response.numberOfLikes);
      }
    }
  });
});

//for show the post modal
$(".show-post-modal").click(function () {
  var post_id = $(this).data('postId');
  var body_modal = $('#postModal');
  body_modal.find('.modal-content').text('loading...');
  $.ajax({
    url: '/pictogram/post/postmodal',
    method: 'get',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      body_modal.html(response);
    }
  });
});


//for add comment the post
function AddComment(event_target, post_id) {
  var text_comment = $('#number-of-comments-' + post_id);
  var upload_comment = $('#show-upload-comment-' + post_id);
  var comment = $(event_target).siblings('.comment-input').val();
  if (comment.trim() == '') { return 0; }
  $.ajax({
    url: '/pictogram/comment/addcomment',
    method: 'post',
    datatype: 'json',
    data: { post_id: post_id, comment: comment },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        text_comment.css('display', 'block');
        text_comment.text('Views all ' + response.numberOfComments + ' comments');
        upload_comment.html(`<span><span style="font-weight:bold" title='${response.commentator.username}'>${response.commentator.first_name + ' ' + response.commentator.last_name}</span><span class="text-muted" title='${response.commentator.created_at}'> ${response.commentator.comment} </span></span>`);
        $(event_target).siblings('.comment-input').val('');
        ReloadComments(post_id);
      }
    }
  });
};
//for reload the comments post
function ReloadComments(post_id) {
  var show_comments_modal = $('#show-comments-modal-' + post_id);
  $.ajax({
    url: '/pictogram/comment/index',
    method: 'get',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      show_comments_modal.html(response);
    }
  });
}
//for delete comment the post
function DeleteComment(comment_id,post_id) {
  if (!confirm('Do you want to delete this comment?')) { return 0; }
  $.ajax({
    url: '/pictogram/comment/deletecomment',
    method: 'post',
    datatype: 'json',
    data: { comment_id: comment_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        ReloadComments(post_id);
      }
    }
  });
};
//for show the like modal
$(".show-like-modal").click(function () {
  var post_id = $(this).data('postId');
  var body_modal = $('#likeModal');
  $.ajax({
    url: '/pictogram/like/likemodal',
    method: 'get',
    datatype: 'json',
    data: { post_id: post_id },
    success: function (response) {
      body_modal.html(response);
    }
  });
});
//for event input textbox search
$("#search").focus(function () {
  $("#search_result").show();
});

$("#close_search").click(function () {
  $("#search_result").hide();
});
$("#search").keyup(function () {
  var keyword_v = $(this).val();
  $.ajax({
    url: '/pictogram/search/index',
    method: 'post',
    datatype: 'json',
    data: { keyword: keyword_v },
    success: function (response) {
      $("#sra").html(response);
    }
  });
});


//for Block and UnBlock
function Block(blocked_user_id) {
  $.ajax({
    url: '/pictogram/block/block',
    method: 'post',
    datatype: 'json',
    data: { blocked_user_id: blocked_user_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        location.reload();
      }
    }
  });
}
function UnBlock(blocked_user_id) {
  $.ajax({
    url: '/pictogram/block/unblock',
    method: 'post',
    datatype: 'json',
    data: { blocked_user_id: blocked_user_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        location.reload();
      }
    }
  });
}
//for Report
function AddReport(type, user_id,type_id=0) {
  var name = '';
  if(type==0) name = 'user';
  if(type==1) name = 'post';
  if(type==2) name ='comment';
  if (!confirm('Do you want to report this '+name+'?')) { return 0; }
  $.ajax({
    url: '/pictogram/report/addreport',
    method: 'post',
    datatype: 'json',
    data: {
      type: type,
      user_id: user_id,
      type_id: type_id
    },
    success: function (response) {
      debugger
      response = $.parseJSON(response);
      if (response.status==1) {
        alert(`Successful ${name} reports!`);
      }
      if (response.status==2) {
        alert(`You have reported this ${name}!`);
      }
    }
  });
}


//for show notifications canvas
//all
notification_status = 0;
function AllNotifications() {
  $.ajax({
    url: '/pictogram/notification/index',
    method: 'get',
    datatype: 'json',
    success: function (response) {
      notification_status = 1;
      $('#body-notification-canvas').html(response);
    }
  });
}
//unread
function UnreadNotifications() {
  $.ajax({
    url: '/pictogram/notification/unreadnotification',
    method: 'get',
    datatype: 'json',
    success: function (response) {
      notification_status = 2;
      $('#body-notification-canvas').html(response);
    }
  });
}
function ReadNotification(notification_id) {
  $.ajax({
    url: '/pictogram/notification/read',
    method: 'post',
    datatype: 'json',
    data: { notification_id: notification_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        window.location = response.url;
      }
    }
  });
}
function MarkAllAsRead() {
  $.ajax({
    url: '/pictogram/notification/markallasread',
    method: 'post',
    datatype: 'json',
    success: function (response) {
      $('#body-notification-canvas').html(response);
    }
  });
}
function UnreadNotificationsStatus() {
  $.ajax({
    url: '/pictogram/notification/numberofunread',
    method: 'get',
    datatype: 'json',
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        $('#unread-notification-status').html(`<i class="bi bi-bell-fill"></i>
          <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                        <small>${response.number}</small>
                </span>`)
      }
      else {
        $('#unread-notification-status').html(`<i class="bi bi-bell-fill"></i>`);
      }
    }
  });
}
//for delete notification
function DeleteNotification(notification_id) {
  if (!confirm('Do you want to delete this notification?')) { return 0; }
  $.ajax({
    url: '/pictogram/notification/deletenotification',
    method: 'post',
    datatype: 'json',
    data: { notification_id: notification_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status && notification_status == 1) {
        AllNotifications();
      }
      if (response.status && notification_status == 2) {
        UnreadNotifications();
      }
    }
  });
};

//for show messages canvas
//messages
function ActiveChatUsers() {     
  active_chat_user_request=false; 
  $.ajax({
    url: '/pictogram/message/activechatusers',
    method: 'get',
    datatype: 'json',
    success: function (response) {
    if(!active_chat_user_request){
      active_chat_user = true;
      $('#body-message-canvas').html(response);}
    }
  });
}
//message requests
function ActiveChatUsersRequest() {
  active_chat_user=false;
  $.ajax({
    url: '/pictogram/message/activechatusersrequest',
    method: 'get',
    datatype: 'json',
    success: function (response) {  
      if(!active_chat_user){
        active_chat_user_request = true;
        $('#body-message-canvas').html(response);}
      }
  });
}
function UnreadMessagesStatus() {
  $.ajax({
    url: '/pictogram/message/numberofunread',
    method: 'get',
    datatype: 'json',
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        $('#unread-message-status').html(`<i class="bi bi-chat-right-dots-fill"></i>
          <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                        <small>${response.number}</small>
                </span>`)
      }
      else {
        $('#unread-message-status').html(`<i class="bi bi-chat-right-dots-fill"></i>`);
      }
    }
  });
}
function UnreadMessagesStatusRequest() {
  $.ajax({
    url: '/pictogram/message/numberofunreadrequest',
    method: 'get',
    datatype: 'json',
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {  
        $('#unread-request-title').html(`<small></small>`);
        $('#unread-request').html(`Message requests <span class="badge bg-danger rounded-pill">${response.number}</span>`);
      }
      else {
        $('#unread-request-title').html('');
        $('#unread-request').html('Message requests');
      }
    }
  });
}

//for pop-up chat
chat_from_user_id = 0;
function popup_chat(from_user_id) {
  chat = $('#popupChat').find('.modal-content');
  chat.html(` <div class="modal-header"><h5 class="modal-title">Chat</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><p class="p-2 bg-white border rounded text-center">loading...</p></div>`);
  setTimeout(() => {
    $.ajax({
      url: '/pictogram/message/chatmodal',
      method: 'get',
      datatype: 'json',
      data: { from_user_id: from_user_id },
      success: function (response) {
        chat.html(response);
        var bodyChat = $('#body_chat');
        bodyChat.scrollTop(bodyChat.prop("scrollHeight"));
        chat_from_user_id = from_user_id;
        $('textarea').focus();
      }
    })
  }, 1000);
}
//for start real time chat
function BodyChat() {
  $.ajax({
    url: '/pictogram/message/index',
    method: 'get',
    datatype: 'json',
    data: { from_user_id: chat_from_user_id },
    success: function (response) {
      var bodyChat = $('#body_chat');
      bodyChat.html(response);
      bodyChat.scrollTop(bodyChat.prop("scrollHeight"));
    }
  })
}

//for  stop real time chat
function StopChat() {
  chat_from_user_id = 0;
}
function StopActiveChat() {
  active_chat_user = false;
  active_chat_user_request = false;
}
//for show msgs 
function LoadChat() {
  $.ajax({
    url: '/pictogram/message/loadchat',
    method: 'get',
    datatype: 'json',
    data: { from_user_id: chat_from_user_id },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.read_status) {
        BodyChat();
        $('#numberOfMessages').text(response.count);
      }
      if (response.blocked) {
        $('#blerror').show();
        $('#msgsender').hide();
      }
      else {
        $('#blerror').hide();
        $('#msgsender').show();
      }
    }
  })
}

//for add message
function AddMessage(event_target, from_user_id, is_new_mess = false) {
  var send_message = $(event_target);
  var input_message = send_message.siblings('.message-input');
  var event = send_message.attr('onclick');
  var message = input_message.val().trim();
  if (message == '') { return 0; }
  send_message.attr("onclick", 'return false');
  input_message.attr("disabled", true);
  $.ajax({
    url: '/pictogram/message/addmessage',
    method: 'post',
    datatype: 'json',
    data: { to_user_id: from_user_id, msg: message },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status) {
        send_message.attr("onclick", event);
        input_message.attr("disabled", false);
        input_message.val('');
        input_message.focus();
        if (!is_new_mess) {
          $('#numberOfMessages').text(response.count);
          BodyChat();
        }
        else{
          alert('Message sent successfully!');
        }

      } else {
        alert('Someting went wrong, try again after some time');
      }
    }
  });
};

active_chat_user = false;
active_chat_user_request = false;
//for event input textbox search_user_messages
$("#search_messenger").focus(function () {
  $("#search_result_messenger").show();
});
$("#close_search_messenger").click(function () {
  $("#search_result_messenger").hide();
});
$("#search_messenger").keyup(function () {
  var keyword_v = $(this).val();
  $.ajax({
    url: '/pictogram/message/searchmessengers',
    method: 'post',
    datatype: 'json',
    data: { keyword: keyword_v },
    success: function (response) {
      $("#sra_messenger").html(response);
    }
  });

});
setInterval(() => {
  load();
}, 1000);
function load() {
  UnreadNotificationsStatus();
  UnreadMessagesStatus();
  //check chat
  if (chat_from_user_id) LoadChat();
  if (active_chat_user) {ActiveChatUsers();UnreadMessagesStatusRequest();}
  if(active_chat_user_request) {ActiveChatUsersRequest();UnreadMessagesStatusRequest()}
}