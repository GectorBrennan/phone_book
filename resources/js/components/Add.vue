<template>
    <div class="add">
        <button class="add-icon" @click="show = true"></button>

        <div class="popup" v-show="show">
            <div class="content">
                <button class="close" @click="close"></button>
                <div class="title">Add new contact</div>
                <div class="form-group">
                    <div class="input-group">
                        <span>Name:</span>
                        <input type="text" v-model="name">
                    </div>
                    <div class="input-group">
                        <span>Email:</span>
                        <input type="text" v-model="email">
                    </div>
                    <div class="input-group">
                        <span>Phone:</span>
                        <input type="text" v-model="phone">
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Add" @click="createContact">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                show: true,
                name: '',
                email: '',
                phone: ''
            }
        },

        methods: {
            close: function (){
                this.name = '';
                this.email = '';
                this.phone = '';
                this.show = false;
            },
            createContact: function () {
                let params = {
                    name: this.name,
                    email: this.email,
                    phone: this.phone
                };

                api.post('api/contact.create', {...params}).then( response => {
                    this.$emit('createContact', response.data.response)

                });

                this.close();
            }
        }
    }
</script>