<!-- talents.vue -->
<template>
    <div class="talents" style="display: flex; flex-direction: column; justify-content: center">

        <!-- Search -->
        <div class="pb-20">
            <div class="background-tertiary b-2 r-5 search">
                <input class="background-tertiary title-input p-10 pt-20 pb-20" placeholder="Enter search query">

                <div class="clickable center pr-5">
                    <settings-icon></settings-icon>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table v-if="talents.length" class="background-secondary talent-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(talent, index) in talents" :class="{'background-tertiary': index % 2 === 0}" class="clickable"
                @click="go(talent.id)">
                <td class="p-5"> {{ talent.name }}</td>
                <td class="p-5" style="text-align: center"> {{ talent.experience_cost }}</td>
                <td class="p-5"> {{ talent.description }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>

<script>
import axios from 'axios';
import Multiselect from '@vueform/multiselect'
import settingsIcon from '../icons/settings.vue';

export default {
    computed: {
        sortNameByAsc() {
            this.talents
                .sort((a, b) => {
                    let la = a.name.toLowerCase(), lb = b.name.toLowerCase();
                    if (la < lb) {
                        return -1
                    }
                    if (la > lb) {
                        return 1
                    }
                    return 0
                })
        },
        sortNameByDesc() {
            this.talents
                .sort((a, b) => {
                    let la = a.name.toLowerCase(), lb = b.name.toLowerCase();
                    if (la > lb) {
                        return -1
                    }
                    if (la < lb) {
                        return 1
                    }
                    return 0
                })
        },
        sortCostByAsc() {
            this.talents
                .sort((a, b) => {
                    return a.experience_cost - b.experience_cost
                })
        },
        sortCostByDesc() {
            this.talents
                .sort((a, b) => {
                    return b.experience_cost - a.experience_cost
                })
        }
    },
    props: ['genre'],
    data() {
        return {
            /* arrays */
            talents: [],
            column_options: ["Name", "Cost"],
            /* variables */
            column: {value: "Name", label: "Name"},
            ascending: true
        }
    },
    components: {
        Multiselect,
        settingsIcon
    },
    methods: {
        go(id) {
            this.$router.push({name: 'talent', params: {id: id, genre: this.genre}})
        }
    },
    watch: {
        '$route.params.genre': {
            handler(genre) {
                // Remove the old talents
                this.talents = {};

                // fetch new genre when parameter id is changed
                if (genre !== undefined) {
                    axios.get('/api/talent/genre/' + genre).then(response => {
                        this.talents = response.data.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>
