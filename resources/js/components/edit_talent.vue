<!-- edit_talent.vue -->
<template>
    <div class="m-10">
        <!-- Name & Cost -->
        <div class="background-tertiary title-card title">
            <div style="padding-left: 5px;">
                <input type="text" placeholder="Name" class="background-tertiary title-input text-dark" v-model="name"/>
            </div>

            <div style="margin-left:auto; margin-right:0; padding-right: 5px;">
                <input type="number" min="-99" max="99" step="1" placeholder="0" v-model="experience_cost"
                       @keypress="isNumber($event)" class="background-tertiary  title-input text-dark"
                       style="width: 50px; text-align: end"/>
                XP
            </div>
        </div>

        <!-- Categories & Books -->
        <div class="categories sub-title">
            <!-- Categories -->
            <p class="background-tertiary  category-card clickable" @click="deleteCategory(index)"
               v-for="(category, index) in categories">
                {{ category.name }}</p>
            <p class="background-tertiary category-card clickable"
               style="width: 24px; display: flex; justify-content: center"
               @click="showCategory = true"> + </p>

            <!-- Book -->
            <div style="margin-left:auto; margin-right:0; position:relative; display: flex; justify-content: center; align-items: center; width: 50%">
                <p style="align-self: center">Book: &nbsp;</p>
                <multiselect
                    v-model="book"
                    :options="book_options"
                    :object="true"
                    :searchable="true"/>
            </div>
        </div>

        <!-- Requirements -->
        <div style="display:flex">
            <b style="align-self: center">Requirements: &nbsp;</b>
            <multiselect
                v-model="requirements"
                :options="requirement_options"
                :object="true"
                :searchable="true"
                mode="tags"/>
        </div>

        <br>

        <!-- Required Talents -->
        <div style="display:flex;">
            <b style="align-self: center">Required talents: &nbsp;</b>
            <multiselect
                v-model="required_talents"
                :options="required_talent_options"
                :object="true"
                :searchable="true"
                mode="tags"/>
        </div>

        <!-- description -->
        <div>
            <hr>
            <p style="font-weight: bold">Description:</p>
            <editor name="description" v-model="description"/>
        </div>

        <!-- System -->
        <div>
            <hr>
            <p style="font-weight: bold">System:</p>
            <editor name="system" v-model="system"/>
        </div>

        <!-- Traits -->
        <div style="padding-top: 6px">
            <div class="background-tertiary title-card sub-title">
                <p style="padding-left: 5px;"> Traits </p>
            </div>

            <table class="trait-table">
                <tbody>
                <tr v-for="(trait, index) in traits" @click="deleteTrait(index)" class="clickable">
                    <td style="width: 20%; font-weight: bold; padding: 5px;">{{ trait.name }}</td>
                    <td style="width: 80%;">{{ trait.system }}</td>
                </tr>
                <tr class="clickable" @click="showTrait = true">
                    <td style="width: 20%; font-weight: bold; padding: 5px; text-align: center;"
                        class="background-tertiary clean-button">
                        +
                    </td>
                    <td style="width: 80%;"> Add Trait</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: center; padding-top: 20px;">
            <button class="background-tertiary clean-button clickable" @click="editTalent()">Save</button>
            <button class="background-tertiary clean-button clickable" @click="this.$emit('update:edit', false)">
                Discard
            </button>
        </div>
    </div>

    <!-- Modals -->
    <Teleport to="body">
        <category-modal v-model:showCategory="showCategory" :categories="categories"
                        @update:categories="(modalCategories) => this.categories = modalCategories"/>
        <trait-modal v-model:showTrait="showTrait" :traits="traits"
                     @update:traits="(modalTraits) => this.traits = modalTraits"/>
    </Teleport>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>

<script>
import axios from 'axios';
import editor from '../components/editor.vue';
import categoryModal from '../modals/category.vue';
import traitModal from '../modals/trait.vue';
import Multiselect from '@vueform/multiselect'

