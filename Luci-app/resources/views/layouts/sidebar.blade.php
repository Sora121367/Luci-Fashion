<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-60 min-h-screen bg-gray-300 p-4">
    <ul class="space-y-2">
        <li>
            <a href="/dashboard" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-house-door mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('productlist') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-box-seam mr-2"></i> Product List
            </a>
        </li>
        <li>
            <a href="{{ url('categories') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-tags mr-2"></i> Categories
            </a>
        </li>
        <li>
            <a href="{{ url('sales') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-cart mr-2"></i> Sales
            </a>
        </li>
        <li>
            <a href="{{ url('customers') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-person-lines-fill mr-2"></i> Customers
            </a>
        </li>
        <li>
            <a href="{{ url('report') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-file-earmark-text mr-2"></i> Report
            </a>
        </li>
        <li>
            <a href="setting" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-gear mr-2"></i> Setting
            </a>
        </li>
        <li>
            <a href="logout" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                <i class="bi bi-box-arrow-right mr-2"></i> Logout
            </a>
        </li>
    </ul>
</aside>
