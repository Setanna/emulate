<!-- view_race.vue -->
<template>
    <div class="subcomponent" v-if="race.id">
        <!-- Name & Cost -->
        <div v-if="race.name" class="background-tertiary title-card title">
            <p style="padding-left: 5px;"> {{ race.name }}</p>
            <div class="clickable" style="padding-left: 5px; display: flex; align-items: center" v-if="abilities.update"
                 @click="editRace()">
                <edit-icon/>
            </div>

            <p style="margin-left:auto; margin-right:0; padding-right: 5px;"> {{ race["experience_cost"] }} XP </p>
        </div>

        <!-- Types & Book -->
        <div v-if="race.types" class="categories sub-title">
            <!-- Categories -->
            <p class="background-tertiary category-card" v-for="type in race.types"> {{ type.name }} </p>


            <!-- Book -->
            <div style="margin-left:auto; margin-right:0; position:relative; display: flex; justify-content: center">
                <p style="align-self: center"> {{ race.book.name }}</p>
            </div>
        </div>

        <!-- description -->
        <div v-if="race.description">
            <hr>
            <p style="font-weight: bold">Description:</p>
            <p v-html="race.description"></p>
        </div>

        <!-- System
        <div v-if="talent.system">
            <hr>
            <p style="font-weight: bold">System:</p>
            <p v-html="talent.system"></p>
        </div>
        -->

    </div>
</template>

<script>
import editIcon from '../../icons/edit.vue';

export default {
    props: ['genre', 'race', 'abilities'],
    methods: {
        editRace: function () {
            this.$router.push({name: 'edit_talent', params: {id: this.race.id, genre: this.genre}})
        }
    },
    components: {
        editIcon
    }
}
</script>

