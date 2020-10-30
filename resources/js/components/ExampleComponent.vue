<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <h1>{{message}}</h1>

                        <button v-on:click="reverseMessage">Reverse Message</button>
                        <input v-model="message">
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
                message: 'Hello Vue!',
                disable: true,
            }
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

