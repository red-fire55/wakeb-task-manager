<template>
    <div>
        <IndexTable  :noSearch="false" :noFilters="true" filterUri="" name="milestones"/>
    <TableTh />
    </div>
</template>


<script>
import {defineComponent} from "vue"
import { IndexTable, TableTh } from "thetheme"
export default defineComponent({
name: "milestones",
components:{
    IndexTable, TableTh
},
setup(){

}
})
</script>

<style>
</style>