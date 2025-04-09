<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Line, Bar, Doughnut } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    CategoryScale,
    PointElement,
    BarElement,
    ArcElement,
} from "chart.js";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    CategoryScale,
    PointElement,
    BarElement,
    ArcElement
);

const revenueData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
    datasets: [
        {
            label: "Monthly Revenue",
            data: [30000, 45000, 35000, 50000, 48000, 55000],
            borderColor: "#3b82f6",
            backgroundColor: "rgba(59, 130, 246, 0.1)",
            tension: 0.3,
        },
    ],
};

const cropDistributionData = {
    labels: ["Wheat", "Rice", "Corn", "Soybeans", "Cotton"],
    datasets: [
        {
            data: [300, 250, 200, 150, 100],
            backgroundColor: [
                "#3b82f6",
                "#10b981",
                "#f59e0b",
                "#8b5cf6",
                "#ef4444",
            ],
        },
    ],
};

const warehouseUtilizationData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
    datasets: [
        {
            label: "Warehouse A",
            data: [65, 70, 80, 75, 85, 90],
            backgroundColor: "#3b82f6",
        },
        {
            label: "Warehouse B",
            data: [55, 60, 65, 70, 75, 80],
            backgroundColor: "#10b981",
        },
    ],
};

const farmerPerformanceData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
    datasets: [
        {
            label: "Top Performer",
            data: [95, 92, 94, 96, 93, 97],
            borderColor: "#10b981",
            backgroundColor: "rgba(16, 185, 129, 0.1)",
            tension: 0.3,
        },
        {
            label: "Average",
            data: [75, 78, 76, 74, 77, 75],
            borderColor: "#f59e0b",
            backgroundColor: "rgba(245, 158, 11, 0.1)",
            tension: 0.3,
        },
    ],
};

const seasonalCropData = {
    labels: ["Winter", "Spring", "Summer", "Fall"],
    datasets: [
        {
            label: "Crop Yield (tons)",
            data: [450, 680, 720, 540],
            backgroundColor: [
                "rgba(59, 130, 246, 0.7)",
                "rgba(16, 185, 129, 0.7)",
                "rgba(245, 158, 11, 0.7)",
                "rgba(139, 92, 246, 0.7)",
            ],
        },
    ],
};

const marketPriceData = {
    labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
    datasets: [
        {
            label: "Wheat",
            data: [300, 320, 310, 340],
            borderColor: "#3b82f6",
            tension: 0.3,
        },
        {
            label: "Rice",
            data: [250, 270, 280, 260],
            borderColor: "#10b981",
            tension: 0.3,
        },
        {
            label: "Corn",
            data: [180, 190, 185, 200],
            borderColor: "#f59e0b",
            tension: 0.3,
        },
    ],
};

const deliveryStatusData = {
    labels: ["Pending", "In Transit", "Delivered", "Delayed"],
    datasets: [
        {
            data: [15, 25, 45, 15],
            backgroundColor: [
                "rgba(245, 158, 11, 0.7)",
                "rgba(59, 130, 246, 0.7)",
                "rgba(16, 185, 129, 0.7)",
                "rgba(239, 68, 68, 0.7)",
            ],
        },
    ],
};

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            callbacks: {
                label: function (context) {
                    let label = context.dataset.label || "";
                    if (label) {
                        label += ": ";
                    }
                    if (context.parsed.y !== null) {
                        label += new Intl.NumberFormat("en-US", {
                            style: "currency",
                            currency: "USD",
                        }).format(context.parsed.y);
                    }
                    return label;
                },
            },
        },
    },
};

const warehouseChartOptions = {
    ...chartOptions,
    plugins: {
        ...chartOptions.plugins,
        tooltip: {
            callbacks: {
                label: function (context) {
                    return `${context.dataset.label}: ${context.parsed.y}% utilization`;
                },
            },
        },
    },
};

const farmerChartOptions = {
    ...chartOptions,
    plugins: {
        ...chartOptions.plugins,
        tooltip: {
            callbacks: {
                label: function (context) {
                    return `${context.dataset.label}: ${context.parsed.y}% performance`;
                },
            },
        },
    },
};

const cropChartOptions = {
    ...chartOptions,
    plugins: {
        ...chartOptions.plugins,
        tooltip: {
            callbacks: {
                label: function (context) {
                    return `${context.label}: ${context.parsed} tons`;
                },
            },
        },
    },
};

const deliveryChartOptions = {
    ...chartOptions,
    plugins: {
        ...chartOptions.plugins,
        tooltip: {
            callbacks: {
                label: function (context) {
                    return `${context.label}: ${context.parsed} shipments`;
                },
            },
        },
    },
};

// Add data tables
const farmerPerformanceTable = [
    { month: "January", topPerformer: 95, average: 75 },
    { month: "February", topPerformer: 92, average: 78 },
    { month: "March", topPerformer: 94, average: 76 },
    { month: "April", topPerformer: 96, average: 74 },
    { month: "May", topPerformer: 93, average: 77 },
    { month: "June", topPerformer: 97, average: 75 },
];

const seasonalCropTable = [
    { season: "Winter", yield: 450, percentage: "22%" },
    { season: "Spring", yield: 680, percentage: "34%" },
    { season: "Summer", yield: 720, percentage: "36%" },
    { season: "Fall", yield: 540, percentage: "27%" },
];

const marketPriceTable = [
    { week: "Week 1", wheat: 300, rice: 250, corn: 180 },
    { week: "Week 2", wheat: 320, rice: 270, corn: 190 },
    { week: "Week 3", wheat: 310, rice: 280, corn: 185 },
    { week: "Week 4", wheat: 340, rice: 260, corn: 200 },
];

