<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>
  <div v-else>
    <section>
      <KpiMetrics @filterKpis="filter_kpi_category" :filters="filters"/>

      <Topbar :title="__('BalanceScore')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <div class="flex flex-row flex-row-reverse">
            <TheButton
              size="sm"
              data-cy="topbar-invitation-create-button"
              @click="OpenCreateKpisModal"
            >
              {{ __("NewKpi") }}
            </TheButton>
            <DatePicker
              name=""
              value="filter_date_from"
              :formName="'kpis'"
              class="col-span-12 mr-5"
            />
            <DatePicker
              name=""
              value="filter_date_to"
              :formName="'kpis'"
              class="col-span-12"
            />
            <FiltersList
              :filters="filters"
              @removeCategory="remove_category"
              @removeDate="remove_date"
            />
          </div>
        </div>
      </Topbar>
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <TableTh
                      name="Measure"
                      :index="indexKpis"
                      :label="__('KpiMeasured')"
                      sort="Kpi Meaured"
                    />
                    <TableTh name="Weight" :index="indexKpis" :label="__('Weight')" />
                    <TableTh
                      name="Sub Weight"
                      :index="indexKpis"
                      :label="__('Sub Weight')"
                    />
                    <TableTh name="Category" :index="indexKpis" :label="__('Category')" />
                    <TableTh
                      name="Owner Name"
                      :index="indexKpis"
                      :label="__('Owner Name')"
                    />
                    <TableTh name="Target" :index="indexKpis" :label="__('Target')" />
                    <TableTh name="Notes" :index="indexKpis" :label="__('Notes')" />
                    <TableTh name="Status" :index="indexKpis" :label="__('Status')" />
                    <TableTh name="Actions" :index="indexKpis" :label="__('Actions')" />
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="item in indexKpis.data.data" :key="item.id">
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <div class="flex">
                        <div class="text-sm ltr:ml-3 rtl:mr-3">
                          <span
                            class="mb-1 block truncate text-sm font-medium leading-none text-gray-900"
                          >
                            {{ item.measure }}
                          </span>
                        </div>
                      </div>
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.weight }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <div class="flex justify-end mb-1">
                        <span
                          class="text-xs font-medium text-gray-500 dark:text-gray-400"
                        >
                          {{ item.sub_weight }}%</span
                        >
                      </div>
                      <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div
                          class="bg-sky-300 h-1.5 rounded-full"
                          :style="`width: ${Number(item.sub_weight)}%`"
                        ></div>
                      </div>
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <span class="cursor-pointer">{{ item.category.name }}</span>
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <div class="flex -space-x-4 w-28">
                        <img
                          :src="item.owner.avatar"
                          alt=""
                          class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full"
                        />
                      </div>
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <span class="">{{ item.target }}</span>
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.notes }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.status }}
                    </td>
                    <td
                      class="whitespace-no-wrap flex items-center justify-start px-6 py-4 text-right text-sm font-medium leading-5"
                    >
                      <span class="ml-2" @click="openModal(item.id)">
                        <PencilSquareIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
                      <TrashIcon
                        v-if="can('user:delete')"
                        class="ml-2 w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        @click.prevent="indexKpis.deleteIt(item.id)"
                      />
                      <span class="ml-2" @click="OpenCreateKpisResultModal(item.id)">
                        <PlusCircleIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
              <IndexPagination :index="indexKpis" />
            </div>
          </div>
        </div>
      </div>
      <charts class="w-full mb-10" />
    </section>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";
import { useIndexStore, useModalsStore, useFormStore, axios } from "spack";
import {
  IndexPagination,
  Loader,
  TableTh,
  TheButton,
  Topbar,
  DatePicker,
  Dropdown,
} from "thetheme";
import Form from "@/components/kpi/Form.vue";
import ResultForm from "@/components/kpi/addKpiResult.vue";
import KpiMetrics from "@/components/kpi/kpi_metrics.vue";
import charts from "@/components/kpi/charts.vue";
import FiltersList from "@/components/kpi/filtersList.vue";
import { PencilSquareIcon, TrashIcon, PlusCircleIcon } from "@heroicons/vue/24/outline";
let indexKpis = useIndexStore("kpis")(),
  processing = ref(true),
  kpis_form = useFormStore("kpis")(),
  categories = [],
  dates = [],
  filters = ref({
    categories: [],
    dates: [],
  });

checkProcessing();
indexKpis.setConfig({
  uri: "kpis",
  filterUri: "kpis",
  orderByDirection: "desc",
  page: 2,
});
indexKpis.fetch();

function checkProcessing() {
  setTimeout(function () {
    if (indexKpis.fetching) {
      checkProcessing();
      return;
    }
    renderData();
  }, 150);
}
function renderData() {
  processing.value = false;
}
function OpenCreateKpisModal(id = null) {
  useModalsStore().add(Form, {
    id,
  });
}
function OpenCreateKpisResultModal(id = null) {
  useModalsStore().add(ResultForm, {
    id,
  });
}
function openModal(id: number | null = null) {
  useModalsStore().add(Form, {
    id,
  });
}

function filter_kpi_category(data) {
  filters.value = {
    categories: data,
    dates: dates,
  };
  categories = data;
  axios
    .get(`kpis`, {
      params: { ...indexKpis.params, "category[]": data, "date[]": dates },
    })
    .then((res) => {
      indexKpis.data.data = res.data.data;
    });
}
watch(
  () => kpis_form.data["filter_date_from"],
  (val) => {
    if (kpis_form.data["filter_date_to"]) {
      dates[0] = val;
      dates[1] = kpis_form.data["filter_date_to"];
      filters.value = {
        categories: categories,
        dates: dates,
      };
      axios
        .get(`kpis`, {
          params: {
            ...indexKpis.params,
            "category[]": categories,
            "date[]": dates,
          },
        })
        .then((res) => {
          indexKpis.data.data = res.data.data;
        });
    }
  },
  { deep: true }
);
watch(
  () => kpis_form.data["filter_date_to"],
  (val) => {
    if (kpis_form.data["filter_date_from"]) {
      dates[0] = kpis_form.data["filter_date_from"];
      dates[1] = val;
      filters.value = {
        categories: categories,
        dates: dates,
      };
      axios
        .get(`kpis`, {
          params: {
            ...indexKpis.params,
            "category[]": categories,
            "date[]": dates,
          },
        })
        .then((res) => {
          indexKpis.data.data = res.data.data;
        });
    }
  },
  { deep: true }
);

function remove_category(data) {
  let index = categories.indexOf(data);
  categories.splice(index, 1);
  filters.value = {
    categories: categories,
    dates: dates,
  };
  axios
    .get(`kpis`, {
      params: {
        ...indexKpis.params,
        "category[]": categories,
        "date[]": dates,
      },
    })
    .then((res) => {
      indexKpis.data.data = res.data.data;
    });
}
function remove_date() {
  dates = [];
  filters.value = {
    categories: categories,
    dates: dates,
  };
  axios
    .get(`kpis`, {
      params: {
        ...indexKpis.params,
        "category[]": categories,
        "date[]": dates,
      },
    })
    .then((res) => {
      indexKpis.data.data = res.data.data;
    });
}
</script>
