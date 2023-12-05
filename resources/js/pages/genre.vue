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
    // watch for route parameter id change
    watch: {
        '$route.params.id': {
            handler(id) {
                console.log(id)
                // fetch new genre when parameter id is changed
                if(id !== undefined){
                    axios.get('/api/genre/' + id).then(response => {
                        this.genre = response.data
                    })
                        .catch(error => {
                            console.log("Watch error: " + error)
                        })
                }else{
                    this.genre = null;
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>

