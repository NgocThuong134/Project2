<script>
document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('.bx.bxs-cart-add');

    // Lấy dữ liệu từ session 'cart' và gán cho biến cartItems
    var cartItems = <?php echo isset($_SESSION['cart']) ? json_encode($_SESSION['cart']) : '[]'; ?>;
    for (var i = 0; i < elements.length; i++) {
        var foodid = elements[i].getAttribute('onclick').match(/\d+/)[0];
        var added = cartItems.some(function(item) {
            return item.foodid == foodid;
        });

        if (added) {
            elements[i].classList.add('added');
        }
    }
});
</script>