<template>
  <FormModal :id="id" :name="name" uri="units">
    <FieldText name="name" label="Name" class="col-span-12" />
    <FieldSelect name="section_id" label="Section" class="col-span-12" />
    <FieldSelect name="level_id" label="Level" class="col-span-12" />
    <FieldText name="next_level" label="Next Level" class="col-span-12" type="number"/>
    <TextArea name="description" label="Description" class="col-span-12" />
  </FormModal>
</template>

<script setup lang="ts">
import { FormModal, useFieldSelect, useFieldText, useTextArea } from "thetheme";
import { useFormStore, useIndexStore, useModalsStore } from "spack";

defineProps<{
  id?: number;
}>();

const name = "units";
const form = useFormStore(name)();
const index = useIndexStore("units")();
const FieldText = useFieldText<any>();
const FieldSelect = useFieldSelect<any>();
const TextArea = useTextArea<any>();

form.onSuccess(() => {
  index.fetch();
  useModalsStore().pop();
});
</script>
