<!-- talent.vue -->
<template>
    <div>
        <!-- View Talent -->
        <template v-if="!edit">
            <view_talent v-model:edit="edit" :genre="genre" :talent="talent"/>
        </template>

        <!-- Edit Talent -->
        <template v-if="edit">
            <edit_talent v-model:edit="edit" :genre="genre" :talent="talent"/>
        </template>
    </div>
</template>

<script>
import view_talent from "../components/view_talent.vue";
import edit_talent from "../components/edit_talent.vue";
import axios from "axios";

export default {
    props: {
        genre: String
    },
    data() {
        return {
            /* variables */
            edit: false,
            talent: null
        }
    },
    components: {
        view_talent,
        edit_talent
    },
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

