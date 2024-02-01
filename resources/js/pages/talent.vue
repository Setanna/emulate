<!-- genre.vue -->
<template>
    <div v-if="talent" class="talent">

        <!-- Name & Cost -->
        <div v-if="talent.name" class="title-card title">
            <p style="padding-left: 5px;"> {{ talent.name }} </p>

            <p style="margin-left:auto; margin-right:0; padding-right: 5px;"> {{ talent["experience_cost"]}} </p>
        </div>

        <!-- Categories -->
        <div v-if="talent.categories" class="categories sub-title">
            <p class="category-card" v-for="category in talent.categories"> {{ category }} </p>
        </div>

        <!-- Requirements -->
        <div v-if="talent['requirements']"  style="display:flex">
            <p v-if="talent['requirements'].length" style="font-weight: bold">Requirements: </p>
            <template v-if="talent['requirements'].length" v-for="(requirement, index) in talent['requirements']">
                <template v-if="index < 1">&nbsp;</template>
                <template v-if="index > 0">, &nbsp;</template>
                <p> {{ requirement }} </p>
            </template>
        </div>

        <!-- Required Talents -->
        <div v-if="talent['required_talents']" style="display:flex;">
            <p v-if="talent['required_talents'].length" style="font-weight: bold">Required talents: </p>
            <template v-if="talent['required_talents'].length" v-for="(required_talent, index) in talent['required_talents']">
                <template v-if="index < 1">&nbsp;</template>
                <template v-if="index > 0">, &nbsp;</template>
                <p> {{ required_talent }} </p>
            </template>
        </div>

        <!-- description -->
        <div v-if="talent.description">
            <hr>
            <p style="font-weight: bold">Description:</p>
            <p> {{ talent.description }}</p>
        </div>

        <!-- System -->
        <div v-if="talent.system">
            <hr>
            <p style="font-weight: bold">System:</p>
            <p> {{ talent.system }}</p>
        </div>

        <!-- Traits -->
        <div v-if="talent['traits']" style="padding-top: 6px">
            <div v-if="talent['traits'].length" class="title-card sub-title">
                <p style="padding-left: 5px;"> Traits </p>
            </div>

            <table v-if="talent['traits'].length" class="trait-table">
                <tbody>
                    <tr v-for="trait in talent['traits']">
                        <td style="width: 20%; font-weight: bold; padding: 5px;"> {{ trait.name }} </td>
                        <td style="width: 80%;"> {{ trait.system }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        genre: String
    },
    data() {
        return {
            /* variables */
            talent: null
        }
    },
    // watch for route parameter id change
    watch: {
        '$route.params.id': {
            handler(id) {
                // Remove the old talent
                this.talent = {};

                // fetch new genre when parameter id is changed
                if (id !== undefined && this.genre !== undefined) {
                    axios.get('/api/' + this.genre + '/talents/' + id).then(response => {
                        this.talent = response.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.talent = null;
                }
            },
            immediate: true,
            deep: true
        },
        '$route.params.genre': {
            handler(genre) {
                // Remove the old talent
                this.talent = {};

                // fetch new genre when parameter id is changed
                if (genre !== undefined && this.$route.params.id !== undefined) {
                    axios.get('/api/' + genre + '/talents/' + this.$route.params.id).then(response => {
                        this.talent = response.data
                    })
                        .catch(error => {
                            console.log(error)
                            if (error.response.status === 404) {
                                this.$router.push({name: 'not_found'})
                            }
                        })
                } else {
                    this.talent = null;
                }
            },
            immediate: true,
            deep: true
        }
    },
}
</script>

