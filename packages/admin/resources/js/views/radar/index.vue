<template>
  <div class="cycle">
    <div v-for="i in segments" :key="i" class="segment"></div>
    <div class="buttons">
      <button @click="incrementSegments">+</button>
      <button @click="decrementSegments">-</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      segments: 4 // default number of segments
    }
  },
  methods: {
    incrementSegments() {
      this.segments++
    },
    decrementSegments() {
      if (this.segments > 1) {
        this.segments--
      }
    }
  }
}
</script>

<style>
.cycle {
  width: 200px;
  height: 200px;
  position: relative;
  border-radius: 50%;
  background-color: #eee;
}

.segment {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transform-origin: 50% 50%;
  border: 2px solid red;
  border-radius: 50%;
}

.segment:nth-child(1) {
  clip-path: polygon(50% 50%, 100% 50%, 100% 0%, 50% 0%);
}

.segment:nth-child(2) {
  clip-path: polygon(50% 50%, 100% 50%, 100% 100%, 50% 100%);
}

.segment:nth-child(3) {
  clip-path: polygon(50% 50%, 0% 50%, 0% 0%, 50% 0%);
}

.segment:nth-child(4) {
  clip-path: polygon(50% 50%, 0% 50%, 0% 100%, 50% 100%);
}

.buttons {
  position: absolute;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
}

.buttons button {
  margin: 0 5px;
}
</style>