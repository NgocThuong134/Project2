<script>
$(document).ready(function() {
    var loggedIn = <?php echo isset($_SESSION["tennguoidung"]) ? 'true' : 'false'; ?>;

    if (loggedIn) {
        var userElement = $('.user');
        var userLoggedInElement = $('.user.hide');

        var tennguoidung = '<?php echo $_SESSION["tennguoidung"]; ?>';
        var hinhanh = '<?php echo $_SESSION["hinhanh"]; ?>';

        userLoggedInElement.find('img').attr('src', 'avatars/' + hinhanh);
        userLoggedInElement.find('.name').text(tennguoidung);

        userElement.hide();
        userLoggedInElement.css('display', 'flex');
        userLoggedInElement.show();
    }
});
</script>