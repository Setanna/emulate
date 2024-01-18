<template>
    <Transition name="modal">
        <div v-if="showFilter" class="modal-mask">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="header"> Filter & Sort</slot>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        <a>Book</a>
                        <select name="filterBook">
                            <option v-for="book in books" value="{{ book.id }}"> {{ book.name }} </option>
                        </select>
                    </slot>
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                        <button
                            class="modal-default-button"
                            @click="$emit('close')"
                        >OK
                        </button>
                    </slot>
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
