<!-- account.vue -->
<template>
    <div class="account">
        <!-- Login -->
        <div v-if="user === null">
            <form @submit.prevent="authorize" class="d-flex flex-column" id="form">
                <div>
                    <a class="sub-title">Username</a> <br>
                    <input name="username" class="text-input" type="text" v-model="username" autocomplete="username" placeholder="Username"
                           max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <div v-if="register">
                    <a class="sub-title">Email</a> <br>
                    <input name="email" class="text-input" type="email" v-model="email" placeholder="Email" max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <div>
                    <a class="sub-title">Password:</a><br>
                    <input name="password" class="text-input" type="password" v-model="password" autocomplete="password"
                           placeholder="Password" max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <div v-if="register">
                    <a class="sub-title">Confirm Password:</a><br>
                    <input name="confirmPassword" class="text-input" type="password" v-model="confirmPassword"
                           placeholder="Confirm password" max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <button type="submit" class="button m-4"> {{ register ? "Sign Up" : "Login" }}</button>
            </form>
            <button class="button" @click="switchLS()">
                {{ register ? "Already have an account? Login!" : "Don't have an account? Sign up!" }}
            </button>
        </div>

        <!-- Logout -->
        <div v-if="user !== null">
            <form @submit.prevent="logout" method="post">
                <button type="submit" class="background-tertiary button m-4">Logout</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: window.Laravel.user,
            register: false,
            email: "",
            username: "",
            password: "",
            confirmPassword: ""
        }
    },
    methods: {
        authorize: function () {
            this.register ? this.signUp() : this.login();
        },
        switchLS: function() {
            this.register = !this.register;
            this.resetValidation();
        },
        resetValidation: function () {
            let inputs = document.getElementById(("form")).getElementsByTagName("input");
            for (let input of inputs){
                input.setCustomValidity('');
            }
        },
        login: async function () {
            try {
                const login = {username: this.username, password: this.password}
                axios.post('/api/auth/login?username=' + login.username + '&password=' + login.password).then(() => {
                    this.$router.go(0);
                })
                    .catch(error => {
                        if (error.response.data.message) {
                            document.getElementById(("form")).getElementsByTagName("input")[0].setCustomValidity(error.response.data.message);
                            document.getElementById("form").reportValidity();
                        } else {
                            document.getElementById(("form")).getElementsByTagName("input")[0].setCustomValidity(error.message);
                            document.getElementById("form").reportValidity();
                        }
                        console.log(error)
                    })
            } catch (error) {
                document.getElementById(("form")).getElementsByTagName("input")[0].setCustomValidity(error.message);
                document.getElementById("form").reportValidity();
            }
        },
        signUp: function () {

            if (this.confirmPassword === this.password) {
                try {
                    const signUp = {username: this.username, password: this.password, email: this.email}
                    axios.post('/api/auth/register?username=' + signUp.username + '&password=' + signUp.password + '&email=' + signUp.email).then(() => {
                        this.$router.go(0);
                    })
                        .catch(error => {
                            if (error.response.data.message) {
                                document.getElementById(("form")).getElementsByTagName("input")[0].setCustomValidity(error.response.data.message);
                                document.getElementById("form").reportValidity();
                            } else {
                                document.getElementById(("form")).getElementsByTagName("input")[0].setCustomValidity(error.message);
                                document.getElementById("form").reportValidity();
                            }
                            console.log(error)
                        })
                } catch (error) {
                    document.getElementById(("form")).getElementsByTagName("input")[0].setCustomValidity(error.message);
                    document.getElementById("form").reportValidity();
                }
            } else {
                document.getElementById(("form")).getElementsByTagName("input")[3].setCustomValidity("Passwords don't match");
                document.getElementById("form").reportValidity();
            }
        },
        logout: function () {
            this.error = null;
            try {
                axios.post('/api/auth/logout').then(() => {
                    this.$router.go(0);
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
