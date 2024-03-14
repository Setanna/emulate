<!-- talents.vue -->
<template>
    <router-view :genre="genre" :abilities="abilities"/>
</template>

<script>
export default {
    props: ['genre', 'abilities']
}
</script>
