<template>

    <ol class="relative border-l border-gray-200  mt-10">
        <li class="mb-10 ml-6" v-for="(log, i) in logs" :key="i">
        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white ">
            <img class="rounded-full shadow-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-6.png" alt="Bonnie image"/>
        </span>
            <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex ">
                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ log.updated_at.toString().substr(0, 10) }}</time>
                <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                   قام {{log?.causer?.name}} 
                    {{ log.event == 'created'? 'بإنشاء' : log.event == 'updated'? 'بتعديل بيانات': '' }} 
                    <a href="#" class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">{{ log?.properties?.attributes.measure }}</a> 
                    <!-- to <span class="bg-gray-100 text-gray-800 text-xs font-normal mr-2 px-2.5 py-0.5 rounded ">Funny Group</span></div> -->
                </div>
            </div>
        </li>
        
    </ol>

</template>

<script setup lang="ts">
import {axios} from "spack"
import {ref} from "vue"

let logs = ref([])
axios.get('logs').then(res=>{
    logs.value = res.data.data
})
</script>

<style scoped>
</style>
