<template>
    <!-- Page -->
    <div class="page background-primary">
        <!-- Navbar -->
        <div class="background-quaternary navbar">
            <!-- Navbar Header -->
            <div class="navbar-header background-quaternary">
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
                        <router-link v-for="option in options" :to="{ path: '/' + genre + '/' + option }"
                                     class="no-text-link navbar-title capitalize">
                            {{ option }}
                        </router-link>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Search Results -->
        <div class="background-tertiary search-results" :class="{'search-results-opened': search_state}">
            <!-- Margin -->
            <div style="margin: 0 5px">
                <!-- Search Input -->
                <div class="search">
                    <input class="background-tertiary clean-input" placeholder="Search" v-model="search_text"
                           @input="search(search_filters)"
                           @focusin="this.searchFocus = true" @focusout="this.searchFocus = false">
                    <div class="clickable" @click="showFilter = true">
                        <settings-icon></settings-icon>
                    </div>
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

        <!-- Theme Modal Button -->
        <div class="background-tertiary menu" :class="{'menu-opened': showMenu}">
            <div class="menu-icons">
                <div class="clickable" @click="showMenu = !showMenu">
                    <menu-icon></menu-icon>
                </div>
                <transition-group name="delay">
                    <hr v-if="showMenu"
                        style="margin: 2px 5px; border-color: var(--primary-color); border-style: solid; border-width: 1px"/>

                    <div class="clickable" v-if="showMenu">
                        <theme-icon @click="showTheme = true"></theme-icon>
                    </div>
                    <router-link to="account" v-if="showMenu">
                        <account-icon></account-icon>
                    </router-link>
                </transition-group>
            </div>
        </div>

        <!-- Modals -->
        <Teleport to="body">
            <filter-modal v-model:showFilter="showFilter" v-model:search_filters="search_filters" :genre="genre"
                          @close="search(search_filters)"/>
            <theme-modal v-model:showTheme="showTheme" @update:theme="(modalTheme) => this.theme = modalTheme"/>
        </Teleport>
    </div>
</template>

<script>
import filterModal from '../modals/filter.vue';
import themeModal from '../modals/theme.vue';
import settingsIcon from '../icons/settings.vue';
import menuIcon from '../icons/menu.vue';
import accountIcon from '../icons/account.vue';
import themeIcon from '../icons/paintbrush.vue';
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
            theme: localStorage.getItem('theme') !== null ? localStorage.getItem('theme') : 'obsidian',
            genre: null,
            search_text: '',
            /* booleans */
            showTheme: false,
            showMenu: false,
            showFilter: false,
            showSort: false,
            search_state: false,
            searchFocus: false
        }
    },
    components: {
        themeModal,
        filterModal,
        settingsIcon,
        accountIcon,
        themeIcon,
        menuIcon
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
            immediate: true,
            deep: true
        }
    },
}
</script>
