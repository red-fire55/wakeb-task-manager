<template>
  <div>
    <div v-if="processing" class="mt-8 flex justify-center">
      <Loader size="40" color="#5850ec" />
    </div>
    <div class="w-full" v-else>
      <Topbar title="Technology Radar">
        <div class="ltr:ml-auto rtl:mr-auto">
          <div class="flex flex-row flex-row-reverse items-center">
            <TheButton
              size="lg"
              data-cy="topbar-invitation-create-button"
              @click="OpenCreateEntryModal"
            >
              New Unit
            </TheButton>
             <TheButton
              size="lg"
              data-cy="topbar-invitation-create-button"
              @click="generatePdf"
              class="mr-3"
            >
              Export Pdf 
            </TheButton>
          </div>
        </div>
      </Topbar>
      <div class="flex flex-row content-center justify-center">
        <div class="pie-container p-8 mx-auto">
          <svg id="radar" style="font-family:cursive"></svg>
        </div>
      </div>
    </div>
    <vue3-html2pdf
        :show-layout="false"
        :float-layout="true"
        :enable-download="true"
        :preview-modal="true"
        :paginate-elements-by-height="1400"
        filename="hee hee"
        :pdf-quality="2"
        :manual-pagination="false"
        pdf-format="a4"
        pdf-orientation="landscape"
        pdf-content-width="800px"

        @progress="onProgress($event)"
        @hasStartedGeneration="hasStartedGeneration()"
        @hasGenerated="hasGenerated($event)"
        ref="html2Pdf"
    >
        <section slot="pdf-content">
          <div class="pie-container p-8 mx-auto">
          <svg id="radar" style="font-family:cursive"></svg>
        </div>
            <!-- PDF Content Here -->
        </section>
    </vue3-html2pdf>
  </div>
</template>

<script>
import { radar_visualization } from "./radar";
import { TheButton, Topbar, Loader } from "thetheme";
import { ref, onMounted, watch } from "vue";
import { useIndexStore, useModalsStore, useFormStore, axios } from "spack";
import Form from "@/components/radar/Form.vue";
import Vue3Html2pdf from 'vue3-html2pdf'
export default {
  components: {
    TheButton,
    Topbar,
    Loader,
    Vue3Html2pdf
  },

  setup() {
    let indexUnits = useIndexStore("units")(),
      processing = ref(true),
      entries = [
        // {
        //   label: "PHP Laravel",
        //   quadrant: 0, // 0,1,2,3 (counting clockwise, starting from bottom right)
        //   ring: 3, // 0,1,2,3 (starting from inside)
        //   moved: 1, // -1 = moved out (triangle pointing down)
        //   //  0 = not moved (circle)
        //   //  1 = moved in  (triangle pointing up)
        // },
      ],
      categories = [
        { name: "Languages & Frameworks" },
        { name: "Platforms" },
        { name: "Techniques" },
        { name: "Tools" },
      ],
      rings = [
        { name: "Adopt", color: "#5ba300" },
        { name: "Trial", color: "#009eb0" },
        { name: "Assess", color: "#c7ba00" },
        { name: "Hold", color: "#e09b96" },
      ];

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

    function drawRadar() {
      localStorage.setItem("units-all-new", JSON.stringify(indexUnits.data.data));
      entries = indexUnits.data.data.map((item) => {
        return {
          label: item.name,
          quadrant: item.section.order,
          ring: item.level.order,
          moved: item.next_level,
        };
      });
      
      let width = window.outerWidth
      radar_visualization({
        svg_id: "radar",
        width: width <1920 && width > 1280? 1150: 1450,
        height: 850,
        colors: {
          background: "#fff",
          grid: "#bbb",
          inactive: "#ddd",
        },
        title: "Wakeb Technology Radar",
        quadrants: categories,
        rings: rings,
        print_layout: true,
        links_in_new_tabs: true,
        entries: entries,
      });
    }
    onMounted(async () => {
      checkProcessing();
      indexUnits.setConfig({
        uri: "units",
        orderByDirection: "desc",
      });
      await indexUnits.fetch();
    });
    watch(
      () => indexUnits.fetching,
      (val) => {
        if (!val) {
          setTimeout(() => {
            drawRadar();
          }, 1000);
        }
      }
    );

    return {
      OpenCreateEntryModal,
      indexUnits,
      checkProcessing,
      height
    };
  },
  methods: {
     generatePdf () {
            this.$refs.html2Pdf.generatePdf()
        }
  },
  async mounted() {
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
