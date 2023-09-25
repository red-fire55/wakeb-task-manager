<template>
  <div class="w-[100vw] h-[795px] text-left" >
    <table class="w-[100vw]">
      <tr>
        <th :class="`w-full`" :style="`height: 25px;`">
          <img
            src="data:image/jpeg;base64, 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iigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigArV0jKaXrEo6+QqD/AIEcVlVq6PmTTtYhHVrcOB/unP8AWpnsaUvi+RlVuz2VxrOn6dPaxmWRENvLggBdvQkn2NYVSCeZYGhWV1iY7mQHAJ96JJvVChJK6ezOju7aw07RrC11CZ3YbpTHb8iRif73YDpWa+vyQoYtLt4rKM8EoN0h+rGlvx53h7TJ16Rb4H9jnI/SsmphFNamlWo07R00XqaNro19qSm4ICQnlp522qffJ61Pt0bT/vvJqMw/hX5Ih+PU0umumqacdJlcLKreZasx4z3U/r+dZMsUkErxSoUkQ4ZWHSnq202J2ik0r36vuaMniK+JQW5jtokYMsUK7Qfr65p+uDydSh1G1+VLlRcRn0fuPrnn8ayK2LT/AImPh24tus1k3nx+pQ/eH4dfypOKVmEZOaab13XyO9sLxL6whukwBIgY+3qPzzXC+KtYTU78Rwtut4AQGH8THqfpwBWdHqF79jFjDK/ksxPloOWz245x7VfttPi0hFvNVUeYPmhtM/M57FvQD/PpUqCg7s3nXdaKilZdWM1IGy0WxsG4lcm5lH93PCj64rJqW6upby6knnbdI5yT29vwHSptIaOPV7NpseWJV3E9B6fhnFaL3UczanJJbaI0LbwhqVzAHZYog3RZGO7H4Dio/EkckniC6WOJ8RqvAU8KFHP0969HrndUeM+JIcfwWkpnx/c7Z/HNYxqNyuzuqYaMYWT3ODopo+6PpTq6DzQp9Mp9MBp6mkpT1NJSAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACtPw/MsWrxpIf3c6mF/owwP1xWZRyMEEgg5BHaiSurDi+WSZJPA1rcywSDDRsUP4VHWxqy/wBo2kWrRgbmAiulH8Ljo30Ix+lY9KLuhzjyvy6GlpF1DtmsL1tttcgYf/nm46N9KqXtlPp900Nwm1hyCOjD1HrUFbuh3TXwayv0SexhjaRjJ96IAfwn8hipfu6ouNppRe/RmFyMEZBByCOMVrLq8F7GsWsQNMVGFuIziRR7+v41lOVLkopVCSVUnOBSAEkAAkk4AAzmqaT3IjKUdjWOl6ZLgwazGoP8M8ZUj8as6eNN0e6Fy+qCdgCpihiJ3AjoSe1UBoGqGLeLKXHocA/l1qg6tG5R1ZWU4KkYIqbX0uaczi0+WzLNrerYaol1bBxHHJuVT12eh/Dip9ftjBq8rBmeOcCaNic5Vuf8R+FZ1a7/APEw8NK3WbTn2n1MbdPyPH4U3o0xRfNFx+aMinRxtLIsaKXdztVQM5JpYYZLiVYoY2kkboqitjMXh1GVGWbVWGCw5W3B9PVv8/Vyl0W5MYX1eiLN9rV3o1rBp0F0XuI1/fyHDbSf4Rn0FUL3VIvs8tvZecxnINxcTH95L7ewrLJJJJJLE5JJzmkqVBIqVaTuugUUUVZkFPplPpgBUZNJtoooANtG2iigA20baKKADbRtoooANtG2iigA20baKKADbRtoooANtG2iigA20baKKADbRtoooANtG2iigA20baKKADbRtoooANtG2iigA20baKKADbRtoooANtG2iigA20baKKADbRtoooANtG2iigA20baKKANTw9IV1RLYgNBdDy5UbowwcfiPWqN9bpbX9zAhYpFIyKSecA0UVH2vkav+GvUh21rQKIfClzKnDz3Cwsf9kDOKKKJdPUmlu/Qydta+jxiGwv71P+PiERpExGdm9sEj3x3oopz2+4dH4/kdaPDOnGP543eU9ZmkbzM+u7NcprCiXTknly88V1JbeYfvOq5xu9T70UVhTep3YiKjHTsY22tfwwA+si2bmK4ieORT3GKKK3n8LOCj8a9S5rjnQpVsNNCwRum5pFH7xvYsa5zaKKKmnsi8R8TQbaNtFFaGIbaNtFFABtqXYKKKQI//2Q=="
            class="w-full absolute z-0"
          />
          <h3 class="text-[24px] font-bold z-10 relative ml-5 mt-8 text-white">
            {{ props.title }}
          </h3>
        </th>
      </tr>
      <tr>
        <td class="flex flex-row flex-wrap w-[800px] gap-1 mt-36">
          <figure
            class="flex flex-col items-center justify-center p-8 text-center 
            bg-white border-gray-200 rounded-b-lg md:rounded-br-lg dark:bg-gray-800 dark:border-gray-700 w-[260px] "
            v-for="(item, i) in props.units"
            :key="i"
          >
            <figcaption class="flex items-center justify-center space-x-3">
              <!-- <img
                class="rounded-full w-9 h-9"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                alt="profile picture"
              /> -->
              <div class="space-y-0.5 font-medium dark:text-white text-left">
                <div>{{ item.label }} ({{ item?.level }})</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ item.category }}</div>
              </div>
            </figcaption>
            <blockquote
              class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400"
            >
              <!-- <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                
              </h3> -->
              <p>
                {{ item.description }}
              </p>
            </blockquote>
          </figure>
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  title?: string;
  bgColor?: number;
  units?: any;
}>();

</script>

<style></style>
