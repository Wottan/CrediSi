<template>
  <div style="height: 3px" class="v-progress-linear v-progress-linear--visible">
    <div
      style="opacity: 0.3; left: 0%; width: 100%"
      class="v-progress-linear__background blue"
    ></div>
    <div class="v-progress-linear__buffer"></div>
    <div
      class="
        v-progress-linear__indeterminate
        v-progress-linear__indeterminate--active
      "
    >
      <div class="v-progress-linear__indeterminate long blue"></div>
      <div class="v-progress-linear__indeterminate short blue"></div>
    </div>
  </div>
</template>