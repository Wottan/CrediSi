<template>
    <v-calendar
          :now="value"
          :value="value"
          :events="events"
          :type="type"
        ></v-calendar>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
    },
    type: {
      type: String,
      validator: (v) => ["week"].includes(v)
    },
    events: {
      type: Array
    }
  }
}
</script>