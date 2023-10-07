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
          <svg id="radar" style="font-family: cursive"></svg>
        </div>
      </div>
    </div>
    <VueHtml2pdf
      :show-layout="false"
      :float-layout="true"
      :enable-download="false"
      :preview-modal="true"
      :paginate-elements-by-height="1400"
      filename="Radar"
      :pdf-quality="2"
      :manual-pagination="false"
      pdf-format="a4"
      :pdf-margin="0"
      pdf-orientation="landscape"
      pdf-content-width="800px"
      @progress="onProgress($event)"
      ref="html2Pdf"
    >
      <template v-slot:pdf-content>
        <page1 />
        <div class="w-[1122px] h-[790px]">
          <img :src="'data:image/svg+xml;base64,' + img" />
        </div>

        <div class="pie-container mx-auto flex flex-col" id="radar-print-container">
          <div class="w-100" v-for="(category, i) in categories" :key="i">
            <radarSection
              :title="category.name"
              :units="pdf_entries[i].arr"
            />
          </div>
        </div>
      </template>
    </VueHtml2pdf>

    <!-- <div ref="pdf-print" v-show="show_print">
      <radarSection
        :title="category.name"
        bgColor="orange"
        v-for="(category, i) in categories"
        :key="i"
        :data="entries"
      />
    </div> -->
  </div>
</template>

<script>
import { radar_visualization } from "./radar";
import { TheButton, Topbar, Loader } from "thetheme";
import { ref, onMounted, watch } from "vue";
import { useIndexStore, useModalsStore, useFormStore, axios } from "spack";
import Form from "@/components/radar/Form.vue";
import VueHtml2pdf from "vue3-html2pdf";
import radarSection from "./radarSection.vue";
import page1 from "./page1.vue";
import jsPdf from "jspdf";
import * as d3 from "d3";
export default {
  components: {
    TheButton,
    Topbar,
    Loader,
    VueHtml2pdf,
    radarSection,
    page1,
  },
  data() {
    return {
      img: null,
    };
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
      pdf_entries = ref([{ arr: [] }, { arr: [] }, { arr: [] }, { arr: [] }]),
      categories = ref([
        { name: "Languages & Frameworks" },
        { name: "Platforms" },
        { name: "Techniques" },
        { name: "Tools" },
      ]),
      rings = [
        { name: "Adopt", color: "#5ba300" },
        { name: "Trial", color: "#009eb0" },
        { name: "Assess", color: "#c7ba00" },
        { name: "Hold", color: "#e09b96" },
      ],
      show_print = ref(false);

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
    //listen to entries click

    function drawRadar() {
      entries = indexUnits.data.data.map((item) => {
        setTimeout(() => {
          let el = document.getElementById(`entry${item.id}`);
          el.addEventListener("click", () => {
            openEntryModal(item.id);
          });
        }, 3000);

        return {
          id: item.id,
          label: item.name,
          quadrant: item.section.order,
          ring: item.level.order,
          moved: item.next_level,
        };
      });

      indexUnits.data.data.forEach((item) => {
        let new_item = {
          label: item.name,
          quadrant: item.section.order,
          ring: item.level.order,
          moved: item.next_level,
          description: item.description,
          category: categories.value[item.section.order].name,
          level: rings[item.level.order].name,
        };
        pdf_entries.value[Number(item.section.order)].arr.push(new_item);
      });
      let width = window.outerWidth;
      radar_visualization({
        svg_id: "radar",
        width: width < 1920 && width > 1280 ? 1150 : 1450,
        height: 850,
        colors: {
          background: "#fff",
          grid: "#bbb",
          inactive: "#ddd",
        },
        title: "Wakeb Technology Radar",
        quadrants: categories.value,
        rings: rings,
        print_layout: true,
        links_in_new_tabs: false,
        entries: entries,
      });
    }

    function openEntryModal(id) {
      useModalsStore().add(Form, {
        id,
      });
    }
    onMounted(async () => {
      checkProcessing();
      indexUnits.setConfig({
        uri: "units",
        orderByDirection: "desc",
      });
      indexUnits.fetch();
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
      drawRadar,
      categories,
      show_print,
      pdf_entries,
      openEntryModal,
    };
  },
  methods: {
    generatePdf() {
      try {
        var svgElement = document.getElementById("radar");

        var serializer = new XMLSerializer();
        var svgString = serializer.serializeToString(svgElement);

        var svgBlob = new Blob([svgString], { type: "image/svg+xml;charset=utf-8" });

        var reader = new FileReader();

        reader.onload = () => {
          var base64String = reader.result.split(",")[1]; // Extract the base64 string
          this.img = base64String;
          this.$refs.html2Pdf.generatePdf();

          // Now, 'base64String' contains the SVG as a base64-encoded string
        };

        reader.readAsDataURL(svgBlob);
        // localStorage.setItem("hello", "el");

        // let el = this.$refs["pdf-print"];
        // localStorage.setItem("el", el);
        // const doc = new jsPdf();
        // this.show_print = true;
        // doc.html(el, {
        //   callback: function (doc) {
        //     doc.save("radar.pdf");
        //   },
        // });
      } catch (err) {
        localStorage.setItem("canv", err);
      }
    },
  },
  async mounted() {},
};
</script>

<style>
.pie-container {
  display: flex;
  justify-content: center;
}
</style>
