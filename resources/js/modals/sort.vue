<template>
    <Transition name="modal">
        <div v-if="showSort" class="modal-mask">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="header">Sort</slot>
                </div>

                <div class="modal-body">
                    <slot name="body">
                        <a>Name:</a>
                        <select name="sortName">
                            <option> Ascending </option>
                            <option> Descending </option>
                        </select>
                        <a>Rank:</a>
                        <select name="sortRank">
                            <option> Ascending </option>
                            <option> Descending </option>
                        </select>
                        <a>Book:</a>
                        <select name="sortBook">
                            <option> Ascending </option>
                            <option> Descending </option>
                        </select>
                    </slot>
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                        <button
                            class="modal-default-button"
                            @click="$emit('close')"
                        >OK</button>
                    </slot>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    props: {
        showSort: Boolean
    }
}
</script>
