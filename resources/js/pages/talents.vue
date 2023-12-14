<!-- genre.vue -->
<template>
    <!-- Deck -->
    <div v-if="talents" id="genre-deck" class="deck">
        <div class="card background-secondary" v-for="talent in talents">
            <router-link :to="{ }" class="no-text-link">
                <div class="card-body">
                    <h2 class="card-title">{{ talent.name }}</h2>
                    <p class="card-text">{{ talent.description }}</p>
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
            talents: {},
            /* variables */
            genre: null,
        }
    },// watch for route parameter id change
    watch: {
        '$route.params.name': {
            handler(genre) {
                // fetch new genre when parameter id is changed
                if (genre !== undefined) {
                    axios.get('/api/talent/genre/' + genre).then(response => {
                        this.talents = response.data.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({path: '/not_found'})
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
