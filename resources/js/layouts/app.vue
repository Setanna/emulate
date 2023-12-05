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
                       @focusin="this.searchFocus = true" @focusout="this.searchFocus = false">
            </div>
        </div>

        <!-- Search Results -->
        <div class="background-secondary search-results" v-show="search_results"
             :class="{'search-results-opened': search_results.error || search_results.talents || search_results.traits}">
            <!-- No Search Results -->
            <div v-show="search_results.error">
                <a>{{ search_results.error }}</a>
            </div>
            <!-- Talents -->
            <div v-for="talents in search_results.talents">
                <a>{{ talents.name }}</a>
            </div>
            <!-- traits -->
            <div v-for="traits in search_results.traits">
                <a>{{ traits.name }}</a>
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
            /* variables */
            genre: null,
            search_text: '',
            /* booleans */
            searchFocus: false
        }
    },
    methods: {
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
}
</script>
