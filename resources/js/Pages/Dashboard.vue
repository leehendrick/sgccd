<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {
    ArrowDownCircleIcon,
    ArrowPathIcon,
    ArrowUpCircleIcon,
} from "@heroicons/vue/20/solid";

const stats = [
    {
        name: "Solicitações",
        value: "24",
        changeType: "positive",
    },
    {
        name: "Turmas",
        value: "0",
        changeType: "negative",
    },
    {
        name: "Formandos",
        value: "0",
        changeType: "positive",
    },
    {
        name: "Cursos",
        value: "14",
        changeType: "negative",
    },
];
const statuses = {
    Novo: "text-green-700 bg-green-50 ring-green-600/20",
    Visualizado: "text-gray-600 bg-gray-50 ring-gray-500/10",
    Overdue: "text-red-700 bg-red-50 ring-red-600/10",
};
const days = [
    {
        date: "Today",
        dateTime: "2023-03-22",
        transactions: [
            {
                id: 1,
                href: "/solicitacoes",
                amount: "Solicitação de curso",
                tax: "Hendrick Nkuba",
                status: "Novo",
                client: "Curso",
                description: "Curso de Excel Avançado",
                icon: ArrowDownCircleIcon,
            },
            {
                id: 1,
                href: "/solicitacoes",
                amount: "Solicitação de curso",
                tax: "Hendrick Nkuba",
                status: "Novo",
                client: "Curso",
                description: "Curso de Excel Avançado",
                icon: ArrowDownCircleIcon,
            },
            {
                id: 1,
                href: "/solicitacoes",
                amount: "Solicitação de curso",
                tax: "Hendrick Nkuba",
                status: "Novo",
                client: "Curso",
                description: "Curso de Excel Avançado",
                icon: ArrowDownCircleIcon,
            },
        ],
    },
    {
        date: "Yesterday",
        dateTime: "2023-03-21",
        transactions: [
            {
                id: 1,
                href: "/solicitacoes",
                amount: "Solicitação de curso",
                tax: "Hendrick Nkuba",
                status: "Visualizado",
                client: "Curso",
                description: "Curso de Excel Avançado",
                icon: ArrowDownCircleIcon,
            },
        ],
    },
];
const clients = [
    {
        id: 1,
        name: "Tuple",
        imageUrl: "https://tailwindui.com/img/logos/48x48/tuple.svg",
        lastInvoice: {
            date: "December 13, 2022",
            dateTime: "2022-12-13",
            amount: "$2,000.00",
            status: "Overdue",
        },
    },
    {
        id: 2,
        name: "SavvyCal",
        imageUrl: "https://tailwindui.com/img/logos/48x48/savvycal.svg",
        lastInvoice: {
            date: "January 22, 2023",
            dateTime: "2023-01-22",
            amount: "$14,000.00",
            status: "Paid",
        },
    },
    {
        id: 3,
        name: "Reform",
        imageUrl: "https://tailwindui.com/img/logos/48x48/reform.svg",
        lastInvoice: {
            date: "January 23, 2023",
            dateTime: "2023-01-23",
            amount: "$7,600.00",
            status: "Paid",
        },
    },
];
</script>
<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <main>
            <div class="relative isolate overflow-hidden">
                <!-- Secondary navigation -->
                <header class="pb-4 pt-6 sm:pb-6">
                    <div
                        class="mx-auto flex max-w-7xl flex-wrap items-center gap-6 px-4 sm:flex-nowrap sm:px-6 lg:px-8"
                    >
                        <h1
                            class="text-base font-semibold leading-7 text-gray-900"
                        >
                            Statistics
                        </h1>
                    </div>
                </header>

                <!-- Stats -->
                <div
                    class="border-b border-b-gray-900/10 lg:border-t lg:border-t-gray-900/5"
                >
                    <dl
                        class="mx-auto grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 lg:px-2 xl:px-0"
                    >
                        <div
                            v-for="(stat, statIdx) in stats"
                            :key="stat.name"
                            :class="[
                                statIdx % 2 === 1
                                    ? 'sm:border-l'
                                    : statIdx === 2
                                      ? 'lg:border-l'
                                      : '',
                                'flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8',
                            ]"
                        >
                            <dt
                                class="text-sm font-medium leading-6 text-gray-500"
                            >
                                {{ stat.name }}
                            </dt>
                            <dd
                                :class="[
                                    stat.changeType === 'negative'
                                        ? 'text-rose-600'
                                        : 'text-gray-700',
                                    'text-xs font-medium',
                                ]"
                            >
                                {{ stat.change }}
                            </dd>
                            <dd
                                class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900"
                            >
                                {{ stat.value }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div
                    class="absolute left-0 top-full -z-10 mt-96 origin-top-left translate-y-40 -rotate-90 transform-gpu opacity-20 blur-3xl sm:left-1/2 sm:-ml-96 sm:-mt-10 sm:translate-y-0 sm:rotate-0 sm:transform-gpu sm:opacity-50"
                    aria-hidden="true"
                >
                    <div
                        class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-[#FF80B5] to-[#9089FC]"
                        style="
                            clip-path: polygon(
                                100% 38.5%,
                                82.6% 100%,
                                60.2% 37.7%,
                                52.4% 32.1%,
                                47.5% 41.8%,
                                45.2% 65.6%,
                                27.5% 23.4%,
                                0.1% 35.3%,
                                17.9% 0%,
                                27.7% 23.4%,
                                76.2% 2.5%,
                                74.2% 56%,
                                100% 38.5%
                            );
                        "
                    />
                </div>
            </div>

            <div class="space-y-16 py-16 xl:space-y-20">
                <!-- Recent activity table -->
                <div>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h2
                            class="mx-auto max-w-2xl text-base font-semibold leading-6 text-gray-900 lg:mx-0 lg:max-w-none"
                        >
                            Recent activity
                        </h2>
                    </div>
                    <div class="mt-6 overflow-hidden border-t border-gray-100">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div
                                class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none"
                            >
                                <table class="w-full text-left">
                                    <thead class="sr-only">
                                        <tr>
                                            <th>Amount</th>
                                            <th class="hidden sm:table-cell">
                                                Client
                                            </th>
                                            <th>More details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-for="day in days"
                                            :key="day.dateTime"
                                        >
                                            <tr
                                                class="text-sm leading-6 text-gray-900"
                                            >
                                                <th
                                                    scope="colgroup"
                                                    colspan="3"
                                                    class="relative isolate py-2 font-semibold"
                                                >
                                                    <time
                                                        :datetime="day.dateTime"
                                                        >{{ day.date }}</time
                                                    >
                                                    <div
                                                        class="absolute inset-y-0 right-full -z-10 w-screen border-b border-gray-200 bg-gray-50"
                                                    />
                                                    <div
                                                        class="absolute inset-y-0 left-0 -z-10 w-screen border-b border-gray-200 bg-gray-50"
                                                    />
                                                </th>
                                            </tr>
                                            <tr
                                                v-for="transaction in day.transactions"
                                                :key="transaction.id"
                                            >
                                                <td class="relative py-5 pr-6">
                                                    <div class="flex gap-x-6">
                                                        <component
                                                            :is="
                                                                transaction.icon
                                                            "
                                                            class="hidden h-6 w-5 flex-none text-gray-400 sm:block"
                                                            aria-hidden="true"
                                                        />
                                                        <div class="flex-auto">
                                                            <div
                                                                class="flex items-start gap-x-3"
                                                            >
                                                                <div
                                                                    class="text-sm font-medium leading-6 text-gray-900"
                                                                >
                                                                    {{
                                                                        transaction.amount
                                                                    }}
                                                                </div>
                                                                <div
                                                                    :class="[
                                                                        statuses[
                                                                            transaction
                                                                                .status
                                                                        ],
                                                                        'rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset',
                                                                    ]"
                                                                >
                                                                    {{
                                                                        transaction.status
                                                                    }}
                                                                </div>
                                                            </div>
                                                            <div
                                                                v-if="
                                                                    transaction.tax
                                                                "
                                                                class="mt-1 text-xs leading-5 text-gray-500"
                                                            >
                                                                {{
                                                                    transaction.tax
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="absolute bottom-0 right-full h-px w-screen bg-gray-100"
                                                    />
                                                    <div
                                                        class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"
                                                    />
                                                </td>
                                                <td
                                                    class="hidden py-5 pr-6 sm:table-cell"
                                                >
                                                    <div
                                                        class="text-sm leading-6 text-gray-900"
                                                    >
                                                        {{ transaction.client }}
                                                    </div>
                                                    <div
                                                        class="mt-1 text-xs leading-5 text-gray-500"
                                                    >
                                                        {{
                                                            transaction.description
                                                        }}
                                                    </div>
                                                </td>
                                                <td class="py-5 text-right">
                                                    <div
                                                        class="flex justify-end"
                                                    >
                                                        <a
                                                            :href="
                                                                transaction.href
                                                            "
                                                            class="text-sm font-medium leading-6 text-primary"
                                                            >View<span
                                                                class="hidden sm:inline"
                                                            >
                                                                transaction</span
                                                            ><span
                                                                class="sr-only"
                                                                >, invoice #{{
                                                                    transaction.invoiceNumber
                                                                }},
                                                                {{
                                                                    transaction.client
                                                                }}</span
                                                            ></a
                                                        >
                                                    </div>
                                                    <div
                                                        class="mt-1 text-xs leading-5 text-gray-500"
                                                    >
                                                        Invoice
                                                        <span
                                                            class="text-gray-900"
                                                            >#{{
                                                                transaction.invoiceNumber
                                                            }}</span
                                                        >
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </AdminLayout>
</template>
