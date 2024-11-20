document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-orders').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const userId = this.getAttribute('data-id');
            fetch(`/api/users/${userId}/orders`)
                .then(response => response.json())
                .then(data => {
                    const ordersList = document.getElementById('ordersList');
                    ordersList.innerHTML = '';
                    data.orders.forEach(order => {
                        const orderRow = `
                            <tr>
                                <td>${order.id}</td>
                                <td>${order.order_items.reduce((sum, item) => sum + item.quantity, 0)}</td>
                                <td>${order.total} VND</td>
                                <td>${order.phone}</td>
                                <td>${order.street_address}</td>
                                <td>${order.payment_method}</td>
                                <td>${order.status}</td>
                                <tr></tr>
                            </tr>
                        `;
                        ordersList.innerHTML += orderRow;
                    });
                    document.getElementById('order-details-manager').style.display = 'block';
                });
        });
    });
});

document.getElementById('closeOrderDetailsManager').addEventListener('click', function() {
    document.getElementById('order-details-manager').style.display = 'none';
});