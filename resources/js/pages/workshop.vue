<!-- workshop.vue -->
<template>
    <div class="m-10">
        <!-- Pick a genre -->
        <template v-if="genres">
            <fieldset v-if="genres.length">
                <legend>
                    Pick a genre
                </legend>
                <select v-model="genre">
                    <option v-for="genre in genres">
                        {{ genre.name }}
                    </option>
                </select>
            </fieldset>
        </template>

        <!-- Pick a book -->
        <template v-if="books">
            <fieldset v-if="books.length">
                <legend>
                    Pick a book
                </legend>
                <select>
                    <option v-for="book in books">
                        {{ book.name }}
                    </option>
                </select>
            </fieldset>
        </template>

        <!-- Pick an option -->
        <template v-if="options">
            <fieldset v-if="options.length">
                <legend>
                    Pick an option
                </legend>
                <select v-model="option" style="text-transform: capitalize;">
                    <option v-for="option in options">
                        {{ option }}
                    </option>
                </select>
            </fieldset>
        </template>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            /* variables */
            genres: this.fetchGenres(),
            genre: null,
            books: null,
            book: null,
            options: null,
            option: null

        }
    },
    methods: {
        fetchGenres: function () {
            // Make the api call
            axios.get('/api/genre').then(response => {
                // put the data into an array
                this.genres = response.data.data;
            })
                .catch(error => {
                    console.log("error: " + error)
                })
        },
        fetchBooks: function (genre) {
            if (genre) {
                axios.get('/api/' + genre + '/books').then(response => {
                    // Get the books from the genre
                    this.books = response.data;
                })
                    .catch(error => {
                        console.log("Error: " + error);
                    })
            }
        },
        fetchOptions: function (genre) {
            if (genre) {
                axios.get('/api/showOptions/' + genre).then(response => {
                    this.options = response.data
                })
                    .catch(error => {
                        console.log("Error: " + error);
                    })
            }
        },
    },
    watch: {
        genre: {
            handler(genre) {
                console.log(genre);
                this.fetchBooks(genre);
                this.fetchOptions(genre);
            },
            immediate: true
        }
    }
}
</script>

