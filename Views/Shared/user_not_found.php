<?= showPage('header', ['page_title' => 'Profile']) ?>
<?= showPage('nav', (object)$_SESSION[User::TABLE]) ?>
<div class="container mt-5 boder shadow bg-white p-5 d-flex justify-content-center">
    <h1>User Not Found</h1>
</div>
<?= showPage('footer') ?>