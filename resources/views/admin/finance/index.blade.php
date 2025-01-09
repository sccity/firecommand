<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finance Tools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Finance Management Dashboard</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Budget Overview Card -->
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium mb-2">Budget Overview</h4>
                            <p class="text-gray-600">View and manage department budgets</p>
                            <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                View Details
                            </button>
                        </div>

                        <!-- Expense Reports Card -->
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium mb-2">Expense Reports</h4>
                            <p class="text-gray-600">Submit and review expense reports</p>
                            <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Manage Reports
                            </button>
                        </div>

                        <!-- Purchase Orders Card -->
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-medium mb-2">Purchase Orders</h4>
                            <p class="text-gray-600">Create and track purchase orders</p>
                            <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Create New
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 