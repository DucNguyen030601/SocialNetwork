<nav class="navbar navbar-expand-lg navbar-light bg-white border">
    <div class="container col-9 d-flex justify-content-between">
        <div class="d-flex justify-content-between col-8">
            <a class="navbar-brand" href="/pictogram">
                <img src="/pictogram/public/images/pictogram.png" alt="" height="28">
            </a>

            <form class="d-flex">
                <input class="form-control me-2" type="search" id="search" placeholder="looking for someone.." aria-label="Search" autocomplete="off">
                <div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99;" id="search_result" data-bs-auto-close="true">
                    <button type="button" class="btn-close" aria-label="Close" id="close_search"></button>
                    <div id="sra" class="text-start">
                        <p class="text-center text-muted">enter name or username</p>
                    </div>
                </div>
            </form>
        </div>

        <ul class="navbar-nav  mb-2 mb-lg-0">

            <li class="nav-item">
                <a class="nav-link text-dark" href="/pictogram"><i class="bi bi-house-door-fill"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addPost" href="#"><i class="bi bi-plus-square-fill"></i></a>
            </li>

            <li class="nav-item" onclick="ActiveChatUsers()">
                <a class="nav-link text-dark" data-bs-toggle="offcanvas" aria-controls="offcanvas" href="#message_sidebar" id="unread-message-status">
                    <i class="bi bi-chat-right-dots-fill"></i>
                    <?php if (numberOfUnreadMessages($model->id)) { ?>
                        <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                            <small><?= numberOfUnreadMessages($model->id) ?></small>
                        </span> <?php } ?>

                </a>
            </li>

            <li class="nav-item" onclick="AllNotifications()">
                <a class="nav-link text-dark" data-bs-toggle="offcanvas" aria-controls="offcanvas" href="#notification_sidebar" id="unread-notification-status">
                    <i class="bi bi-bell-fill"></i>
                    <?php if (numberOfUnreadNotifications($model->id)) { ?>
                        <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                            <small><?= numberOfUnreadNotifications($model->id) ?></small>
                        </span> <?php } ?>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/pictogram/upload/<?php echo "user$model->id/" . $model->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" w class="rounded-circle border">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/pictogram/account">My Profile</a></li>
                    <li><a class="dropdown-item" href="/pictogram/account/editprofile">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="#">Account Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/pictogram/signin">Logout</a></li>
                </ul>
            </li>

        </ul>


    </div>
</nav>