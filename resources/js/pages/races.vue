<!-- genre.vue -->
<template>
    <!-- Deck -->
    <div v-if="races" id="genre-deck" class="deck">
        <div class="card background-secondary" v-for="race in races">
            <router-link :to="{ }" class="no-text-link">
                <div class="card-body">
                    <h2 class="card-title">{{ race.name }}</h2>
                    <p class="card-text">{{ race.description }}</p>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            /* arrays */
            races: {},
            /* variables */
            genre: null,
        }
    },// watch for route parameter id change
    watch: {
        '$route.params.genre': {
            handler(genre) {
                // Remove the old races
                this.races = {};

                // fetch new genre when parameter id is changed
                if (genre !== undefined) {
                    axios.get('/api/race/genre/' + genre).then(response => {
                        this.races = response.data.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.genre = null;
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>