export default {
    props: ['genre', 'edit', 'talent'],
    emit: ['update:edit'],
    data() {
        return {
            /* talent variables */
            name: this.talent.name,
            experience_cost: this.talent.experience_cost,
            categories: this.talent.categories.map((category) => {
                return {id: category.id, name: category.name, description: category.description}
            }),
            requirements: this.talent.requirements.map((requirement) => {
                return {value: requirement.id, label: requirement.name, description: requirement.description}
            }),
            required_talents: this.talent.required_talents.map((required_talent) => {
                return {
                    value: required_talent.id,
                    label: required_talent.name,
                    description: required_talent.description
                }
            }),
            description: this.talent.description,
            system: this.talent.system,
            traits: this.talent.traits.map((trait) => {
                return {id: trait.id, name: trait.name, description: trait.description, system: trait.system}
            }),
            book: [this.talent.book].map((book) => {
                return {
                    value: book.id,
                    label: book.name,
                    description: book.description
                }
            })[0],
            /* option variables */
            requirement_options: this.fetchRequirements(),
            required_talent_options: this.fetchTalents(),
            book_options: this.fetchBooks(this.genre),
            /* variables */
            showCategory: false,
            showTrait: false
        }
    },
    components: {
        editor,
        categoryModal,
        traitModal,
        Multiselect
    },
    methods: {
        editTalent: function () {
            // Get the talent data
            const talent = JSON.parse(JSON.stringify({
                id: this.talent.id,
                name: this.name,
                experience_cost: this.experience_cost,
                categories: this.categories.map((category) => {
                    return category.id
                }),
                requirements: this.requirements.map((requirement) => {
                    return requirement.value
                }),
                required_talents: this.required_talents.map((required_talent) => {
                    return required_talent.value
                }),
                description: this.description,
                system: this.system,
                traits: this.traits.map((trait) => {
                    return trait.id
                }),
                book_id: this.book.value
            }));

            // Update the talent itself
            axios.put('/api/talent/' + this.talent.id, {talent: talent}).then(() => {
                this.$router.go(0);
            })
                .catch(error => {
                    console.log("error: " + error)
                })
        },
        isNumber: function (evt) {
            evt = (evt) ? evt : window.event;
            let charCode = (evt.which) ? evt.which : evt.keyCode;

            // check if input is a digit (0-9) or negative sign (-)
            if ((charCode < 48 || charCode > 57) && charCode !== 45) {
                evt.preventDefault();
            } else {
                // Check if value is above or below max and min
                if (Number(this.experience_cost + String.fromCharCode(charCode)) > 99) {
                    evt.preventDefault();
                    this.experience_cost = 99;
                } else if (Number(this.experience_cost + String.fromCharCode(charCode)) < -99) {
                    evt.preventDefault();
                    this.experience_cost = -99
                } else {
                    return true;
                }
            }
        },
        fetchRequirements: function () {
            axios.get('/api/requirement').then(response => {
                // put the data into an array
                this.requirement_options = response.data.data.map((requirement) => {
                    return {value: requirement.id, label: requirement.name, description: requirement.description}
                });
            })
                .catch(error => {
                    console.log("error: " + error)
                })
        },
        fetchTalents: function () {
            axios.get('/api/talent/genre/' + this.genre).then(response => {
                this.required_talent_options = response.data.data.map((required_talent) => {
                    return {
                        value: required_talent.id,
                        label: required_talent.name,
                        description: required_talent.description
                    }
                });
            })
                .catch(error => {
                    console.log(error)
                    if (error.response.status === 404) {
                        this.$router.push({name: 'not_found'})
                    }
                })
        },
        fetchBooks: function (genre) {
            if (genre) {
                axios.get('/api/' + genre + '/books').then(response => {
                    // Get the books from the genre
                    this.book_options = response.data.map((book) => {
                        return {
                            value: book.id,
                            label: book.name,
                            description: book.description
                        }
                    });
                })
                    .catch(error => {
                        console.log("Error: " + error);
                    })
            }
        },
        deleteCategory: function (index) {
            this.categories.splice(index, 1);
        },
        deleteTrait: function (index) {
            this.traits.splice(index, 1);
        }
    }
}
</script>

