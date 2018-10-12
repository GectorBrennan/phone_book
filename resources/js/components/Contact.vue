<template>
    <div class="contact">
        <div>
            <div class="contact-name">
                <input type="text"
                       v-model=" contact.name"
                       :disabled="!editable"
                       v-on:keyup.enter="edit">

            </div>

            <button class="contact-edit" :class="{done: editable}"  @click="edit" ></button>
            <button class="contact-delete" @click="deleteContact"></button>
        </div>

        <div>
            <div class="contact-email">
                <input type="text"
                       v-model="contact.email"
                       :disabled="!editable"
                       v-on:keyup.enter="edit">
            </div>
            <div class="contact-phone">
                <input type="text"
                       v-model="contact.phone"
                       :disabled="!editable"
                       v-on:keyup.enter="edit">

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                editable: false
            }
        },
        props: [
            'contact'
        ],
        methods: {
            edit: function () {
                if (this.editable) {
                    let params = {

                    };
                    api.put('api/contact.edit', {...this.contact})

                }
                

                this.editable = !this.editable

            },
            deleteContact: function() {
                let params = {id: this.contact.id}

                api.delete('api/contact.delete', {params: params}).then( response => {
                    if (response.data.response) {
                        this.$emit('deleteContact')
                    }
                });
            }
        }
    }
</script>