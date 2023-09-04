<template>
  <div>
    <div v-if="processing" class="mt-8 flex justify-center">
      <Loader size="40" color="#5850ec" />
    </div>
    <div class="w-full" v-else>
      <Topbar title="Technology Tadar">
        <div class="ltr:ml-auto rtl:mr-auto">
          <div class="flex flex-row flex-row-reverse items-center">
            <TheButton
              size="lg"
              data-cy="topbar-invitation-create-button"
              @click="OpenCreateEntryModal"
            >
              New Unit
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
  </div>
</template>

<script>
import { radar_visualization } from "./radar";
import { TheButton, Topbar, Loader } from "thetheme";
import { ref } from "vue";
import { useIndexStore, useModalsStore, useFormStore, axios } from "spack";
import Form from "@/components/radar/Form.vue";
export default {
  components: {
    TheButton,
    Topbar,
    Loader,
  },
  data() {
    return {
      categories: [
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
      entries: [
        // {
        //   label: "PHP Laravel",
        //   quadrant: 0, // 0,1,2,3 (counting clockwise, starting from bottom right)
        //   ring: 3, // 0,1,2,3 (starting from inside)
        //   moved: 1, // -1 = moved out (triangle pointing down)
        //   //  0 = not moved (circle)
        //   //  1 = moved in  (triangle pointing up)
        // },
      ],
    };
  },
  setup() {
    let indexUnits = useIndexStore("units")(),
      processing = ref(true);

    function checkProcessing() {
      setTimeout(function () {
        if (indexUnits.fetching) {
          checkProcessing();
          return;
        }
        renderData();
      }, 150);
    }

    function renderData() {
      processing.value = false;
    }

    function OpenCreateEntryModal(id) {
      useModalsStore().add(Form, {
        id,
      });
    }

    return {
      OpenCreateEntryModal,
      indexUnits,
      checkProcessing,
    };
  },
  methods: {},
  async created() {
    this.checkProcessing();
    this.indexUnits.setConfig({
      uri: "units",
      orderByDirection: "desc",
    });
    await this.indexUnits.fetch();
    setTimeout(() => {
      this.entries = this.indexUnits.data.data.map((item) => {
        return {
          label: item.name,
          quadrant: item.section.order,
          ring: item.level.order,
          moved: item.next_level.id,
        };
      });
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
        quadrants: this.categories,
        rings: this.rings,
        print_layout: true,
        links_in_new_tabs: true,
        entries: this.entries,
      });
    }, 2000);
  },
  async mounted() {},
};
</script>

<style>
.pie-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
