<template>
    <Transition name="modal">
        <div v-if="showTrait && traits" class="modal-mask">
            <div class="modal-container">
                <!-- Body -->
                <div class="modal-body">
                    <div>
                        <fieldset class="fieldset">
                            <legend class="legend">
                                Traits
                            </legend>
                            <ul class="checkbox-ul">
                                <li class="checkbox-li" v-for="trait in traits">
                                    <input class="checkbox" type="checkbox" v-model="chosen_traits"
                                           :value="trait"
                                           :id="trait.name + trait.id" hidden>
                                    <label class="checkbox-label" :for="trait.name + trait.id"> {{ trait.name }} </label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="modal-save" @click="close()">Ok</button>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            /* arrays & objects */
            traits: {}
        }
    },
    props: ['showTrait', 'chosen_traits'],
    emits: ['update:showTrait', 'update:chosen_traits'],
    methods: {
        fetchTraits: function () {
            axios.get('/api/trait').then(response => {
                // Get the books from the genre
                this.traits = response.data.data;
                console.log(response.data.data);
            })
                .catch(error => {
                    console.log("Error: " + error);
                })
        },
        close: function () {
            this.$emit('update:chosen_traits', this.chosen_traits);
            this.$emit('update:showTrait', false);
        }
    },
    mounted() {
        this.fetchTraits();
    }
}
</script>
