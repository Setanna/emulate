<template>
    <Transition name="modal">
        <div v-if="showFilter" class="modal-mask">
            <div class="modal-container">
                <!-- Body -->
                <div class="modal-body">
                    <div>
                        <a>Books</a>

                        <ul class="checkbox-ul">
                            <li class="checkbox-li" v-for="book in books">
                                <input class="checkbox" type="checkbox" :value="book.id" :name="book.id" :id="book.name + book.id" hidden checked>
                                <label class="checkbox-label" :for="book.name + book.id"> {{ book.name }} </label>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button class="modal-default-button" @click="$emit('close')"> OK</button>
                </div>
            </div>
        </div>
    </Transition>
</template>


<script>
export default {
    props: {
        showFilter: Boolean,
        books: Object
    }
}
</script>
