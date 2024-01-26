<template>
    <!-- Page -->
    <div class="page background-primary">
        <!-- Navbar -->
        <div class="background-tertiary navbar">
            <!-- Navbar Header -->
            <div class="navbar-header background-tertiary">
                <router-link :to="{ name: 'home' }" class="no-text-link navbar-title">
                    Emulate:
                </router-link>
            </div>

            <!-- Theme Picker -->
            <select v-model="theme" class="select title">
                <option value="light"> Light </option>
                <option value="dark"> Dark </option>
            </select>

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
                        <router-link v-for="option in options" :to="{ path: '/' + genre + '/' + option }"
                                     class="no-text-link navbar-title">
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
                           @input="search(search_filters)"
                           @focusin="this.searchFocus = true" @focusout="this.searchFocus = false">
                    <img class="icon-32 clickable" style="justify-self: center" src="../../assets/icons/settings.svg"
                         alt="" @click="showFilter = true">
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
                    <router-link v-for="search_result in search_results.talents"
                                 :to="{ name: 'talent', params: { id: search_result.id, genre: this.genre } }"
                                 class="no-text-link">
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
        <Teleport to="body">
            <filter-modal v-model:showFilter="showFilter" v-model:search_filters="search_filters" :genre="genre" @close="search(search_filters)"/>
        </Teleport>
    </div>
</template>

<script>
import filterModal from '../modals/filter.vue'
import axios from "axios";

export default {
    data() {
        return {
            /* arrays & objects */
            genres: {},
            search_results: {
                "rules": [],
                "races": [],
                "talents": []
            },
            search_filters: {
                "books": []
            },
            options: {},
            /* variables */
            theme: localStorage.getItem('theme'),
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
        search: function (filters) {
            let Search = this.search_text.toLowerCase();

            if (Search === "" || this.genre === null) {
                this.search_results = {
                    "rules": [],
                    "races": [],
                    "talents": []
                };
            } else {
                axios.post('/api/search/' + this.genre + '/' + Search, {filters: filters}).then(response => {
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

                // Remove search_results, search text & old options
                this.options = {};
                this.search_text = '';
                this.search_results = {
                    "rules": [],
                    "races": [],
                    "talents": []
                };

                // Get new options
                this.getOptions(genre);
            },
            immediate: true
        },
        '$route.name': {
            handler(name) {
                // On route name changing

                // Add search bar if path isn't home or not_found.
                if (name === "home" || name === "not_found" || name === "account") {
                    this.search_state = false;
                }
            },
            immediate: true
        },
        theme: {
            handler(theme) {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
            },
            immediate: true
        }
    },
}
</script>
