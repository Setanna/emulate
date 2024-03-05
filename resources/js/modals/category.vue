<template>
    <Transition name="modal">
        <div v-if="showCategory && categories" class="modal-mask">
            <div class="background-tertiary modal-container">
                <!-- Body -->
                <div class="modal-body">
                    <div>
                        <fieldset class="fieldset">
                            <legend class="legend">
                                Categories
                            </legend>
                            <ul class="checkbox-ul">
                                <li class="checkbox-li" v-for="category in category_options">
                                    <input class="checkbox" type="checkbox" v-model="chosen_categories"
                                           :value="category"
                                           :id="category.name + category.id" hidden>
                                    <label class="checkbox-label" :for="category.name + category.id"> {{ category.name }} </label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="background-quaternary modal-save" @click="close()">Ok</button>
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
            category_options: {},
            chosen_categories: null,
        }
    },
    props: ['showCategory', 'categories'],
    emits: ['update:showCategory', 'update:categories'],
    methods: {
        fetchCategories: function () {
            axios.get('/api/category').then(response => {
                // Get the books from the genre
                this.category_options = response.data.data;
            })
                .catch(error => {
                    console.log("Error: " + error);
                })
        },
        setCategories: function () {
            this.chosen_categories = this.categories;
        },
        close: function () {
            this.$emit('update:categories', this.chosen_categories);
            this.$emit('update:showCategory', false);
        }
    },
    mounted() {
        this.setCategories();
        this.fetchCategories();
    }
}
</script>
