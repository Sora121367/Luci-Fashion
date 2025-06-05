<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-60 min-h-screen bg-gray-300 p-4">
    <ul class="space-y-2">
        <li>
            <a href="{{ url('dashboard') }}" class="flex items-center p-3 rounded-md {{ Request::is('dashboard') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-house-door mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('productlist') }}" class="flex items-center p-3 rounded-md {{ Request::is('productlist') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-box-seam mr-2"></i> Product List
            </a>
        </li>
        <li>
            <a href="{{ url('categorylist') }}" class="flex items-center p-3 rounded-md {{ Request::is('categorylist') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-tags mr-2"></i> Categories
            </a>
        </li>
        <li>
            <a href="{{ url('sales') }}" class="flex items-center p-3 rounded-md {{ Request::is('sales') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-cart mr-2"></i> Sales
            </a>
        </li>
        <li>
            <a href="{{ url('customers') }}" class="flex items-center p-3 rounded-md {{ Request::is('customers') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-person-lines-fill mr-2"></i> Customers
            </a>
        </li>
        <li>
            <a href="{{ url('report') }}" class="flex items-center p-3 rounded-md {{ Request::is('report') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-file-earmark-text mr-2"></i> Report
            </a>
        </li>
        <li>
            <a href="{{ url('setting') }}" class="flex items-center p-3 rounded-md {{ Request::is('setting') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-gear mr-2"></i> Setting
            </a>
        </li>
        <li>
            <a href="logout" class="flex items-center p-3 rounded-md {{ Request::is('logout') ? 'bg-gray-400' : 'hover:bg-gray-400' }}">
                <i class="bi bi-box-arrow-right mr-2"></i> Logout
            </a>
        </li>
        <!-- <li>
            <form method="POST" action="{{ url('logout') }}">
                @csrf
                <button class="flex items-center p-3 w-full text-left hover:bg-gray-400 rounded-md">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </button>
            </form>
        </li> -->
    </ul>
</aside>
