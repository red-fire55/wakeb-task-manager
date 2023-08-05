<template>
  <!-- pie basic level -->
 <div class="grid justify-center">
     <div class="pie w-[550px] h-[550px] bg-white rounded-full flex flex-row flex-wrap border border-grey overflow-hidden">
      <div class="h-[50%] w-[50%] bg-white rounded-tl-full flex justify-end content-end">
        <div class="h-[30%] w-[30%] border border-black rounded-tl-full self-end">
        </div>
      </div>
      <div class="h-[50%] w-[50%]  bg-[green]  flex justify-start content-start">
        <div class="h-[30%] w-[30%] border border-black rounded-tr-full self-end">
        </div>
      </div>
      <div class="h-[50%] w-[50%]  bg-[yellow] flex justify-end content-end">
        <div class="h-[30%] w-[30%] border border-black rounded-bl-full self-start">
        </div>
      </div>
      <div class="h-[50%] w-[50%]  bg-[red] flex justify-start content-end">
        <div class="h-[30%] w-[30%] border border-black rounded-br-full self-start">
        </div>
      </div>
  </div>
 </div>
</template>

<script>
export default {

}
</script>

<style>
 .pie{
 }
</style>