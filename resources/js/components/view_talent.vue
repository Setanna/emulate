<!-- view_talent.vue -->
<template>
    <div v-if="talent">
        <!-- Name & Cost -->
        <div v-if="talent.name" class="background-tertiary title-card title">
            <p style="padding-left: 5px;"> {{ talent.name }}</p>
            <div class="clickable" style="padding-left: 5px; display: flex; align-items: center" v-if="update"
                 @click="editTalent()">
                <edit-icon/>
            </div>

            <p style="margin-left:auto; margin-right:0; padding-right: 5px;"> {{ talent["experience_cost"] }} XP </p>
        </div>

        <!-- Categories & Book -->
        <div v-if="talent.categories" class="categories sub-title">
            <!-- Categories -->
            <p class="background-tertiary category-card" v-for="category in talent.categories"> {{ category.name }} </p>


            <!-- Book -->
            <div style="margin-left:auto; margin-right:0; position:relative; display: flex; justify-content: center">
                <p style="align-self: center"> {{ talent.book.name }}</p>
            </div>
        </div>

        <!-- Requirements -->
        <div v-if="talent['requirements']" style="display:flex">
            <p v-if="talent['requirements'].length" style="font-weight: bold">Requirements: </p>
            <template v-if="talent['requirements'].length" v-for="(requirement, index) in talent['requirements']">
                <template v-if="index < 1">&nbsp;</template>
                <template v-if="index > 0">, &nbsp;</template>
                <p> {{ requirement.name }} </p>
            </template>
        </div>

        <!-- Required Talents -->
        <div v-if="talent['required_talents']" style="display:flex;">
            <p v-if="talent['required_talents'].length" style="font-weight: bold">Required talents: </p>
            <template v-if="talent['required_talents'].length"
                      v-for="(required_talent, index) in talent['required_talents']">
                <template v-if="index < 1">&nbsp;</template>
                <template v-if="index > 0">, &nbsp;</template>
                <p> {{ required_talent.name }} </p>
            </template>
        </div>

        <!-- description -->
        <div v-if="talent.description">
            <hr>
            <p style="font-weight: bold">Description:</p>
            <p v-html="talent.description"></p>
        </div>

        <!-- System -->
        <div v-if="talent.system">
            <hr>
            <p style="font-weight: bold">System:</p>
            <p v-html="talent.system"></p>
        </div>

        <!-- Traits -->
        <div v-if="talent['traits']" style="padding-top: 6px">
            <div v-if="talent['traits'].length" class="background-tertiary title-card sub-title">
                <p style="padding-left: 5px;"> Traits </p>
            </div>

            <table v-if="talent['traits'].length" class="trait-table">
                <tbody>
                <tr v-for="trait in talent['traits']">
                    <td style="width: 20%; font-weight: bold; padding: 5px;"> {{ trait.name }}</td>
                    <td style="width: 80%;"> {{ trait.system }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import editIcon from '../icons/edit.vue';

export default {
    props: ['genre', 'edit', 'talent'],
    emit: ['update:edit'],
    data() {
        return {
            /* user */
            user: window.Laravel.user,
            update: null
        }
    },
    methods: {
        editTalent: function () {
            this.$emit('update:edit', true);
        },
        checkAbility: function (ability) {
            axios.get('/api/auth/ability/' + ability,).then(response => {
                this.update = response.data;
            })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    components: {
        editIcon
    },
    watch: {
        user: {
            handler(user) {
                this.checkAbility("update");
            },
            immediate: true
        }
    },
}
</script>

