<template>
<div>
  <button @click="sliceCount++" class="bg-[red] text-white mr-5">add</button>
     <button @click="sliceCount--">remove</button>
  <div class="flex flex-row content-center justify-center">
    
    <div class="pie-container p-8 mx-auto">
    <svg :width="size" :height="size">
      <circle :cx="radius" :cy="radius" :r="radius" fill="white" stroke="black" stroke-width="2" />
      <g v-for="(slice, index) in slices" :key="index" fill="white">
        <path :d="describeArc(radius, radius, radius, slice.startAngle, slice.endAngle)" :stroke="slice.color" />
      </g>
    </svg>
  </div>
  </div></div>
</template>

<script>
export default {
  data() {
    return {
      slices: [],
      size: 900,
      radius: 250,
      sliceCount: 5 // Change this value to adjust the number of slices
    }
  },
  methods: {
    describeArc(x, y, radius, startAngle, endAngle) {
      const start = this.polarToCartesian(x, y, radius, endAngle)
      const end = this.polarToCartesian(x, y, radius, startAngle)
      const largeArcFlag = endAngle - startAngle <= 180 ? "0" : "1"
      const d = [
        "M", start.x, start.y,
        "A", radius, radius, 0, largeArcFlag, 0, end.x, end.y,
        "L", x, y,
        "L", start.x, start.y,
        "z"
      ].join(" ")
      return d
    },
    polarToCartesian(x, y, radius, angleInDegrees) {
      const angleInRadians = (angleInDegrees - 90) * Math.PI / 180.0
      return {
        x: x + (radius * Math.cos(angleInRadians)),
        y: y + (radius * Math.sin(angleInRadians))
      }
    },
    updateSlices() {
      const sliceAngle = 360 / this.sliceCount
      this.slices = []
      for (let i = 0; i < this.sliceCount; i++) {
        const startAngle = i * sliceAngle
        const endAngle = (i + 1) * sliceAngle
        const color = `hsl(${i * (360 / this.sliceCount)}, 50%, 50%)`
        this.slices.push({ startAngle, endAngle, color })
      }
    }
  },
  mounted() {
    this.updateSlices()
  },
  watch: {
    sliceCount() {
      this.updateSlices()
    }
  }
}
</script>

<style>
.pie-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>