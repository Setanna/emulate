<!-- view_races.vue -->
<template>
    <div class="subcomponent">
        <!-- Search -->
        <div class="pb-20">
            <div class="background-tertiary b-2 r-5 table-search">
                <input class="background-tertiary title-input r-5 p-10 pt-20 pb-20" placeholder="Enter search query"
                       maxlength="50">

                <div class="clickable center pr-5">
                    <settings-icon></settings-icon>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table v-if="races.length" class="background-secondary table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Cost</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody style="overflow: auto">
            <tr v-for="(race, index) in races" :class="{'background-tertiary': index % 2 === 0}">
                <td class="p-5 pl-10 pr-10">
                    <router-link :to="{name: 'race', params: {id: race.id, genre: this.genre}}"
                                 class="no-text-link">
                        {{ race.name }}
                    </router-link>
                </td>
                <td class="ta-center p-5 pl-10 pr-10"> {{ race.experience_cost }}</td>
                <td class="p-5 pl-10 pr-10 w-100" v-html="race.description"></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import settingsIcon from '../../icons/settings.vue';
import axios from "axios";

export default {
    props: ['genre'],
    data() {
        return {
            /* variables */
            races: null
        }
    },
    components: {
        settingsIcon,
    },
    watch: {
        '$route.params.genre': {
            handler(genre) {
                // Remove the old races
                this.races = {};

                // fetch new genre when parameter id is changed
                if (genre !== undefined) {
                    axios.get('/api/race/genre/' + genre).then(response => {
                        this.races = response.data.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.genre = null;
                }
            },
            immediate: true,
            deep: true
        }
    }
}
</script>

