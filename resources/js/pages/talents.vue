<!-- genre.vue -->
<template>
    <div style="display: flex; justify-content: center">

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
                <tr v-for="(talent, index) in talents" :class="{'background-tertiary': index % 2 === 0}" class="clickable" @click="go(talent.id)">
                    <td> {{ talent.name }}</td>
                    <td style="text-align: center"> {{ talent.experience_cost }}</td>
                    <td> {{ talent.description }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['genre'],
    data() {
        return {
            /* arrays */
            talents: {}
        }
    },
    methods: {
      go(id){
            this.$router.push({ name: 'talent', params: { id: id, genre: this.genre } })
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
                } else {
                    this.genre = null;
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>
