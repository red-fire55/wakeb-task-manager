<template>
    <div v-if="processing" class="mt-8 flex justify-center">
        <Loader size="40" color="#5850ec" />
    </div>
    <div v-else>
        <div class="flex  gap-[4%] mt-10 ">
            <div class="w-[48%] bg-white p-4 rounded-lg shadow-lg ">
                <Progress class="w-[96%]"/>
                <taskCards class="w-[96%]"/>
                <milestoneCards class="w-[96%]"/>
            </div>
            <div class="w-[48%] ">
                <chart1 />
                <chart2 />
            </div>
        </div>
        
    </div>
</template>

<script setup lang="ts">
    import Progress from "Component/overview/progress.vue";
    import taskCards from "Component/overview/task-cards.vue";
    import milestoneCards from "Component/overview/milestone-cards.vue";
    import chart1 from "Component/overview/chart1.vue";
    import chart2 from "Component/overview/chart2.vue";

    import {
        Loader
    } from "@/thetheme";
    import {
        useIndexStore
    } from "@/spack";
    import {
        ref
    } from 'vue'
    
</script>

<style scoped>
</style>
