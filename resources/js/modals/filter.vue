<template>
    <Transition name="modal">
        <div v-if="showFilter && books" class="modal-mask">
            <div class="background-tertiary modal-container">
                <!-- Body -->
                <div class="modal-body">
                    <div>
                        <fieldset class="fieldset">
                            <legend class="legend">
                                Books
                            </legend>
                            <ul class="checkbox-ul">
                                <li class="checkbox-li" v-for="book in books">
                                    <input class="checkbox" type="checkbox" v-model="search_filters.books" :value="book.id"
                                           :name="book.id" :id="book.name + book.id" hidden>
                                    <label class="checkbox-label" :for="book.name + book.id"> {{ book.name }} </label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="modal-save" @click="close()">Ok</button>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            /* arrays & objects */
            books: {}
        }
    },
    props: ['search_filters', 'showFilter', 'genre'],
    emits: ['update:showFilter', 'close'],
    methods: {
        getBooks: function (genre) {
            if (genre) {
                axios.get('/api/' + genre + '/books').then(response => {
                    // Get the books from the genre
                    this.books = response.data;

                    // Apply all the books to the filter.
                    let book_ids = []
                    $.each(response.data, function (key, value) {
                        book_ids.push(value.id);
                    });

                    this.search_filters.books = book_ids;
                })
                    .catch(error => {
                        console.log("Error: " + error);
                    })
            }
        },
        close: function () {
            this.$emit('close');
            this.$emit('update:showFilter', false);
        }
    },
    watch: {
        genre: {
            handler(genre) {
                this.getBooks(genre);
            },
        }
    },
}
</script>
