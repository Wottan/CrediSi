<template>
  <i-footer>
    <i-container align="center"> Copyright MisionesOnline {{ year }} </i-container>
  </i-footer>
</template>
<script>
import { DateTime } from 'luxon';
export default {
  data() {
    return {
      year: DateTime.now().year
    }
  }
}
</script>
