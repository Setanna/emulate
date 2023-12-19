<template>
    <!-- Page -->
    <div class="page background-primary">
        <!-- Navbar -->
        <div class="background-secondary navbar">
            <!-- Navbar Header -->
            <div class="navbar-header background-tertiary">
                <router-link :to="{ name: 'home' }" class="no-text-link navbar-title">
                    Emulate:
                </router-link>
            </div>

            <!-- Navbar Menu -->
            <div class="navbar-menu">
                <!-- Search Input -->
                <input class="search sub-title" placeholder="Search" v-model="search_text" @input="search(this.text)"
                       @focusin="this.searchFocus = true" @focusout="this.searchFocus = false"
                       :class="{'search-closed': !search_state, 'search-opened': search_state}">

                <!-- Navbar Options -->
                <transition name="slide" mode="in-out">
                    <div class="navbar-options" v-if="options.length">
                        <router-link v-for="option in options" :to="{ path: '/' + genre + '/' + option }"
                                     class="no-text-link navbar-title">
                            {{ option }}
                        </router-link>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Search Results -->
        <div class="background-secondary search-results" v-if="search_results.length"
             :class="{'search-results-opened': search_results.error || search_results !== {}}">
            <div v-for="search_result in search_results">
                <a>{{ search_result.name }}</a>
            </div>
        </div>

        <!-- Component -->
        <router-view v-slot="{ Component }">
            <div class="component">
                <keep-alive>
                    <component :is="Component"></component>
                </keep-alive>
            </div>
        </router-view>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<script>
import axios from "axios";

export default {
    data() {
        return {
            /* arrays */
            genres: {},
            search_results: {},
            options: {},
            /* variables */
            genre: null,
            search_text: '',
            /* booleans */
            search_state: false,
            searchFocus: false
        }
    },
    methods: {
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

            if (Search === "") {
                this.search_results = {};
            } else {
                axios.get('/api/search/' + Search).then(response => {
                    if (this.search_text !== "") {
                        this.search_results = response.data
                    }
                })
                    .catch(error => {
                        console.log("Error: " + error)
                    })
            }
        }
    },
    watch: {
        '$route.params.genre': {
            handler(genre) {
                // On parameter genre changing

                // Set genre
                this.genre = genre

                // Remove old options
                this.options = {};

                // Get new options
                this.getOptions(genre);
            },
            immediate: true
        },
        '$route.name': {
            handler(name) {
                // On route name changing

                // Reset variables on route change
                this.search_text = '';
                this.search_results = {};

                // Add search bar if path isn't home or not_found
                this.search_state = name !== "home" && name !== "not_found";
            },
            immediate: true
        },
    },
}
</script>
