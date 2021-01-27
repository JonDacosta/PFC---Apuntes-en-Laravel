<template>
    <span v-text="formatearFecha"></span>
</template>

<script>
export default {
    //le pasamos un props del show.blade para la fecha
    props: ['fecha'],
    // mounted() {
    //     console.log('elcomponenteestalisto');
    // }
    computed: {
        formatearFecha() {
            return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
        }
    }
}
</script>