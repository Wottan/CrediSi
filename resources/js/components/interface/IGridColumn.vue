<template>
    <v-col :align-self="alignSelf" :cols="cols"><slot /></v-col>
</template>

<script>
export default {
    props: {
        alignSelf: {
            type: String,
            validator: (v) => ['start', 'center', 'end', 'auto', 'baseline','stretch'].includes(v)
        },
        cols: {
            type: Number
        }
    }
}
</script>
