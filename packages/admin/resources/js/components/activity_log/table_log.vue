<template>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-2xl px-4 ">
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="border-b  mx-4">
                    <div class="flex items-center justify-between space-x-4 pt-3">
                        <div class="flex-1 flex items-center space-x-3">
                            <h5 class="font-semibold">All Projects</h5>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-900 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                        <tr>
                            <th scope="col" class="px-4 py-3">Task</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Users</th>
                            <th scope="col" class="px-4 py-3 min-w-[14rem]">Progress</th>
                            <th scope="col" class="px-4 py-3">Preview</th>
                            <th scope="col" class="px-4 py-3">Time Tracking</th>
                            <th scope="col" class="px-4 py-3">Due Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b hover:bg-gray-100 ">
                            <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">   task 1
                            </th>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="bg-sky-300 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded ">In progress</span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex -space-x-4 w-28">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-10.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full ">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-1.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full ">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-3.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full ">
                                    <a href="#" class="flex-shrink-0 flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-900  border-2 border-white rounded-full hover:bg-gray-600 ">+5</a>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium whitespace-nowrap">
                                <div class="flex justify-end mb-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">75%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 ">
                                    <div class="bg-sky-300 h-1.5 rounded-full" style="width: 75%"></div>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="#" class="font-medium text-white  hover:underline inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                    Website
                                </a>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                <div class="px-2 py-1 border  bg-white rounded-lg text-xs font-medium inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" class="h-4 w-4 mr-1 text-gray-400" viewbox="0 0 20 20">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                                    </svg>
                                    <span class="text-green-500">6:47</span>
                                    /8:00
                                    <button class="bg-orange-500 hover:bg-orange-700 text-white p-1 rounded-md ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 01.75-.75H9a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H7.5a.75.75 0 01-.75-.75V5.25zm7.5 0A.75.75 0 0115 4.5h1.5a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V5.25z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900  text-xs">23 Nov 2022</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 ">
                            <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">Crossplatform analysis</th>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex -space-x-4 w-28">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-6.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-7.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-2.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full">
                                    <a href="#" class="flex-shrink-0 flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-900  border-2 border-white rounded-full hover:bg-gray-600 ">+2</a>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium whitespace-nowrap">
                                <div class="flex justify-end mb-1">
                                    <span class="text-xs font-medium text-gray-500 ">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 ">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                    Website
                                </a>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <div class="px-2 py-1 border  bg-white  rounded-lg text-xs font-medium inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" class="h-4 w-4 mr-1 text-gray-400" viewbox="0 0 20 20">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                                    </svg>
                                    7:00
                                    <button class="bg-green-500 text-white p-1 rounded-md ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900  text-xs">03 Nov 2022</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 ">
                    Showing
                    <span class="font-semibold text-gray-900 ">1-10</span>
                    of
                    <span class="font-semibold text-gray-900 d">1000</span>
                </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 ">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">...</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">100</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>
