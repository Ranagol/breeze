<template>

    <!-- HEAD component -->
    <Head>
        <!-- With this here we can dynamically change the app title, which is displayed in the
        Chrome tab. Also, the Head component is globally registered, so that is why we are not
        importing it into this component. -->
        <title>Home tab title</title>
    </Head>

    <v-card
        title="Page: HOME"
        text="This is content"
    ></v-card>

    <v-card
        class="mx-auto"
        max-width="600"
    >
        <VForm @submit.prevent="() => {}">
                <VTextField
                  v-model="firstName"
                  label="First Name"
                  placeholder="First Name"
                />
              
        
                <VTextField
                  v-model="email"
                  label="Email"
                  type="email"
                  placeholder="Email"
                />
              
        
                <VTextField
                  v-model="mobile"
                  label="Mobile"
                  type="number"
                  placeholder="Number"
                />
              
        
                <VTextField
                  v-model="password"
                  label="Password"
                  type="password"
                  placeholder="Password"
                />
              
        
                <VCheckbox
                  v-model="checkbox"
                  label="Remember me"
                />
              
        
                <VBtn type="submit">
                  Submit
                </VBtn>
        
                <VBtn
                  type="reset"
                  color="secondary"
                  variant="tonal"
                >
                  Reset
                </VBtn>
        </VForm>
    </v-card>

  

</template>

<script lang="ts" setup>
// eslint-disable-next-line @typescript-eslint/consistent-type-imports

import { ref } from 'vue';

const firstName = ref('')
const email = ref('')
const mobile = ref<number>()
const password = ref<string>()
const checkbox = ref(false)

</script>
