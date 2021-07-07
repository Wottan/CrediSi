<template>
  <page-layout>
    <i-container>
      <labels-form />
    </i-container>
  </page-layout>
</template>
<script>
import PageLayout from "../layout/PageLayout.vue";
import LabelsForm from "../forms/LabelsForm.vue";
import IContainer from '../interface/IContainer.vue';
export default {
  components: { PageLayout, LabelsForm, IContainer },
};
</script>
