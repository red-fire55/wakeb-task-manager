<template>
    <div class="relative overflow-x-auto mt-5 bg-white rounded-lg shadow-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-3 py-3">
                    Total Expenses
                </th>
                <th scope="col" class="px-3 py-3 text-blue-600">
                    Billable Expenses
                </th>
                <th scope="col" class="px-3 py-3 text-green-600">
                    Billed Expenses

                </th>
                <th scope="col" class="px-3 py-3 text-red-600">
                    Unbilled Expenses
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b ">
                <th scope="row" class="px-3 py-4  ">
                    <div>$829.00</div>

                </th>
                <td class="px-3 py-4 text-blue-600">
                    <div>$00:00</div>
                </td>
                <td class="px-3 py-4 text-green-600">
                    <div>$00:00</div>
                </td>
                <td class="px-3 py-4 text-red-600">
                    <div>$00:00</div>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</template>

<script>
export default {
    name: "statc_table"
}
</script>

<style scoped>

</style>
