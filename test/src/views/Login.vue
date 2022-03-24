<template>
    <div class="login">
        <v-container fluid>
            <v-row justify='center'>
                <v-col cols='4'>ユーザーID</v-col>
                <v-col cols='6'>
                    <v-text-field
                    v-model="userId"
                    outlined
                    dense
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify='center'>
                <v-col cols='4'>Password</v-col>
                <v-col cols='6'>
                    <v-text-field
                    v-model="pass"
                    outlined
                    dense
                    type='password'
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify='center'>
                <v-btn @click="submit">
                    送信
                </v-btn>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from "axios"
export default {
    data() {
        return {
            userId: '',
            pass: ''
        }
    },
    methods:{
        submit(){
            try{
                axios.post('./api/login.php', {
                  userId: this.userId,
                  pass: this.pass
                })
                .then((response) => {
                    switch(response.data.result) {
                        case 'false': window.location.href = './api/tVtGafxJsnVtL38ATGML.php'
                            break
                        case 'error': alert('DB接続エラー')
                            break
                        default: this.success(response.data.result)
                    }
                })
            }
            catch{
                alert('通信エラー')
            }
        },

        success(data){
            this.redirect()
            this.saveToken(data)
        },
        saveToken(data){
            let arrayData = data.split('?')
            sessionStorage.setItem('id', arrayData[0])
            sessionStorage.setItem('token', arrayData[1])
        },
        redirect(){
            window.location.href = '/admin/editNews'
        }
    }
}
</script>