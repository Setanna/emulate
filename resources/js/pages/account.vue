<!-- account.vue -->
<template>
    <div class="account">
        <!-- Login -->
        <div v-if="user === null">
            <form @submit.prevent="authorize" class="d-flex flex-column" id="form">
                <div>
                    <a class="sub-title">Username</a> <br>
                    <input name="username" class="text-input" type="text" v-model="username" id="username" autocomplete="username" placeholder="Username"
                           max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <div v-if="register">
                    <a class="sub-title">Email</a> <br>
                    <input name="email" class="text-input" type="email" v-model="email" id="email" placeholder="Email" max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <div>
                    <a class="sub-title">Password:</a><br>
                    <input name="password" class="text-input" type="password" v-model="password" id="password" autocomplete="password"
                           placeholder="Password" max="255" @input="resetValidation()" required/>
                </div>
                <br>
                <div v-if="register">
                    <a class="sub-title">Confirm Password:</a><br>
                    <input name="confirmPassword" class="text-input" type="password" v-model="confirmPassword"  id="confirmPassword"
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
                        if(error.response.data.errors.username){
                            console.log("username");
                            document.getElementById("username").setCustomValidity(error.response.data.errors.username);
                        }

                        if(error.response.data.errors.password){
                            document.getElementById("password").setCustomValidity(error.response.data.errors.password);
                        }

                        document.getElementById("form").reportValidity();
                    })
            } catch (error) {
                document.getElementById("username").setCustomValidity(error.message);
                document.getElementById("username").reportValidity();
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
                            if(error.response.data.errors.username){
                                console.log("username");
                                document.getElementById("username").setCustomValidity(error.response.data.errors.username);
                            }

                            if(error.response.data.errors.email){
                                console.log("email");
                                document.getElementById("email").setCustomValidity(error.response.data.errors.email);
                            }

                            if(error.response.data.errors.password){
                                document.getElementById("password").setCustomValidity(error.response.data.errors.password);
                            }

                            document.getElementById("form").reportValidity();
                        })
                } catch (error) {
                    document.getElementById("username").setCustomValidity(error.message);
                    document.getElementById("username").reportValidity();
                }
            } else {
                document.getElementById("confirmPassword").setCustomValidity("Passwords don't match");
                document.getElementById("confirmPassword").reportValidity();
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
