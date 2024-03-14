<!-- workshop.vue -->
<template>
    <div class="subcomponent">

    </div>
</template>

<style src="../../../node_modules/@vueform/multiselect/themes/default.css"></style>

<script>
import Multiselect from '@vueform/multiselect'

export default {
    props: ['genre', 'abilities', 'options'],
    data() {
        return {
            /* variables */
            option: "talent",
            workshop_options: this.options
        }
    },
    components :{
        Multiselect
    }
}
</script>

