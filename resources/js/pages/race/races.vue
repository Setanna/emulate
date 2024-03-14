<!-- races.vue -->
<template>
    <router-view :genre="genre"/>
</template>

<script>
import axios from 'axios';

export default {
    props: ['genre', 'abilities']
}
</script>