const deliveryStatusTable = [
    { status: "Pending", count: 15, percentage: "15%" },
    { status: "In Transit", count: 25, percentage: "25%" },
    { status: "Delivered", count: 45, percentage: "45%" },
    { status: "Delayed", count: 15, percentage: "15%" },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats Cards -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6"
                >
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-2"
                            >
                                Total Farmers
                            </h3>
                            <p class="text-3xl font-bold text-blue-600">156</p>
                            <p class="text-sm text-gray-600 mt-2">
                                ↑ 12% from last month
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-2"
                            >
                                Active Crops
                            </h3>
                            <p class="text-3xl font-bold text-green-600">
                                1,234
                            </p>
                            <p class="text-sm text-gray-600 mt-2">
                                ↑ 8% from last month
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-2"
                            >
                                Total Orders
                            </h3>
                            <p class="text-3xl font-bold text-yellow-600">
                                892
                            </p>
                            <p class="text-sm text-gray-600 mt-2">
                                ↑ 15% from last month
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6">
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-2"
                            >
                                Total Revenue
                            </h3>
                            <p class="text-3xl font-bold text-purple-600">
                                $263.5K
                            </p>
                            <p class="text-sm text-gray-600 mt-2">
                                ↑ 18% from last month
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Revenue Chart -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Revenue Trend
                        </h3>
                        <div class="h-80">
                            <Line :data="revenueData" :options="chartOptions" />
                        </div>
                    </div>

                    <!-- Warehouse Utilization Chart -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Warehouse Utilization
                        </h3>
                        <div class="h-80">
                            <Bar
                                :data="warehouseUtilizationData"
                                :options="warehouseChartOptions"
                            />
                        </div>
                    </div>
                </div>

                <!-- Additional Charts and Stats -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Crop Distribution -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Crop Distribution
                        </h3>
                        <div class="h-64">
                            <Doughnut
                                :data="cropDistributionData"
                                :options="chartOptions"
                            />
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 col-span-2"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Recent Activities
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="w-2 h-2 bg-blue-500 rounded-full mr-3"
                                ></div>
                                <div>
                                    <p class="text-sm font-medium">
                                        New batch added by John Doe
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        2 hours ago
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-2 h-2 bg-green-500 rounded-full mr-3"
                                ></div>
                                <div>
                                    <p class="text-sm font-medium">
                                        Warehouse A inventory updated
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        4 hours ago
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-2 h-2 bg-yellow-500 rounded-full mr-3"
                                ></div>
                                <div>
                                    <p class="text-sm font-medium">
                                        New order #12345 received
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        6 hours ago
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-2 h-2 bg-purple-500 rounded-full mr-3"
                                ></div>
                                <div>
                                    <p class="text-sm font-medium">
                                        Shipment #789 delivered
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        8 hours ago
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Visualizations -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Farmer Performance Chart -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Farmer Performance Trends
                        </h3>
                        <div class="h-80">
                            <Line
                                :data="farmerPerformanceData"
                                :options="farmerChartOptions"
                            />
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Month
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Top Performer
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Average
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="row in farmerPerformanceTable"
                                        :key="row.month"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.month }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-green-600"
                                        >
                                            {{ row.topPerformer }}%
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600"
                                        >
                                            {{ row.average }}%
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Seasonal Crop Analysis -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Seasonal Crop Analysis
                        </h3>
                        <div class="h-80">
                            <Bar
                                :data="seasonalCropData"
                                :options="cropChartOptions"
                            />
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Season
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Yield (tons)
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Percentage
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="row in seasonalCropTable"
                                        :key="row.season"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.season }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.yield }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.percentage }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Market Price Trends -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Market Price Trends
                        </h3>
                        <div class="h-80">
                            <Line
                                :data="marketPriceData"
                                :options="chartOptions"
                            />
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Week
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Wheat ($)
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Rice ($)
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Corn ($)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="row in marketPriceTable"
                                        :key="row.week"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.week }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-blue-600"
                                        >
                                            ${{ row.wheat }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-green-600"
                                        >
                                            ${{ row.rice }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-yellow-600"
                                        >
                                            ${{ row.corn }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Delivery Status -->
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Delivery Status Breakdown
                        </h3>
                        <div class="h-80">
                            <Doughnut
                                :data="deliveryStatusData"
                                :options="deliveryChartOptions"
                            />
                        </div>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Count
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Percentage
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="row in deliveryStatusTable"
                                        :key="row.status"
                                    >
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.status }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.count }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                                        >
                                            {{ row.percentage }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            Quick Actions
                        </h3>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"
                        >
                            <Link
                                :href="route('farmers.index')"
                                class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                            >
                                <h4 class="font-semibold text-blue-700">
                                    Manage Farmers
                                </h4>
                                <p class="text-blue-600 text-sm mt-1">
                                    View and manage farmer records
                                </p>
                            </Link>
                            <Link
                                :href="route('warehouses.index')"
                                class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors"
                            >
                                <h4 class="font-semibold text-green-700">
                                    Manage Warehouses
                                </h4>
                                <p class="text-green-600 text-sm mt-1">
                                    Track warehouse inventory
                                </p>
                            </Link>
                            <Link
                                :href="route('orders.index')"
                                class="block p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors"
                            >
                                <h4 class="font-semibold text-yellow-700">
                                    Manage Orders
                                </h4>
                                <p class="text-yellow-600 text-sm mt-1">
                                    Process customer orders
                                </p>
                            </Link>
                            <Link
                                :href="route('shipments.index')"
                                class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors"
                            >
                                <h4 class="font-semibold text-purple-700">
                                    Manage Shipments
                                </h4>
                                <p class="text-purple-600 text-sm mt-1">
                                    Track shipment status
                                </p>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
