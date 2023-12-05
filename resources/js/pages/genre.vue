<!-- genre.vue -->
<template>
    <div class="genre">
        <h1> {{ genre }} </h1>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data () {
        return {
            genre: null
        }
    },
    // is necessary when changing to the same route but with different parameters
    watch: {
        '$route.params.id' (to) {
            this.genre = to;
        }
    },
}
</script>
