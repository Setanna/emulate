<template>
    <Transition name="modal">
        <div v-if="showTheme" class="modal-mask">
            <div class="modal-container">
                <!-- Body -->
                <div class="modal-body">
                    <div>
                        <fieldset class="fieldset">
                            <legend class="legend">
                                Theme
                            </legend>
                            <!-- Theme Picker -->
                            <select v-model="modalTheme" class="select title">
                                <option class="option" value="obsidian"> Obsidian </option>
                                <option class="option" value="office"> Office </option>
                                <option class="option" value="charcoal"> Charcoal </option>
                            </select>
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
export default {
    data() {
        return {
            /* arrays & objects */
            modalTheme: localStorage.getItem('theme') !== null ?  localStorage.getItem('theme') : 'obsidian'
        }
    },
    props: ['showTheme', 'theme'],
    emits: ['update:showTheme', 'update:theme'],
    methods: {
        close: function () {
            this.$emit('update:showTheme', false);
        }
    },
    watch: {
        modalTheme: {
            handler(theme) {
                if(theme){
                    this.$emit('update:theme', theme);
                }
            },
            immediate: true
        }
    }
}
</script>
