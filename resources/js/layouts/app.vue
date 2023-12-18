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
                    <div class="navbar-options" v-if="genre">
                        <router-link :to="{ path: '/' + genre + '/talents' }" class="no-text-link navbar-title" style="align-self: flex-start">
                            Talents
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
            /* variables */
            genre: null,
            search_text: '',
            /* booleans */
            search_state: false,
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
                        console.log(response.data);
                    }
                })
                    .catch(error => {
                        console.log("Error: " + error)
                    })
            }
        }
    },
    watch: {
        '$route'() {
            console.log(this.$route.params.name)
            if (this.$route.params.name !== null) {
                this.genre = this.$route.params.name
            } else {
                this.genre = null;
            }
            this.search_state = this.$route.name !== "home";
            this.search_text = '';
            this.search_results = {};
        }
    },
}
</script>
