<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Customer's Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

@include('layouts.navbar')

<div class="flex">
    @include('layouts.sidebar')

    <main class="flex-1 p-6">
        <div class="border border-gray-400 bg-white p-6 rounded-lg shadow-md w-full">
            <h2 class="text-2xl font-semibold mb-4">Customer's Orders</h2>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 text-left text-gray-700">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 text-left">Customer Name</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Orders</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Latest Status</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Order Modal -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl w-full max-h-[80vh] overflow-y-auto">
        <h3 class="text-xl font-semibold mb-4">Customer Orders</h3>
        <div id="orderDetails" class="space-y-4"></div>
        <div class="mt-6 text-right">
            <button onclick="closeModal()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
        </div>
    </div>
</div>

<script>
    async function fetchCustomerData() {
        const res = await fetch('/api/customers');
        const customers = await res.json();
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (const user of customers) {
            const safeName = user.name.replace(/'/g, "\\'");
            const ordersRes = await fetch(`/api/customers/${user.id}/orders`);
            const orders = await ordersRes.json();
            const latestOrder = orders.length ? orders[0] : null;
            const status = latestOrder ? latestOrder.status : 'No Orders';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="p-3">${user.name}</td>
                <td class="p-3">${user.email}</td>
                <td class="p-3">${user.orders_count}</td>
                <td class="p-3">$${parseFloat(user.orders_total).toFixed(2)}</td>
                <td class="p-3"><span class="${getStatusColor(status)} font-semibold">${status}</span></td>
                <td class="p-3 space-x-2">
                    <button onclick="viewOrders('${user.id}', '${safeName}')" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">View Orders</button>
                </td>
            `;
            tableBody.appendChild(row);
        }
    }

    async function viewOrders(userId, userName) {
        const res = await fetch(`/api/customers/${userId}/orders`);
        const orders = await res.json();
        const orderDetails = document.getElementById('orderDetails');
        orderDetails.innerHTML = '';

        document.querySelector('#orderModal h3').textContent = `Orders by ${userName}`;

        orders.forEach(order => {
            const orderItem = document.createElement('div');
            orderItem.className = 'border p-3 rounded-lg bg-gray-100';

            const isFinalStatus = order.status === 'Accepted' || order.status === 'Rejected';

            // Show size(s) below payment
            let sizeHtml = '';
            if (order.items && order.items.length > 0) {
                sizeHtml += '<div class="mt-2"><strong>Items:</strong>';
                sizeHtml += '<ul class="ml-4 list-disc">';
                order.items.forEach(item => {
                    sizeHtml += `<li>
                        Size: ${item.size}, Quantity: ${item.quantity} <br>
                        Product: ${item.product.name} <br>
                        <img src="./storage/${item.product.image_path}" alt="${item.product.name}" class="w-16 h-16 object-cover mt-1">
                    </li>`;
                });
                sizeHtml += '</ul></div>';
            }

            orderItem.innerHTML = `
                <p><strong>Status:</strong> <span class="font-semibold ${getStatusColor(order.status)}">${order.status}</span></p>
                <p><strong>Total:</strong> $${parseFloat(order.total_price).toFixed(2)}</p>
                <p><strong>Payment:</strong> ${order.payment_method}</p>
                ${sizeHtml}
                <div class="mt-4 space-x-2">
                    <button 
                        onclick="updateStatus('${order.id}', 'Accepted')" 
                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                        ${isFinalStatus ? 'disabled opacity-50 cursor-not-allowed' : ''}
                    >Approve</button>
                    <button 
                        onclick="updateStatus('${order.id}', 'Rejected')" 
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                        ${isFinalStatus ? 'disabled opacity-50 cursor-not-allowed' : ''}
                    >Reject</button>
                </div>
            `;

            orderDetails.appendChild(orderItem);
        });

        document.getElementById('orderModal').classList.remove('hidden');
    }


    function closeModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    function getStatusColor(status) {
        switch (status) {
            case 'Pending': return 'text-yellow-600';
            case 'Accepted': return 'text-green-600';
            case 'Rejected': return 'text-red-600';
            case 'Completed': return 'text-blue-600';
            default: return 'text-gray-600';
        }
    }

    async function updateStatus(orderId, status) {
        const response = await fetch(`/api/orders/${orderId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status })
        });

        const result = await response.json();
        alert(result.message);
        closeModal();
        fetchCustomerData();
    }

    document.addEventListener('DOMContentLoaded', fetchCustomerData);
</script>

</body>
</html>
