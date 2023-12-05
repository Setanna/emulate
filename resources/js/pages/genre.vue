<!-- genre.vue -->
<template>
    <div class="genre">
        <h1 v-if="genre"> {{ genre.name }} </h1>
        <p v-if="genre"> {{ genre.description }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            /* variables */
            genre: null
        }
    },
    // is necessary when changing to the same route but with different parameters
    watch: {
        '$route.params.id': {
            handler(id) {
                console.log(id)
                // fetch new channel content when a query param is changed.
                if(id !== undefined){
                    axios.get('/api/genre/' + id).then(response => {
                        this.genre = response.data
                    })
                        .catch(error => {
                            console.log("Watch error: " + error)
                        })
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>

