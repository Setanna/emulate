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
                <input class="search sub-title" placeholder="Search" v-model="search_text"
                       @input="search(this.text)"
                       @focusin="this.searchFocus = true" @focusout="this.searchFocus = false"
                       :class="{'search-closed': !search_state, 'search-opened': search_state}">

                <!-- Navbar Options -->
                <transition name="fall" mode="in-out">
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
        <transition name="slide" mode="in-out">
            <div class="background-secondary search-results"
                 :class="{'search-results-opened':
                 search_results.rules.length ||
                 search_results.races.length ||
                 search_results.talents.length}">

                <!-- Categories -->
                <div v-if="search_results.rules.length" class="search-category">
                    <b>Rules</b>
                    <a v-for="search_result in search_results.rules">{{ search_result.name }}</a>
                </div>

                <div v-if="search_results.races.length" class="search-category">
                    <b>Races</b>
                    <a v-for="search_result in search_results.races">{{ search_result.name }}</a>
                </div>

                <div v-if="search_results.talents.length" class="search-category">
                    <b>Talents</b>
                    <a v-for="search_result in search_results.talents">{{ search_result.name }}</a>
                </div>
            </div>
        </transition>

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

                // Add search bar if path isn't home or not_found.
                this.search_state = name !== "home" && name !== "not_found" && name !== "account";

                // If there is not a search bar
                if (!this.search_state) {
                    // Reset search variables on route change
                    this.search_text = '';
                    this.search_results = {
                        "rules": [],
                        "races": [],
                        "talents": []
                    };
                }
            },
            immediate: true
        },
    },
}
</script>
