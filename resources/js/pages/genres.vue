<!-- genre.vue -->
<template>
    <!-- Deck -->
    <div id="genre-deck" class="deck">
        <div class="card background-secondary" v-for="genre in genres" @click="chooseGenre(genre.name)">
            <router-link :to="{ name: 'genres', params: { name: genre.name.toLowerCase() }}" class="no-text-link">
                <img class="card-image" :src="getImageUrl(genre.name.toLowerCase())"
                     @error="getAltImageUrl">
                <div class="card-body">
                    <h2 class="card-title">{{ genre.name }}</h2>
                    <p class="card-text">{{ genre.description }}</p>
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
            genres: {},
            /* variables */
            genre: null,
        }
    },
    methods: {
        getImageUrl: function (image_name) {
            return new URL('../../assets/images/' + image_name + ".jpg", import.meta.url).href;
        },
        getAltImageUrl: function (event) {
            event.target.src = new URL('../../assets/images/unavailable.jpg', import.meta.url).href;
        },
        chooseGenre: function (genre) {
            this.genre = genre;
            this.intro = false;
        },
        fetchGenres: function () {
            // Make the api call
            axios.get('/api/genre').then(response => {
                // put the data into an array
                this.genres = response.data.data;
            })
                .catch(error => {
                    console.log("error: " + error)
                })
        }
    },
    // is necessary when changing to the same route but with different parameters
    watch: {
        '$route.params.id'(to) {
            this.genre = to;
        }
    },
    mounted() {
        this.fetchGenres();
    },
}
</script>
