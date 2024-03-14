<!-- talent.vue -->
<template>
    <router-view :genre="genre" :talent="talent" v-if="talent.id"/>
</template>

<script>
import axios from "axios";

export default {
    props: ['genre'],
    data() {
        return {
            /* variables */
            talent: null
        }
    },
    watch: {
        '$route.params.id': {
            handler(id) {
                // Remove the old talent & make edit false
                this.talent = {};

                // fetch new genre when parameter id is changed
                if (id !== undefined && this.genre !== undefined) {
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
                if (genre !== undefined && this.$route.params.id !== undefined) {
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

