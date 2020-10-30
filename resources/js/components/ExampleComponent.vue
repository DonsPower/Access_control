<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <h1>{{message}}</h1>
                       
                        <v-text-field
                                   v-model="message" 
                        ></v-text-field>
                     
                        <v-btn block v-on:click="reverseMessage">
                            Reversa
                        </v-btn>
                          <v-btn
                            class="mx-2"
                            fab
                            dark
                            small
                            color="#E33E1D"
                            >
                            <v-icon >
                                mdi-heart
                            </v-icon>
                        </v-btn>
                        <v-btn
                            icon
                            color="#E33E1D"
                            >
                            <v-icon>mdi-heart</v-icon>
                        </v-btn>

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
                message: 'Hello Vue! + Vuetify',
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

