<template>
    <!-- Page -->
    <div class="page background-primary" >
        <!-- Navbar -->
        <div class="background-tertiary navbar">
            <!-- Navbar Header -->
            <div class="navbar-header background-tertiary">
                <router-link :to="{ name: 'home' }" class="no-text-link navbar-title">
                    Emulate:
                </router-link>
            </div>

            <!-- Navbar Menu -->
            <div class="navbar-menu">
                <!-- Navbar Options -->
                <transition name="fall" mode="in-out">
                    <div class="navbar-options" v-if="options.length">
                        <!-- Search -->
                        <router-link to="" class="no-text-link navbar-title" @click="search_state = !search_state">
                            Search
                        </router-link>

                        <!-- Genre options -->
                        <router-link v-for="option in options" :to="{ path: '/' + genre + '/' + option }" class="no-text-link navbar-title">
                            {{ option }}
                        </router-link>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Search Results -->
        <div class="background-secondary search-results" :class="{'search-results-opened': search_state}">
            <!-- Margin -->
            <div style="margin: 0 5px">
                <!-- Search Input -->
                <div class="search">
                <input class="search-input" placeholder="Search" v-model="search_text"
                       @input="search(this.text)"
                       @focusin="this.searchFocus = true" @focusout="this.searchFocus = false">
                    <img class="icon-32 clickable" style="justify-self: center" src="../../assets/icons/settings.svg" alt="" @click="showFilter = true">
                </div>

                <!-- Result Categories -->
                <div v-if="search_results.rules.length" class="search-category">
                    <b class="search-category-title">Rules</b>
                    <router-link v-for="search_result in search_results.rules" to="" class="no-text-link">
                        {{ search_result.name }}
                    </router-link>
                </div>

                <div v-if="search_results.races.length" class="search-category">
                    <b class="search-category-title">Races</b>
                    <router-link v-for="search_result in search_results.races" to="" class="no-text-link">
                        {{ search_result.name }}
                    </router-link>
                </div>

                <div v-if="search_results.talents.length" class="search-category">
                    <b class="search-category-title">Talents</b>
                    <router-link v-for="search_result in search_results.talents" :to="{ name: 'talent', params: { id: search_result.id, genre: this.genre } }" class="no-text-link">
                        {{ search_result.name }}
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Component -->
        <router-view v-slot="{ Component }" :genre="genre">
            <div class="component">
                <keep-alive>
                    <component :is="Component"></component>
                </keep-alive>
            </div>
        </router-view>

        <!-- Modal -->
        <Teleport to="body" v-if="books">
            <filter-modal :showFilter="showFilter" :books="books" @close="showFilter = false"/>
        </Teleport>
    </div>
</template>

<script>
import filterModal from '../modals/filter.vue'
import axios from "axios";

export default {
    data() {
        return {
            /* arrays */
            books: {},
            genres: {},
            search_results: {
                "rules": [],
                "races": [],
                "talents": []
            },
            options: {},
            /* variables */
            genre: null,
            search_text: '',
            /* booleans */
            showFilter: false,
            showSort: false,
            search_state: false,
            searchFocus: false
        }
    },
    components: {
        filterModal
    },
    methods: {
        getBooks: function (genre) {
            if (genre) {
                axios.get('/api/' + genre + '/books').then(response => {
                    this.books = response.data
                })
                    .catch(error => {
                        console.log("Error: " + error);
                    })
            }
        },
        getOptions: function (genre) {
            if (genre) {
                axios.get('/api/showOptions/' + genre).then(response => {
                    this.options = response.data
                })
                    .catch(error => {
                        console.log("Error: " + error);
                    })
            }
        },
        search: function () {
            let Search = this.search_text.toLowerCase();

            if (Search === "" || this.genre === null) {
                this.search_results = {
                    "rules": [],
                    "races": [],
                    "talents": []
                };
            } else {
                axios.get('/api/search/' + this.genre + '/' + Search).then(response => {
                    if (this.search_text !== "") {
                        this.search_results = response.data;
                    }
                })
                    .catch(error => {
                        console.log("Error: " + error)
                    })
            }
        },
    },
    watch: {
        '$route.params.genre': {
            handler(genre) {
                // On parameter genre changing

                // Set genre
                this.genre = genre

                // Remove search_results, search text, old options & books
                this.options = {};
                this.books = {};
                this.search_text = '';
                this.search_results = {
                    "rules": [],
                    "races": [],
                    "talents": []
                };

                // Get new options & books
                this.getOptions(genre);
                this.getBooks(genre);
            },
            immediate: true
        },
        '$route.name': {
            handler(name) {
                // On route name changing

                // Add search bar if path isn't home or not_found.
                if(name === "home" || name ==="not_found" || name === "account"){
                    this.search_state = false;
                }
            },
            immediate: true
        },
    },
}
</script>
