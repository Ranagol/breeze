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
    <VForm
        ref="refForm"
        @submit.prevent="() => {}"
    >
        <VRow>
        <VCol
            cols="12"
            md="6"
        >
            <VTextField
            v-model="firstName"
            label="First Name"
            :rules="[requiredValidator]"
            />
        </VCol>

        <VCol
            cols="12"
            md="6"
        >
            <VTextField
            v-model="email"
            label="Email"
            :rules="[requiredValidator, emailValidator]"
            />
        </VCol>

            <VCol cols="12">
                <VBtn
                type="submit"
                @click="refForm?.validate()"
                >
                Submit
                </VBtn>
            </VCol>
            </VRow>
        </VForm>
    </v-card>

    <!-- <v-card
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
    </v-card> -->

  

</template>

<script lang="ts" setup>
import { ref } from 'vue';
// eslint-disable-next-line @typescript-eslint/consistent-type-imports
import type { VForm } from 'vuetify/components/VForm';
import { emailValidator, requiredValidator } from '@validators';


const refForm = ref<VForm>()

const firstName = ref('')
const email = ref('')
const mobile = ref<number>()
const password = ref<string>()
const checkbox = ref(false)

</script>
