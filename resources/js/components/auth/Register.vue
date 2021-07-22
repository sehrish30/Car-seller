<template>
    <div
        class="
            flex
            items-center
            justify-center
            bg-gray-50
            py-12
            px-4
            sm:px-6
            lg:px-8
            h-full
        "
    >
        <div class="max-w-md w-full space-y-8">
            <div>
                <img
                    class="mx-auto h-12 w-auto"
                    src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                    alt="Workflow"
                />
                <h2
                    class="
                        mt-6
                        text-center text-3xl
                        font-extrabold
                        text-gray-900
                    "
                >
                    Register your account
                </h2>
            </div>
            <form @submit.prevent="handleRegister" class="mt-8 space-y-6">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input
                            v-model="username"
                            name="username"
                            type="text"
                            autocomplete="given-name"
                            required
                            class="
                                appearance-none
                                rounded-none
                                relative
                                block
                                w-full
                                px-3
                                py-2
                                border border-gray-300
                                placeholder-gray-500
                                text-gray-900
                                rounded-b-md
                                focus:outline-none
                                focus:ring-indigo-500
                                focus:border-indigo-500
                                focus:z-10
                                sm:text-sm
                            "
                            placeholder="Name"
                        />
                        <p
                            :class="[usernameerror ? '' : 'hidden']"
                            class="text-red-500 text-xs italic"
                        >
                            Your name is required
                        </p>
                    </div>
                    <div>
                        <label for="email-address" class="sr-only"
                            >Email address</label
                        >
                        <input
                            v-model="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="
                                appearance-none
                                rounded-none
                                relative
                                block
                                w-full
                                px-3
                                py-2
                                border border-gray-300
                                placeholder-gray-500
                                text-gray-900
                                rounded-t-md
                                focus:outline-none
                                focus:ring-indigo-500
                                focus:border-indigo-500
                                focus:z-10
                                sm:text-sm
                            "
                            placeholder="Email address"
                        />
                        <p
                            :class="[emailerror ? '' : 'hidden']"
                            class="text-red-500 text-xs italic"
                        >
                            Email format should be abc@live.com
                        </p>
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input
                            v-model="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="
                                appearance-none
                                rounded-none
                                relative
                                block
                                w-full
                                px-3
                                py-2
                                border border-gray-300
                                placeholder-gray-500
                                text-gray-900
                                rounded-b-md
                                focus:outline-none
                                focus:ring-indigo-500
                                focus:border-indigo-500
                                focus:z-10
                                sm:text-sm
                            "
                            placeholder="Password"
                        />
                        <p
                            :class="[passworderror ? '' : 'hidden']"
                            class="text-red-500 text-xs italic"
                        >
                            Password should be atleast 6 characters should
                            contain atleast one number and one special character
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center"></div>

                    <div class="text-sm">
                        <router-link
                            :to="{ path: 'login' }"
                            class="
                                font-medium
                                text-indigo-600
                                hover:text-indigo-500
                            "
                        >
                            Sign in?
                        </router-link>
                    </div>
                </div>

                <div>
                    <button
                        @click="handleRegister"
                        type="button"
                        class="
                            group
                            relative
                            w-full
                            flex
                            justify-center
                            py-2
                            px-4
                            border border-transparent
                            text-sm
                            font-medium
                            rounded-md
                            text-white
                            bg-indigo-600
                            hover:bg-indigo-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-offset-2
                            focus:ring-indigo-500
                        "
                    >
                        <span
                            class="
                                absolute
                                left-0
                                inset-y-0
                                flex
                                items-center
                                pl-3
                            "
                        >
                            <!-- Heroicon name: solid/lock-closed -->
                            <svg
                                class="
                                    h-5
                                    w-5
                                    text-indigo-500
                                    group-hover:text-indigo-400
                                "
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </span>
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { ref, watchEffect } from "vue";
import { useRouter } from "vue-router";

export default {
    setup() {
        const email = ref("");
        const password = ref("");
        const username = ref("");
        const errors = ref([]);
        const emailerror = ref(false);
        const passworderror = ref(false);
        const usernameerror = ref(false);

        const router = useRouter();

        watchEffect(() => {
            let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            let passwordRegex =
                /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;

            if (!email.value.match(regexEmail)) {
                console.log(email.value);
                errors.value.push({
                    email: "Email format should be abc@live.com",
                });
                emailerror.value = true;
            } else {
                errors.value.forEach(function (val) {
                    delete val.email;
                });
                emailerror.value = false;
            }
            console.log(passwordRegex.test(password.value));
            if (!passwordRegex.test(password.value)) {
                passworderror.value = true;
                errors.value.push({
                    password:
                        "password should be atleast 6 characters should contain atleast one number and one special character",
                });
            } else {
                passworderror.value = false;
                errors.value.forEach(function (val) {
                    delete val.password;
                });
            }

            if (!username.value) {
                usernameerror.value = true;
            } else {
                usernameerror.value = false;
            }
        });

        const handleRegister = () => {
            // csrf token with SPA app for laravel
            axios.get("/sanctum/csrf-cookie").then(async (response) => {
                try {
                    const res = await axios.post("/api/register", {
                        email: email.value,
                        password: password.value,
                        name: username.value,
                    });
                    router.push({
                        name: "login",
                    });
                    console.log(res);
                } catch (err) {
                    console.error(err);
                }
            });
        };
        return {
            email,
            password,
            handleRegister,
            errors,
            emailerror,
            passworderror,
            username,
            usernameerror,
        };
    },
};
</script>

<style lang="scss" scoped></style>
