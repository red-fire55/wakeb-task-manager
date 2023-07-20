<template>
    <section class=" mt-5 shadow-lg">
        <div class="mx-auto max-w-screen-2xl ">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="mx-4 mb-5">
                    <div class="flex items-center justify-between space-x-4 pt-3">
                        <div class="flex-1 flex items-center space-x-3">
                            <h5 class=" font-semibold">Overview</h5>
                        </div>
                    </div>

                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100  ">
                        <tr>
                            <th scope="col" class="px-4 py-3">Project</th>
                            <th scope="col" class="px-4 py-3">Customer</th>
                            <th scope="col" class="px-4 py-3">Billing Type</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Date Created</th>
                            <th scope="col" class="px-4 py-3">Start Date</th>
                            <th scope="col" class="px-4 py-3"> Deadline</th>
                            <th scope="col" class="px-4 py-3">Total Logged Hours</th>
                            <th scope="col" class="px-4 py-3">Tags</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr class="hover:bg-gray-100 ">
                            <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                <div class="flex items-center">
                                    <span class="block h-2.5 w-2.5 rounded-full ltr:mr-3 rtl:ml-3" :style="{ 'background-color': project.data.meta.color }"></span>
                                    <h1 class="text-sm font-semibold text-gray-900" data-cy="page-title">
                                        {{ project.data.name }}
                                    </h1>
                                </div>
                            </th>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex -space-x-4 w-28">
                                    Fisher-Hartmann
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span
                                    class="bg-primary-100 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded ">Task Hours</span>
                            </td>
                            <td class="px-4 py-2 font-medium whitespace-nowrap">
                                In Progress
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                2023-07-20
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                2023-07-20
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900  text-xs">2023-09-20</td>
                            <td class="px-4 py-2">
                                00:00
                            </td>
                            <td class="px-4 py-2">
                                wordpress
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">

import {useProjectDetail} from "Store/project-detail";

const project = useProjectDetail()


</script>

<style scoped>

</style>
