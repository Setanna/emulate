<!-- race.vue -->
<template>
    <router-view :genre="genre" :race="race" v-if="race.id"/>
</template>

<script>
import axios from 'axios';

export default {
    props: ['genre'],
    data() {
        return {
            /* variables */
            race: null
        }
    },
    watch: {
        '$route.params.id': {
            handler(id) {
                // Remove the old talent & make edit false
                this.race = {};

                // fetch new genre when parameter id is changed
                if (id !== undefined && this.genre !== undefined) {
                    axios.get('/api/' + this.genre + '/races/' + id).then(response => {
                        this.race = response.data;
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.race = null;
                }
            },
            immediate: true,
            deep: true
        },
        '$route.params.genre': {
            handler(genre) {
                // Remove the old talent
                this.race = {};

                // fetch new genre when parameter id is changed
                if (genre !== undefined && this.$route.params.id !== undefined) {
                    axios.get('/api/' + genre + '/races/' + this.$route.params.id).then(response => {
                        this.race = response.data;
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.race = null;
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>
