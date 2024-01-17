<!-- genre.vue -->
<template>
    <div class="talent">
        <h1 v-if="talent"> {{ talent.name }} </h1>
        <p v-if="talent"> {{ talent.system }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        genre: String
    },
    data() {
        return {
            /* variables */
            talent: null
        }
    },
    // watch for route parameter id change
    watch: {
        '$route.params.id': {
            handler(id) {
                // Remove the old talent
                this.talent = {};

                // fetch new genre when parameter id is changed
                if (id !== undefined) {
                    axios.get('/api/' + this.genre + '/talents/' + id).then(response => {
                        this.talent = response.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.talent = null;
                }
            },
            immediate: true,
            deep: true
        },
        '$route.params.genre': {
            handler(genre) {
                // Remove the old talent
                this.talent = {};

                // fetch new genre when parameter id is changed
                if (genre !== undefined) {
                    axios.get('/api/' + genre + '/talents/' + this.$route.params.id).then(response => {
                        this.talent = response.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.talent = null;
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>

