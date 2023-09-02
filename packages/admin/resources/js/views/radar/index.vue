<template>
  <div>
    <Topbar title="Technology Tadar">
      <div class="ltr:ml-auto rtl:mr-auto">
        <div class="flex flex-row flex-row-reverse items-center">
          <TheButton
            size="lg"
            data-cy="topbar-invitation-create-button"
            @click="OpenCreateKpisModal"
          >
            New Entry
          </TheButton>
        </div>
      </div>
    </Topbar>
    <div class="flex flex-row content-center justify-center">
      <div class="pie-container p-8 mx-auto">
        <svg id="radar"></svg>
      </div>
    </div>
  </div>
</template>

<script>
import { radar_visualization } from "./radar";
import { TheButton, Topbar } from "thetheme";
export default {
  components:{
    TheButton, Topbar
  },
  data() {
    return {};
  },
  methods: {},
  async mounted() {
    radar_visualization({
      svg_id: "radar",
      width: 1450,
      height: 1000,
      colors: {
        background: "#fff",
        grid: "#bbb",
        inactive: "#ddd",
      },
      title: "Wakeb Technology Radar",
      quadrants: [
        { name: "Languages & Frameworks" },
        { name: "Platforms" },
        { name: "Techniques" },
        { name: "Tools" },
      ],
      rings: [
        { name: "Adopt", color: "#5ba300" },
        { name: "Trial", color: "#009eb0" },
        { name: "Assess", color: "#c7ba00" },
        { name: "Hold", color: "#e09b96" },
      ],
      print_layout: true,
      links_in_new_tabs: true,
      entries: [
        {
          label: "PHP",
          quadrant: 3, // 0,1,2,3 (counting clockwise, starting from bottom right)
          ring: 2, // 0,1,2,3 (starting from inside)
          moved: -1, // -1 = moved out (triangle pointing down)
          //  0 = not moved (circle)
          //  1 = moved in  (triangle pointing up)
        },
        // ...
      ],
    });
  },
};
</script>

<style>
.pie-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
