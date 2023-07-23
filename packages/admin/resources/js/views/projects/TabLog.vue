<template>
    <div v-if="processing" class="mt-8 flex justify-center">
        <Loader size="40" color="#5850ec" />
    </div>
   <div v-else>
       <Activity/>
   </div>
</template>

<script setup lang="ts">
// import Table_log from "Component/activity_log/table_log.vue";
import {Loader} from "@/thetheme";
import { ref } from 'vue'
import { useIndexStore} from 'spack'
import Activity from "Component/activity_log/Activity.vue";
const indexUser = useIndexStore('user')(),
    indexInvitation = useIndexStore('invitation')(),
    processing = ref(true)
// invitations = ref([])

checkProcessing()

indexUser.setConfig({
    uri: 'users',
    orderByDirection: 'desc',
})
indexUser.fetch()

indexInvitation.setConfig({
    uri: 'invitations',
    orderByDirection: 'desc',
})
indexInvitation.fetch()

function checkProcessing() {
    setTimeout(function () {
        if (indexUser.fetching || indexInvitation.fetching) {
            checkProcessing()
            return
        }

        renderData()
    }, 150)
}

function renderData() {
    processing.value = false
}

</script>


<style scoped>

</style>
