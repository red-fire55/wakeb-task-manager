<template>
    <div v-if="processing" class="mt-8 flex justify-center">
        <Loader size="40" color="#5850ec" />
    </div>
   <div v-else>
       <Activity/>
   </div>
</template>

<script setup lang="ts">
import {Loader} from "@/thetheme";
import { ref } from 'vue'
import { useIndexStore} from 'spack'
import Activity from "Component/activity_log/Activity.vue";



</script>


<style scoped>
</style>
