<section class="body hide">
    <form action="controllers/login.php" method="POST" class="form-dangnhap">
        <?php
            include('view/login.php');
            ?>
        <i class="bx bx-x close-icon"></i>
    </form>
</section>
<section class="body body2 hide">
    <form action="controllers/register.php" method="POST" enctype="multipart/form-data" class="form-dangky">
        <?php
            include("view/register.php");
            ?>
        <i class="bx bx-x close-icon"></i>
    </form>
</section>
<section class="body body3 hide">
    <form action="controllers/guimail.php" method="post" class="fogot-password">
        <?php
            include("view/quenmatkhau.php");
            ?>
        <i class="bx bx-x close-icon"></i>
    </form>
</section>
<section class="body body4 hide">
    <form class="change-password">
        <?php
            include("view/doimatkhau.php");
            ?>
        <i class="bx bx-x close-icon"></i>
    </form>
</section>