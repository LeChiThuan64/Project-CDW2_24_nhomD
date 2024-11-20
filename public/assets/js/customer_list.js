document.querySelector('.view-orders').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('order-details-manager').style.display = 'block';
});

document.getElementById('closeOrderDetailsManager').addEventListener('click', function() {
    document.getElementById('order-details-manager').style.display = 'none';
});