<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { onMounted } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

// Animation on scroll
onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-fade-in");
            }
        });
    });

    document.querySelectorAll(".animate-on-scroll").forEach((el) => {
        observer.observe(el);
    });
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-800"
                            />
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div
                            class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                        >
                            <template v-if="canLogin">
                                <Link
                                    v-if="$page.props.auth.user"
                                    :href="route('dashboard')"
                                    class="text-sm text-gray-700 hover:text-gray-900"
                                    >Dashboard</Link
                                >
                                <template v-else>
                                    <Link
                                        :href="route('login')"
                                        class="text-sm text-gray-700 hover:text-gray-900"
                                        >Log in</Link
                                    >
                                    <Link
                                        v-if="canRegister"
                                        :href="route('register')"
                                        class="ml-4 text-sm text-gray-700 hover:text-gray-900"
                                        >Register</Link
                                    >
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section with Animation -->
        <div class="relative overflow-hidden pt-16">
            <div class="max-w-7xl mx-auto">
                <div
                    class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
                >
                    <main
                        class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"
                    >
                        <div class="sm:text-center lg:text-left">
                            <h1
                                class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl"
                            >
                                <span class="block"
                                    >Smart Inventory Management</span
                                >
                                <span class="block text-green-600"
                                    >for Perishable Goods</span
                                >
                            </h1>
                            <p
                                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"
                            >
                                Track your produce from harvest to distribution,
                                minimize spoilage, and maximize efficiency with
                                our comprehensive inventory management system.
                            </p>
                            <div
                                class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
                            >
                                <div class="rounded-md shadow">
                                    <Link
                                        :href="route('register')"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10"
                                    >
                                        Get Started
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <!-- Decorative blob -->
            <div
                class="absolute top-0 right-0 -translate-y-12 translate-x-1/4 transform"
            >
                <div
                    class="h-96 w-96 bg-gradient-to-br from-green-400 to-emerald-400 opacity-20 rounded-full blur-3xl"
                ></div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="bg-gradient-to-b from-white to-green-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-2 gap-8 md:grid-cols-4 animate-on-scroll"
                >
                    <div class="text-center">
                        <div class="text-4xl font-bold text-green-600">95%</div>
                        <div class="mt-2 text-sm text-gray-600">
                            Reduced Waste
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-green-600">
                            2.5x
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Increased Efficiency
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-green-600">
                            1000+
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Active Users
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-green-600">
                            24/7
                        </div>
                        <div class="mt-2 text-sm text-gray-600">Monitoring</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Section with new color scheme -->
        <div class="py-16 bg-green-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2
                        class="text-base text-green-600 font-semibold tracking-wide uppercase"
                    >
                        Features
                    </h2>
                    <p
                        class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl"
                    >
                        Complete Inventory Control
                    </p>
                </div>

                <div class="mt-10">
                    <div
                        class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10"
                    >
                        <!-- Feature 1 -->
                        <div
                            class="relative transform hover:scale-105 transition-all duration-300 animate-on-scroll"
                        >
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    />
                                </svg>
                            </div>
                            <div class="ml-16">
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Detailed Tracking
                                </h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Monitor type, quantity, harvest date, and
                                    storage location of all your produce in
                                    real-time.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div
                            class="relative transform hover:scale-105 transition-all duration-300 animate-on-scroll"
                        >
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-16">
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Real-time Monitoring
                                </h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Keep track of storage conditions including
                                    temperature and humidity to ensure optimal
                                    preservation.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div
                            class="relative transform hover:scale-105 transition-all duration-300 animate-on-scroll"
                        >
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-16">
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Loss Analysis
                                </h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Track and analyze loss causes at each stage,
                                    from harvesting to transportation.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 4 -->
                        <div
                            class="relative transform hover:scale-105 transition-all duration-300 animate-on-scroll"
                        >
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-16">
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Automated Alerts
                                </h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Receive timely notifications for expiring
                                    produce and storage condition anomalies.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900">
                        What Our Users Say
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Trusted by farmers and warehouse managers worldwide
                    </p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-3 animate-on-scroll">
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300"
                    >
                        <div class="flex items-center mb-4">
                            <div
                                class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center"
                            >
                                <span class="text-green-600 text-xl font-bold"
                                    >JD</span
                                >
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    John Doe
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Farm Manager
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "This system has revolutionized how we manage our
                            produce. We've reduced waste by 60% in just three
                            months."
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300"
                    >
                        <div class="flex items-center mb-4">
                            <div
                                class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center"
                            >
                                <span class="text-green-600 text-xl font-bold"
                                    >AS</span
                                >
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Alice Smith
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Warehouse Director
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "The real-time monitoring has been a game-changer.
                            We can now prevent spoilage before it happens."
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300"
                    >
                        <div class="flex items-center mb-4">
                            <div
                                class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center"
                            >
                                <span class="text-green-600 text-xl font-bold"
                                    >RJ</span
                                >
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Robert Johnson
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Supply Chain Manager
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600">
                            "The automated alerts and loss tracking have helped
                            us optimize our entire supply chain."
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Updated CTA Section -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-600">
            <div
                class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8 animate-on-scroll"
            >
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Ready to reduce food waste?</span>
                    <span class="block"
                        >Start managing your inventory today.</span
                    >
                </h2>
                <p class="mt-4 text-lg leading-6 text-green-100">
                    Join farmers and warehouse managers who are already
                    optimizing their operations.
                </p>
                <Link
                    :href="route('register')"
                    class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-green-50 transform hover:scale-105 transition-all duration-300 sm:w-auto"
                >
                    Sign up for free
                </Link>
            </div>
        </div>
    </div>
</template>

<style>
.animate-fade-in {
    animation: fadeIn 1s ease-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-on-scroll {
    opacity: 0;
}
</style>
