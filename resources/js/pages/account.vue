<!-- account.vue -->
<template>
    <div class="account">
        <!-- Login -->
        <div v-if="user === null">
            <form @submit.prevent="authorize" class="d-flex flex-column">
                <input type="hidden" name="_token" :value="csrf">
                <div>
                    <a>Username</a> <br>
                    <input name="username" type="text" v-model="username" autocomplete="username" placeholder="username"
                           max="255" required/>
                </div>
                <br>
                <div v-if="register">
                    <a>Email</a> <br>
                    <input name="email" type="email" v-model="email" placeholder="email" max="255" required/>
                </div>
                <br>
                <div>
                    <a>Password:</a><br>
                    <input name="password" type="password" v-model="password" autocomplete="password"
                           placeholder="password" max="255" required/>
                </div>
                <br>
                <div v-if="register">
                    <a>Confirm Password:</a><br>
                    <input name="confirmPassword" type="password" v-model="confirmPassword"
                           placeholder="confirm password" max="255" required/>
                </div>
                <br>
                <button type="submit" class="button m-4"> {{ register ? "Sign Up" : "Login" }}</button>
            </form>
            <button @click="register = !register">
                {{ register ? "Already have an account? Login!" : "Don't have an account? Sign up!" }}
            </button>
            <br>
            <a v-if="error != null"> {{ error }}</a>
        </div>

        <!-- Logout -->
        <div v-if="user !== null">
            <form @submit.prevent="logout" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit" class="button m-4">Logout</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: window.Laravel.user,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            register: false,
            email: "",
            username: "",
            password: "",
            confirmPassword: "",
            error: ""
        }
    },
    methods: {
        authorize: function () {
            this.register ? this.signUp() : this.login();
        },
        login: async function () {
            this.error = null;

            try {
                const login = {username: this.username, password: this.password}
                axios.post('/api/auth/login?username=' + login.username + '&password=' + login.password).then(response => {
                    this.$router.push({name: 'home'})
                })
                    .catch(error => {
                        if (error.response.data.message) {
                            this.error = error.response.data.message;
                        } else {
                            this.error = error.message;
                        }
                        console.log(error)
                    })
            } catch (error) {
                this.error = error;
            }
        },
        signUp: function () {
            this.error = null;

            if (this.confirmPassword === this.password) {
                try {
                    const signUp = {username: this.username, password: this.password, email: this.email}
                    axios.post('/api/auth/register?username=' + signUp.username + '&password=' + signUp.password + '&email=' + signUp.email).then(response => {
                        this.$router.push({name: 'home'})
                    })
                        .catch(error => {
                            if (error.response.data.message) {
                                this.error = error.response.data.message;
                            } else {
                                this.error = error.message;
                            }
                            console.log(error)
                        })
                } catch (error) {
                    this.error = error;
                }
            } else {
                this.error = "Passwords don't match";
            }
        },
        logout: function () {
            this.error = null;
            try {
                axios.post('/api/auth/logout').then(response => {
                    this.$router.push({name: 'home'})
                })
                    .catch(error => {
                        console.log(error)
                    })
            } catch (error) {
                this.error = error;
            }
        }
    }
}
</script>
