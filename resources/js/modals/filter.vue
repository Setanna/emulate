<template>
    <Transition name="modal">
        <div v-if="showFilter" class="modal-mask">
            <div class="modal-container">
                <!-- Body -->
                <div class="modal-body">
                    <div>
                        <fieldset>
                            <legend>
                                Books
                            </legend>
                            <ul class="checkbox-ul">
                                <li class="checkbox-li" v-for="book in books">
                                    <input class="checkbox" type="checkbox" v-model="filters.books" :value="book.id" :name="book.id" :id="book.name + book.id" hidden>
                                    <label class="checkbox-label" :for="book.name + book.id"> {{ book.name }} </label>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="modal-default-button" @click="$emit('save', filters)">Confirm</button>
                    <button class="modal-default-button" @click="$emit('cancel')">Cancel</button>
                </div>
            </div>
        </div>
    </Transition>
</template>


<script>
export default {data() {
        return {
            /* arrays & objects */
            filters: {
                'books': []
            },
        }
    },
    props: ['showFilter', 'books', 'search_filters'],
    emits: ['update:search_filters', 'save', 'cancel']
}
</script>
